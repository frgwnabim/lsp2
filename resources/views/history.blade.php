<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}">
    @include('layout')
</head>
<style>
    .sidebar-dark-primary {
  background-color: #54b5d3; 
}

.sidebar-dark-primary .navbar-nav .nav-link {
  color: #ffffff; 
}

.sidebar-dark-primary .navbar-nav .nav-link:hover {
  color: #f8f9fa; 
}

</style>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard">*Dashboard</a>
                    <br>
                    <a href="/history">*History</a>
                    
                        <li class="nav-item fixed-bottom">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link bg-danger">
                                    <p class="text-light">Logout</p>
                                </button>
                            </form>
                        </li>    
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
            </ul>
        </nav>
        
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 d-flex justify-content-center align-items-center">
                        <div class="col-sm-12 mb-2" style="padding-left: 34px;">
                            <h1>History Data Pengaduan</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content px-5">
                <div class="table-responsive">
                    <table class="table text-center" id="laporanTable">
                        <thead>
                            <tr>
                                <th class="px-3">NO</th>
                                <th class="px-2">Status</th>
                                <th class="px-2">Kategori</th>
                                <th class="px-2">Nama Pelapor</th>
                                <th class="px-2">Alamat</th>
                                <th class="px-2">Aspirasi</th>
                                <th class="px-2">Keterangan</th>
                                <th class="px-2">Gambar</th>
                                <th class="px-2">Tanggal</th>
                                <th class="px-2" colspan="3">Action</th>
                            </tr>
                        </thead>

                        <tbody id="laporanTableBody" class="px-4">
                            @forelse ($laporan as $key => $data)
                                <tr data-category="{{ strtolower($data->kategori) }}">
                                    <td class="px-3">{{ $key + 1 }}</td>
                                    <td class="px-2">
                                        <b>
                                            <span
                                                class="badge rounded-pill
                                                @if ($data->status == 'pending') bg-danger
                                                @elseif($data->status == 'progress') bg-warning
                                                @elseif($data->status == 'done') bg-success @endif">
                                                {{ $data->status }}
                                            </span>
                                        </b>
                                    </td>
                                    <td class="px-2">{{ $data->kategori }}</td>
                                    <td class="px-2">{{ $data->name }}</td>
                                    <td class="px-2">{{ $data->alamat }}</td>
                                    <td class="px-2">{{ $data->aspirasi }}</td>
                                    <td class="px-2">{{ $data->keterangan }}</td>
                                    <td class="px-2">
                                        <img src="{{ asset($data->gambar_kejadian) }}" alt=""
                                            width="50">
                                    </td>
                                    <td class="px-2">{{ $data->created_at->format('d F Y') }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('laporan.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="table-none">
                                    <td class="px-2" colspan="10">
                                        <div class="container">
                                            <div class="row d-flex justify-content-center align-items-center text-align-center"
                                                style="height: 55vh;">
                                                <h3 class="text-secondary">Data Kosong !</h3>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
        <aside class="control-sidebar control-sidebar-success ">
        </aside>
    </div>
    <script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        var tanggalSelect = document.getElementById("tanggalFilter1");
        tanggalSelect.add(new Option("All Dates", "")); // Default option
        for (var i = 1; i <= 31; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = i;
            tanggalSelect.add(option);
        }

        var bulanSelect = document.getElementById("tanggalFilter2");
        bulanSelect.add(new Option("All Months", "")); 
        var namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        for (var j = 0; j < namaBulan.length; j++) {
            var optionBulan = document.createElement("option");
            optionBulan.value = j + 1;
            optionBulan.text = namaBulan[j];
            bulanSelect.add(optionBulan);
        }

        applyFilter();
    });

    function applyFilter() {
        var filterTanggal = document.getElementById("tanggalFilter1").value;
        var filterBulan = document.getElementById("tanggalFilter2").value;

        // Loop melalui setiap baris tabel
        var laporanRows = document.querySelectorAll("#laporanTableBody tr");
        laporanRows.forEach(function(row) {
            var rowDataTanggal = row.querySelector("td:nth-child(9)").textContent; // Kolom TANGGAL

            var rowDataDate = new Date(rowDataTanggal);

            if ((filterTanggal === "" || rowDataDate.getDate() == filterTanggal) &&
                (filterBulan === "" || rowDataDate.getMonth() + 1 == filterBulan)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById("kategoriFilter");

        selectElement.addEventListener("change", function() {
            var selectedCategory = selectElement.value;
            var tableRows = document.querySelectorAll("#laporanTableBody tr");

            tableRows.forEach(function(row) {
                var rowCategory = row.getAttribute("data-category");

                if (selectedCategory === "all" || selectedCategory === rowCategory) {
                    row.style.display = ""; // Display the row
                } else {
                    row.style.display = "none"; // Hide the row
                }
            });
        });
    });
</script>


</html>

