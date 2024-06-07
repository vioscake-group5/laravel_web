<link rel="stylesheet" href="{{ asset('css/tambah_katalog.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


@foreach ($katalogs as $k)
<div class="modal" id="myModal-{{$k->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Katalog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/update_katalog/'.$k->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="container d-flex justify-content-center mb-3">
                        <div class="card_tambah_katalog" style="width: 18rem;">
                            <img id="modal-foto-{{$k->id}}" src="{{ asset('katalog_foto/'.$k->foto) }}" class="mb-2" alt="Foto Katalog" style="max-width: 18rem; max-height: 12rem">
                            <input type="file" class="form-control" id="exampleInputFile-{{$k->id}}" name="foto" placeholder="Unggah Foto Baru">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="container d-flex justify-content-center"  style="width: 18rem;">
                            <input type="text" class="form-control" name="deskripsi" id="modal-deskripsi-{{$k->id}}" placeholder="Tuliskan Detail Deskripsi" value="{{$k->deskripsi}}">
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/hapus_katalog/{{ $k->id }}" class="btn btn-danger delete-btn" data-id="{{ $k->id }}" ><i class="bi bi-trash-fill"></i></a>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>

@endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $(document).on('click', '.delete-btn', function(e){
            e.preventDefault();
            var katalogId = $(this).data('id');

         
            Swal.fire({
                title: "Yakin Data Akan Dihapus?",
                text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Data Telah Terhapus!",
                    text: "Data Berhasil Terhapus",
                    icon: "success"
                }).then(() => {
                        // Redirect to the delete URL with the katalogId
                        window.location.href = "/hapus_katalog/" + katalogId;
                    });
                }

                });


        });

    });
</script>
