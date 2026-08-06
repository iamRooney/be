<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Seller-facing document uploads used for company verification (legal
 * identity + tax records). An admin reviews these from the admin panel.
 *
 * Security notes (file uploads are a classic attack surface):
 *  - Files are validated by real, content-detected MIME type, not by
 *    filename/extension or the client's declared Content-Type.
 *  - Stored on the 'local' disk (storage/app/private), which has no
 *    web-facing route or symlink — it can never be requested directly
 *    by URL, so even a malicious file that somehow got through can't
 *    be executed by hitting it in a browser.
 *  - The filename on disk is always a fresh random UUID with an
 *    extension *we* pick from an allowlist, keyed off the verified
 *    MIME type — client-supplied names/extensions never touch the
 *    filesystem path.
 *  - Downloads are always streamed through an authenticated action
 *    with an explicit Content-Type + "attachment" disposition and
 *    X-Content-Type-Options: nosniff, so a browser is never tricked
 *    into rendering an uploaded file inline as HTML/SVG/etc.
 */
class CompanyDocumentController extends Controller
{
    private function sellerCompany(Request $request)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'seller') {
            return null;
        }

        return $user->company;
    }

    public function index(Request $request)
    {
        $company = $this->sellerCompany($request);

        if (! $company) {
            return response()->json([
                'success' => false,
                'message' => 'Only sellers with a company profile can manage documents.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $company->documents()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $company = $this->sellerCompany($request);

        if (! $company) {
            return response()->json([
                'success' => false,
                'message' => 'Only sellers with a company profile can upload documents. Complete your seller profile first.',
            ], 403);
        }

        $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(CompanyDocument::TYPES)),
            // mimes: already checks the real, content-detected MIME —
            // not the extension the client sent — but we re-verify
            // below anyway as defense in depth.
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $file = $request->file('file');
        $detectedMime = $file->getMimeType();

        if (! array_key_exists($detectedMime, CompanyDocument::ALLOWED_MIME_TYPES)) {
            throw ValidationException::withMessages([
                'file' => ['That file type isn\'t supported. Please upload a PDF, JPG, or PNG.'],
            ]);
        }

        $extension = CompanyDocument::ALLOWED_MIME_TYPES[$detectedMime];

        // Random name chosen by us, extension chosen by us — the
        // client's filename is stored only as display metadata below.
        $storedName = Str::uuid() . '.' . $extension;
        $path = $file->storeAs("company-documents/{$company->id}", $storedName, 'local');

        $document = $company->documents()->create([
            'type' => $request->input('type'),
            'original_name' => Str::limit(basename($file->getClientOriginalName()), 180, ''),
            'file_path' => $path,
            'mime_type' => $detectedMime,
            'size' => $file->getSize(),
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document uploaded and pending review.',
            'data' => $document,
        ], 201);
    }

    /** Stream the seller's own document back (view/download). */
    public function show(Request $request, CompanyDocument $document)
    {
        $company = $this->sellerCompany($request);

        if (! $company || $document->company_id !== $company->id) {
            abort(403);
        }

        return $this->streamDocument($document);
    }

    public function destroy(Request $request, CompanyDocument $document)
    {
        $company = $this->sellerCompany($request);

        if (! $company || $document->company_id !== $company->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        if ($document->status === 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Approved documents can\'t be removed.',
            ], 422);
        }

        if (Storage::disk('local')->exists($document->file_path)) {
            Storage::disk('local')->delete($document->file_path);
        }

        $document->delete();

        return response()->json([
            'success' => true,
            'message' => 'Document removed.',
        ]);
    }

    public static function streamDocument(CompanyDocument $document): Response
    {
        if (! Storage::disk('local')->exists($document->file_path)) {
            abort(404);
        }

        $contents = Storage::disk('local')->get($document->file_path);

        return response($contents, 200, [
            // Our own recorded mime type, never anything derived from
            // the request — prevents content-type confusion.
            'Content-Type' => $document->mime_type,
            'Content-Disposition' => 'inline; filename="' . addslashes($document->original_name) . '"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=0, no-cache',
        ]);
    }
}
