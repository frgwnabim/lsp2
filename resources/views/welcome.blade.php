<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @include('layout')
</head>

<body>
    @include('header')

    <section id="master-hero">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="row flex-md-row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-sm-1">
                <div class="col order-md-1 px-4">
                    <img src="img/logo.png"
                        alt="master-hero" class="img-fluid mb-3" width="400">
                </div>
                <div class="col d-flex justify-content-center align-items-center order-md-2 mt-3">
                    <div style="color:#54b5d3;">
                        <h1 class="display-6" style="font-family: cambria; font-weight:800;"> Selamat Datang di Pelayanan Pengaduan
                            Sekolah !</h1>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <p id="formulir-pengaduan" class="my-5 mb-5" style="overflow: hidden;">.</p>
    </section>
    <section id="formulir-pengaduan">
        <div class="container px-4 rounded" style="height: 100vh;">
            <div class="row justify-content-center align-items-center shadow rounded" style="color: #4e6b4d;">
                <div class="col-md-6 col-sm-6">
                    <div class="d-flex justify-content-center align-items-center">
                        <h2>Formulir Data Pengaduan</h2>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 rounded px-5 py-4">
                    <form id="formulir">
                        @csrf
                        <input type="hidden" value="pending" class="hidden" id="status" name="status">
                        <div class="input-control my-1">
                            <label for="kategori" class="my-2">Kategori Aspirasi  </label>
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="Fasilitas">Fasilitas</option>
                                <option value="Kebersihan">Kebersihan</option>
                                <option value="Kebersihan">Pendidikan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="input-control my-1">
                            <label for="name" class="my-2">Nama Lengkap  </label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="input-control my-1">
                            <label for="alamat" class="my-2">Alamat Lengkap  </label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="input-control my-1">
                            <label for="aspirasi" class="my-2">Isi  </label>
                            <input type="text" class="form-control" id="aspirasi" name="aspirasi">
                        </div>
                        <div class="input-control my-1">
                            <label for="keterangan" class="my-2">Keterangan Detail  </label>
                            <textarea name="keterangan" id="keterangan" cols="20" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="input-control my-1">
                            <label for="gambar_kejadian" class="my-2">Photo  </label>
                            <input type="file" class="form-control" id="gambar_kejadian" name="gambar_kejadian">
                        </div>
                    </form>
                    <button class="btn btn-success my-4 px-4 py-2 text-white" id="submitBtn"
                        style="float: right !important;">Submit</button>
                </div>
            </div>
        </div>
    </section>
    <div class="container" id="history">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-10 col-sm-12">
                <h1 class="my-4" style="text-align: center;color:#54b5d3;">Histori Aspirasi</h1>
                <form id="searchForm">

                    <div class="col-md-5 offset-md-7"> 
                        <div class="input-group mb-3">
                            <input type="text" class="form-control search-input border border-success" placeholder="Search By Id..."
                                aria-label="Search" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="button"
                                    id="searchByIdButton">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="laporanTable" class="table table-bordered border-success border-2">
                            <thead class="border border-light">
                                <tr style="text-align: center;">
                                    <th class=" text-light" style="background-color: #54b5d3;">No</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Kategori</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Nama</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Alamat</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Isi</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Keterangan</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Gambar</th>
                                    <th class=" text-light" style="background-color: #54b5d3;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporan as $key=>$data)
                                    <tr style="text-align: center;" data-id="{{ $data->id }}" class="data-row">
                                        <td hidden>{{ $data->id }}</td>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->kategori }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->aspirasi }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td><img src="{{ asset($data->gambar_kejadian) }}" alt=""
                                                width="50">
                                        </td>
                                        <td>
                                            <b>
                                                <span
                                                    class="badge rounded-pill py-2 px-4
                                                            @if ($data->status == 'pending') bg-danger
                                                            @elseif($data->status == 'progress') bg-warning
                                                            @elseif($data->status == 'done') bg-success @endif">
                                                    {{ $data->status }}
                                                </span>
                                            </b>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#searchByIdButton").click(function() {
            var searchId = $(".search-input").val().trim();

            $(".data-row").each(function() {
                var rowId = $(this).data("id");

                if (searchId === "" || rowId.toString() === searchId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#submitBtn").click(function() {
            var formData = new FormData($("#formulir")[0]);
            $.ajax({
                type: "POST", 
                url: "/submit-form", 
                data: formData, 
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: "Data Berhasil Terkirim !",
                        icon: "success",
                        timer: 1500,
                        didClose: () => {
                            setTimeout(function() {
                                    location.reload();
                                },
                                1000
                            ); 
                        }
                    });
                },
                error: function(error) {
                   
                    console.log(error);
                    
                    alert("Terjadi kesalahan saat mengirim formulir.");
                }
            });
        });
    });
</script>

</html>
