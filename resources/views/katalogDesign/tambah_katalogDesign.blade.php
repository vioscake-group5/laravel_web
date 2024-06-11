<link rel="stylesheet" href="{{ asset('css/tambah_katalog.css') }}">

<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Katalog</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambah_katalog_action" enctype="multipart/form-data" class="dropzone">
          @csrf
              <div class="mb-3">
                <div class="container d-flex justify-content-center"  style="width: 18rem;">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="nama_kue"  
                      placeholder="Nama Kue" 
                      required
                  />
                </div>  
              </div>

              <div class="mb-3">
                <div class="container d-flex justify-content-center"  style="width: 18rem;">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="deskripsi"  
                      placeholder="Tuliskan Detail Deskripsi " 
                      required
                  />
                </div>  
              </div>  

              <div class="mb-3">
                <div class="container d-flex justify-content-center"  style="width: 18rem;">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="harga"  
                      placeholder="Harga Kue" 
                      required
                  />
                </div>  
              </div>

              <div class="container d-flex justify-content-center mb-3">
                <div class="card_tambah_katalog" style="width: 18rem;">
                  <!-- <img src="../image/kue.png" class="mb-2" alt="..."> -->
                  <input 
                      type="file" 
                      class="form-control" 
                      id="exampleInputEmail1" 
                      name="gambar" 
                      placeholder="Masukkan Foto" 
                      required
                  />
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



