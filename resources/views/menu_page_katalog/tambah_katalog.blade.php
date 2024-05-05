<link rel="stylesheet" href="{{ asset('css/tambah_katalog.css') }}">


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambah_katalog_action" enctype="multipart/form-data">
          @csrf
              <div class="container d-flex justify-content-center mb-3">
                  <div class="card_tambah_katalog" style="width: 18rem;">
                    <!-- <img src="../image/kue.png" class="" alt="..."> -->
                    <input type="file" class="form-control" id="exampleInputEmail1" name="foto" placeholder="Masukkan Foto">
                  </div>
              </div>

              <div class="mb-3">
                <div class="container d-flex justify-content-center"  style="width: 18rem;">
                  <input type="text" class="form-control" name="deskripsi"  placeholder="Tuliskan Detail Deskripsi ">
                </div>  
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>  
      </div>
    </div>
  </div>
</div>

