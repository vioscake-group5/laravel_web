@extends('main')
@section('konten')

    <div class="">  
            <div class="container">
                <h3 class="mb-5">Selamat Datang, Admin</h3> 
                
                <div class="button-action"> 
                    <!-- <a href="/tambah_katalog" class=" btn-tambah-katalog" type="submit">+ desain katalog</a> -->
                    <button type="button" class="btn btn-tambah-katalog" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        + desain katalog
                    </button>
                    @include('menu_page_katalog.tambah_katalog')
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 py-2">
                    @foreach ($katalogs as $katalog)
                        <div class="col-lg-3 col-md-6">
                            <a href="/edit_katalog/{{ $katalog->id }}" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#myModal-{{$katalog->id}}">
                                <div class="card card-katalog">
                                    <img src="{{ asset('katalog_foto/'.$katalog->foto) }}" class="card-img-top" alt="..." name="foto">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Deskripsi</h5>
                                        <p class="card-text">{{ $katalog->deskripsi }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @include('menu_page_katalog.edit_katalog')
                </div>

        </div>  
    </div>

    
  



@endsection