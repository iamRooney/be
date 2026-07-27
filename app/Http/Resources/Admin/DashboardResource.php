<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'success' => true,

            'message' => 'Dashboard loaded successfully.',

            'data' => $this->resource

        ];
    }
}
