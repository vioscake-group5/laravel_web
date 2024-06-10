<link rel="stylesheet" href="{{ asset('css/tambah_katalog.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


@foreach ($cakes as $cake)
<div class="modal fade" id="myModal-{{$cake['id']}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Katalog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/update_katalog/'.$cake['id'])}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <div class="container d-flex justify-content-center"  style="width: 18rem;">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="nama_kue" 
                                id="modal-deskripsi-{{$cake['id']}}"
                                value="{{$cake['nama_kue']}}">
                        </div>  
                    </div>
                    <div class="mb-3">
                        <div class="container d-flex justify-content-center"  style="width: 18rem;">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="deskripsi" 
                                id="modal-deskripsi-{{$cake['id']}}"
                                value="{{$cake['deskripsi']}}">
                        </div>  
                    </div>
                    <div class="mb-3">
                        <div class="container d-flex justify-content-center"  style="width: 18rem;">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="harga" 
                                id="modal-deskripsi-{{$cake['id']}}"
                                value="{{$cake['harga']}}">
                        </div>  
                    </div>

                    <div class="container d-flex justify-content-center mb-3">
                        <div class="card_tambah_katalog" style="width: 18rem;">
                            <img 
                                id="modal-foto-{{$cake['id']}}" 
                                src="{{ asset('katalog_foto/'.$cake['gambar']) }}" 
                                class="mb-2" alt="Foto Katalog" 
                                style="max-width: 18rem; max-height: 12rem">
                            <input 
                                type="file" 
                                class="form-control" 
                                id="exampleInputFile-{{$cake['id']}}" 
                                name="gambar" 
                                placeholder="Unggah Foto Baru">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a 
                            href="/hapus_katalog/{{ $cake['id'] }}" 
                            class="btn btn-danger delete-btn" 
                            data-id="{{ $cake['id'] }}" >
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </div>
                    
                </form>  
            </div>
        </div>
    </div>
</div>

@endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
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
</script> --}}
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
                    // Get the user's token from session or wherever you store it after login
                    var token = '{{ Session::get('external_token') }}'; // Make sure this is available in your Blade template

                    if (!token) {
                        Swal.fire("Error", "Unauthorized: No token found", "error");
                        return;
                    }

                    $.ajax({
                        url: 'https://vioscake.my.id/api/cakes/' + katalogId,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Data Telah Terhapus!",
                                text: "Data Berhasil Terhapus",
                                icon: "success"
                            }).then(() => {
                                // Optionally remove the deleted item from the DOM or refresh the page
                                location.reload(); // This will refresh the page
                                // Alternatively, remove the item from the DOM
                                // $("#item-" + katalogId).remove();
                            });
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            Swal.fire("Error", "Failed to delete cake: " + errorMessage, "error");
                        }
                    });
                }
            });
        });
    });
</script>

