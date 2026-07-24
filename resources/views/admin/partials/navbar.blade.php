<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 py-3">

    <div class="container-fluid">

        <div>

            <h4 class="fw-bold mb-0">
                @yield('title', 'Dashboard')
            </h4>

            <small class="text-muted">
                Welcome back, Administrator
            </small>

        </div>

        <div class="d-flex align-items-center ms-auto">

            <!-- Search -->

            {{-- <div class="position-relative me-3 d-none d-lg-block">

                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>

                <input type="text" class="form-control rounded-pill ps-5" placeholder="Search..." style="width:250px;">

            </div> --}}

            <!-- Notification -->

            {{-- <button class="btn btn-light rounded-circle me-3 position-relative">

                <i class="bi bi-bell fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    3

                </span>

            </button> --}}

            <!-- Profile -->

            <div class="dropdown">

                <button class="btn btn-light dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
                        style="width:38px;height:38px;">

                        A

                    </div>

                    <div class="text-start d-none d-md-block">

                        <div class="fw-semibold">

                            Administrator

                        </div>

                        <small class="text-muted">

                            Super Admin

                        </small>

                    </div>

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                    <li>

                        <a class="dropdown-item" href="#">

                            <i class="bi bi-person me-2"></i>

                            Profile

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item" href="#">

                            <i class="bi bi-gear me-2"></i>

                            Settings

                        </a>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form action="{{ route('admin.logout') }}" method="POST">

                            @csrf

                            <button class="dropdown-item text-danger">

                                <i class="bi bi-box-arrow-right me-2"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>
