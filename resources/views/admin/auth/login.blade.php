<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Exbhix Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center vh-100 align-items-center">

            <div class="col-md-4">

                <div class="card shadow">

                    <div class="card-header text-center">

                        <h3>Exbhix Admin</h3>

                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.login.submit') }}">

                            @csrf

                            <div class="mb-3">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <label>Password</label>

                                <input type="password" name="password" class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="remember">

                                    <label class="form-check-label">

                                        Remember Me

                                    </label>

                                </div>

                            </div>

                            <button class="btn btn-primary w-100">

                                Login

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
