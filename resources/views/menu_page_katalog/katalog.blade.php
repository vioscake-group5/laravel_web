@extends('main')
@section('konten')
    <div class="">  
            <div class="container">
                <h3 class="mb-5">Selamat Datang, Admin</h3> 

                <div class="button-action"> 
                    <a href="" class=" btn-tambah-katalog" type="submit">+ desain katalog</a>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-4 py-2">
                    <div class="col">
                        <div class="card card-katalog" >
                        <img src="../image/kue.png" class="card-img-top " alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Deskripsi</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div> 
            </div>
        </div>  
    </div>
        

@endsection