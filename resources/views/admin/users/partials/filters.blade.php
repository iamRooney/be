<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('admin.users.index') }}">

            <div class="row g-3">

                <div class="col-lg-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search users..."
                        value="{{ request('search') }}"
                    >

                </div>

                <div class="col-lg-2">

                    <select name="role" class="form-select">

                        <option value="">Role</option>

                        <option value="buyer" @selected(request('role') == 'buyer')>Buyer</option>

                        <option value="seller" @selected(request('role') == 'seller')>Seller</option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <select name="status" class="form-select">

                        <option value="">Status</option>

                        <option value="active" @selected(request('status') == 'active')>Active</option>

                        <option value="suspended" @selected(request('status') == 'suspended')>Suspended</option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <button type="submit" class="btn btn-primary w-100">

                        Apply

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
