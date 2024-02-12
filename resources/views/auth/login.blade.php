<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
    @include('layout')
</head>
<body>
    <div class="container">
            <div class="col-md-4 col-sm-12 shadow rounded px-3 pt-1" style="border: 2px solid black;">
                <div class="d-flex  align-items-center my-4">
                    <h5>Pelayanan Pengaduan Masyarakat</h5>
                </div>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    <div class="input-control my-2">
                        <label for="email">Email : </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="input-control my-2">
                        <label for="password">Password :</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <button type="submit" class="btn btn-success my-4 px-4">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
