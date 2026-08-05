<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('admin.requirements.index') }}">

            <div class="row g-3">

                <div class="col-lg-4">

                    <input name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search RFQ number, product, buyer">

                </div>

                <div class="col-lg-3">

                    <select name="status" class="form-select">

                        <option value="">Status</option>

                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>

                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted
                        </option>

                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>

                    </select>

                </div>

                <div class="col-lg-3">

                    <select name="category" class="form-select">

                        <option value="">Category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

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
