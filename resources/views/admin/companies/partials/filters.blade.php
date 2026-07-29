<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('admin.companies.index') }}">

            <div class="row g-3">

                <div class="col-lg-4">

                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search company, owner or city">

                </div>

                <div class="col-lg-2">

                    <select name="status" class="form-select">

                        <option value="">Status</option>

                        <option value="verified" @selected(request('status') === 'verified')>Verified</option>

                        <option value="pending" @selected(request('status') === 'pending')>Pending</option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <select name="state_id" class="form-select">

                        <option value="">State</option>

                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @selected((string) request('state_id') === (string) $state->id)>
                                {{ $state->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <button type="submit" class="btn btn-primary w-100">

                        Apply

                    </button>

                </div>

                <div class="col-lg-2">

                    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary w-100">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>
