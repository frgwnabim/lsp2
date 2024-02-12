<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @include('layout')
    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">                    
                    <a href="/dashboard">Dashboard Admin</a>
                </li>
            </ul>
        </nav>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 d-flex justify-content-center align-items-center">
                        <div class="col-sm-6">
                            <h1>Data Laporan Pengaduan</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content px-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 shadow px-5 py-5">
                            <form method="post" action="{{ route('laporan.updateStatus', $laporan->id) }}">
                                @csrf
                                @method('patch')
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" @if ($laporan->status == 'pending') selected @endif>Pending</option>
                                    <option value="progress" @if ($laporan->status == 'progress') selected @endif>On-Progress</option>
                                    <option value="done" @if ($laporan->status == 'done') selected @endif>Done</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                            </form>
                            <h6 class="my-3">Kategori Laporan : {{ $laporan->kategori }}</h6>
                            <h6 class="my-4">Nama : {{ $laporan->name }}</h6>
                            <h6 class="my-4">Alamat : {{ $laporan->alamat }}</h6>
                            <h6 class="my-4">Isi Aspirasi : {{ $laporan->aspirasi }}</h6>
                            <h6 class="my-4">Keterangan : {{ $laporan->keterangan }}</h6>
                            <h6 class="my-4">Gambar Kejadian : <br><img src="{{ url($laporan->gambar_kejadian) }}"
                                    alt="gambar" width="300" class="my-4"></h6>

                            <a href="/dashboard"><button class="btn btn-outline-info" style="float: right;">Kembali
                                    <b>-></b></button></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>
    <script src="../../dist/js/demo.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</html>


