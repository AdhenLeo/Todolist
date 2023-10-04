<div class="list-table">
                <div class="card-listtable">
                    <div class="body-list">
                        <div class="card-list-flex">
                        <h4 class="card-title">Usaha</h4>
                        <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
                        </div>
                        <div class="body-table">
                            <table class="table">
                                <thead>
                                    <tr class="th-color">
                                        <th>Kode Usaha</th>
                                        <th>Jenis Usaha</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['usaha'] as $row): ?>
                                <tr>
                                    <td><?= $row['kode_jenis_usaha'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td>
                                        <div class="actionbtn">
                                            <a href="<?= BASEURL;?>/usaha/ubah/<?= $row['kode_jenis_usaha'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['kode_jenis_usaha'];?>">
                                                <div class="actioneditbtn">
                                                    <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/usaha/hapus/<?= $row['kode_jenis_usaha'];?>" onclick="return confirm('yakin ingin menghapus?')">
                                                <div class="actiondeletebtn">
                                                    <span class="fa-solid fa-trash-can" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="pagination">
                                <ul class="page">
                                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                    <a class="page__numbers" href="<?= BASEURL;?>/usaha/<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- create jenis usaha modal -->

<!-- <div class="container"> -->
<div class="modal" id="create-student">
  <div class="modal-body">
    <h3 id="formModalLabel">Create Usaha</h3>
    <form action="<?= BASEURL; ?>/usaha/tambah" method="POST">
      <!-- Formulir input untuk nama dan harga -->
      <div class="form-group-modal">
        <label for="nama"><b>Nama Usaha</b></label>
        <input type="text" placeholder="Masukan nama usaha" name="nama" id="nama" class="form-control-modal" required>
      </div>
      <!-- Tombol Save -->
      <div class="form-group-modal buttons">
        <button class="btn btn-success" type="submit" id="save">Save</button>
        <button class="btn btn-danger" type="button" id="close">Close</button>
      </div>
    </form>
  </div>
</div>
<!-- </div> -->
<!-- edit jenis usaha modal -->
<div class="modal" id="update-student">
  <div class="modal-body">
    <form action="<?= BASEURL; ?>/usaha/ubah" method="POST" id="form-edit">
      <h3>Update Student</h3>
      <div class="form-group-modal">
        <label for=""><b>Masukan nama layanan</b></label>
        <input type="text" name="nama" placeholder="Enter your name" id="edit_nama" class="form-control-modal">
        <input type="hidden" name="kode_jenis_usaha" placeholder="Id" id="kode_jenis_usaha" class="form-control-modal">
      </div>

      <div class="form-group-modal buttons">
        <button class="btn btn-success" id="update" type="submit">Update</button>
        <button class="btn btn-danger" type="button" id="update_close">Close</button>
      </div>
    </form>
  </div>
</div>
<script>
  let create = document.querySelector("#create");
  let modal = document.querySelector("#create-student");
  let update_model = document.querySelector("#update-student");
  let close = document.querySelector("#close")
  let update_close = document.querySelector("#update_close")
  let save = document.querySelector("#save");
  let update = document.querySelector("#update");
  let success = document.querySelector(".alert-success")
  let error = document.querySelector(".alert-danger")


  create.addEventListener("click", () => {
    modal.style.display = "flex";
  });
  close.addEventListener("click", () => {
    modal.style.display = "none";
  })
  update_close.addEventListener("click", () => {
    update_model.style.display = "none";

  })

  const editLinks = document.querySelectorAll(".edit-link");

  editLinks.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const kode_jenis_usaha = link.getAttribute("data-id");

      update_model.style.display = "flex";
    });
  });

  $('.tampilModalUbah').on('click', function() {
    const kode_jenis_usaha = $(this).data('id');
    // console.log(kode_jenis_usaha);
    $.ajax({
      url: '<?= BASEURL ?>/usaha/getubah',
      data: {
        kode_jenis_usaha: kode_jenis_usaha
      },
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#edit_nama').val(data.nama);
        $('#kode_jenis_usaha').val(data.kode_jenis_usaha);
      },
      error: function(xhr, status, error) {
        console.error(xhr.status + ': ' + xhr.statusText);
        console.error(error);
      }
    });
  });
</script>

</body>

</html>