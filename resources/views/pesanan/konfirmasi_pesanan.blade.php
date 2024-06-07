<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #DEAE78;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rincian Pesanan</h5>

            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Kode Pesanan</h1>
                            <p class="card-text card-text-pesanan flex-end"> BCGVja</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Nama </h1>
                            <p class="card-text card-text-pesanan flex-end"> Aulia ummatul </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Tanggal Pesanan</h1>
                            <p class="card-text card-text-pesanan flex-end"> 12 November 2023</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Variant Base Cake</h1>
                            <p class="card-text card-text-pesanan flex-end"> Brownies</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Ukuran Cake</h1>
                            <p class="card-text card-text-pesanan flex-end"> 12 cm</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Topping</h1>
                            <p class="card-text card-text-pesanan flex-end"> lilin, coklat</p>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h1 class="card-title card-title-pesanan flex-start">Status</h1>
                            <p class="card-text card-text-pesanan flex-end"> Menunggu </p>
                        </div>
                        <div class="mb-4">
                            <h1 class="card-title card-title-pesanan flex-start">Design Default</h1>
                            <img src="../image/kue.png" alt="" class="w-50">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h1 class="card-title card-title-pesanan flex-start">Sub Total</h1>
                            <p class="card-text card-text-pesanan flex-end"> Rp.200000 </p>
                        </div>
                        <div class="mb-4">
                            <h1 class="card-title card-title-pesanan flex-start">Design Default</h1>
                            <img src="../image/kue.png" alt="" class="w-50">
                        </div>
                        <div class=" mb-4">
                            <h1 class="card-title card-title-pesanan flex-start">Catatan</h1>
                            <textarea name="catatanpesanan" id="CatatanPesanan" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Harga Total</h1>
                            <p class="card-text card-text-pesanan flex-end"> - </p>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title card-title-pesanan flex-start">Masukkan Harga</h1>
                            <input type="number" value="Masukkan harga desain custome">
                        </div>
                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="background-color: #6B5048; color: #ffffff;">Close</button>
                <button type="button" class="btn btn-secondary delete-btn" data-bs-dismiss="modal" data-id="123"
                    style="background-color: #6B5048; color: #ffffff;">Konfirmasi</button>

            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
          $(document).on('click', '.delete-btn', function(e){
              e.preventDefault();
              var katalogId = $(this).data('id');  // Mengambil ID katalog dari atribut data-id
              
              Swal.fire({
                  title: "Harga Desain Dikonfirmasi?",
                  text: "Harga Desain Masih Belum Termasuk Harga lainnya",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Ya, Konfirmasi"
              }).then((result) => {
                  if (result.isConfirmed) {
                      Swal.fire({
                          title: "Harga Dikonfirmasi",
                          text: "Harga sudah dimasukkan",
                          icon: "success"
                      }).then(() => {
                          // Redirect to the delete URL with the katalogId
                          window.location.href = "/pesanan" + katalogId;
                      });
                  }
              });
          });
      });
</script>