@extends('main')
@section('konten')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3>Pesanan</h3>
</div>

<!-- Content Row -->
<div class="">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-2">
            <!-- isi page pesanan -->
            @for ($i = 0; $i < 3; $i++) <div class="col">
                <div class="card card-pesanan mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="card-title card-title-pesanan">Kode Pesanan</h5>
                            <p class="card-text card-text-pesanan">BCGVja</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="card-title card-title-pesanan">Tgl Pesanan</h5>
                            <p class="card-text card-text-pesanan">12 November 2023</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="card-title card-title-pesanan">Harga Total</h5>
                            <p class="card-text card-text-pesanan">-</p>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="card-title card-title-pesanan">Status</h5>
                            <p class="card-text card-text-pesanan">Menunggu</p>
                        </div>
                        <!-- button rincian -->
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <button type="button" class="btn btn-rincian w-100 w-md-50 mb-2 mb-md-0 me-md-1"
                                data-bs-toggle="modal" data-bs-target="#exampleModal1">Rincian Pesanan</button>
                            @include('pesanan.rincian_pesanan')
                            <button type="button" class="btn btn-konfirmasi w-100 w-md-50 ms-md-1"
                                data-bs-toggle="modal" data-bs-target="#exampleModal2">Konfirmasi</button>
                            @include('pesanan.konfirmasi_pesanan')
                        </div>
                    </div>
                </div>
        </div>
        @endfor
    </div>
</div>
</div>
@endsection