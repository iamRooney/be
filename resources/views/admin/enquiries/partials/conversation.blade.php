<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between">

            <div>

                <h5 class="fw-bold mb-1">

                    Conversation

                </h5>

                <small class="text-muted">

                    Buyer ↔ Seller

                </small>

            </div>

            <span class="badge bg-success">

                Open

            </span>

        </div>

    </div>

    <div class="card-body conversation-area">

        {{-- Buyer --}}

        <div class="message left">

            <div class="avatar bg-primary">

                R

            </div>

            <div>

                <div class="bubble buyer">

                    Hi, I need 500 Arduino UNO boards.

                </div>

                <small class="text-muted">

                    Rahul • 10:15 AM

                </small>

            </div>

        </div>

        {{-- Seller --}}

        <div class="message right">

            <div>

                <div class="bubble seller">

                    Yes, they're available.

                </div>

                <small class="text-muted float-end">

                    ABC Electronics • 10:20 AM

                </small>

            </div>

            <div class="avatar bg-success">

                A

            </div>

        </div>

        {{-- Buyer --}}

        <div class="message left">

            <div class="avatar bg-primary">

                R

            </div>

            <div>

                <div class="bubble buyer">

                    Can you deliver within 7 days?

                </div>

                <small class="text-muted">

                    Rahul • 10:25 AM

                </small>

            </div>

        </div>

        {{-- Seller --}}

        <div class="message right">

            <div>

                <div class="bubble seller">

                    Yes, dispatch tomorrow.

                </div>

                <small class="text-muted float-end">

                    ABC Electronics • 10:28 AM

                </small>

            </div>

            <div class="avatar bg-success">

                A

            </div>

        </div>

    </div>

</div>

<style>
    .conversation-area {

        background: #f8fafc;

        padding: 25px;

        max-height: 700px;

        overflow-y: auto;

    }

    .message {

        display: flex;

        margin-bottom: 25px;

        gap: 12px;

    }

    .message.right {

        justify-content: flex-end;

    }

    .avatar {

        width: 42px;

        height: 42px;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #fff;

        font-weight: 700;

    }

    .bubble {

        padding: 14px 18px;

        border-radius: 18px;

        max-width: 420px;

        box-shadow: 0 2px 10px rgba(0, 0, 0, .05);

    }

    .buyer {

        background: white;

    }

    .seller {

        background: #2563eb;

        color: white;

    }
</style>
