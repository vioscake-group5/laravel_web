@extends('main')
@section('konten')



<div class="">
    <div class="container">

        <div class="d-flex justify-content-end">
            <div class="button-action">
                <a href="{{ route('katalog') }}" class="btn btn-tambah-katalog">
                    Base Cake
                </a>
            </div>
            <div class="button-action">
                <a href="{{ route('katalog_desain') }}" class="btn btn-tambah-katalog">
                    Design Cake
                </a>
            </div>
        </div>

        <div class="button-action">
            <!-- <a href="/tambah_katalog" class=" btn-tambah-katalog" type="submit">+ desain katalog</a> -->
            <button type="button" class="btn btn-tambah-katalog" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                + Base Katalog
            </button>
            @include('katalog.tambah_katalog')
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 py-2">
            @foreach ($cakes as $cake)
            <div class="col-lg-3 col-md-6">
                <a 
                    href="/edit_katalog/{{ $cake['id'] }}" 
                    class="text-decoration-none" 
                    data-bs-toggle="modal"
                    data-bs-target="#myModal-{{$cake['id']}}"
                >
                    <div class="card card-katalog">
                        <img 
                            src="{{ asset($cake['gambar']) }}" 
                            class="card-img-top" 
                            alt="..."
                            name="foto">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $cake['nama_kue'] }}</h5>
                            <p class="card-text">{{ $cake['deskripsi'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @include('katalog.edit_katalog')
        </div>

    </div>
</div>






@endsection