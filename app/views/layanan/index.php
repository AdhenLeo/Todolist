<div class="list-table">
    <div class="card-listtable">
        <div class="body-list">
            <div class="card-list-flex">
            <h4 class="card-title">Layanan</h4>
            <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
            </div>
            <div class="body-table">
                <table class="table">
                    <thead>
                        <tr class="th-color">
                            <th>Id</th>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['layanan'] as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $row['nama_layanan'] ?></td>
                        <td>Rp.<?= number_format(intval($row['harga']), 2, '.', ',') ?></td>
                        
                        <td>
                            <div class="actionbtn">
                                <a href="<?= BASEURL;?>/layanan/ubah/<?= $row['kode_layanan'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['kode_layanan'];?>">
                                    <div class="actioneditbtn">
                                        <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                    </div>
                                </a>
                                <a href="<?= BASEURL;?>/layanan/hapus/<?= $row['kode_layanan'];?>" onclick="return confirm('yakin ingin menghapus?')">
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
                        <a class="page__numbers" href="<?= BASEURL;?>/layanan/<?php echo $i; ?>"><?php echo $i; ?></a>
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
            <h3>Create Layanan</h3>
            <form action="<?= BASEURL; ?>/layanan/tambah" method="POST">
                <!-- Formulir input untuk nama dan harga -->
                <div class="form-group-modal">
                    <label for="nama_layanan"><b>Nama Layanan</b></label>
                    <input type="text" placeholder="Enter your name" name="nama_layanan" id="nama_layanan" class="form-control-modal" required>
                </div>
                <div class="form-group-modal">
                    <label for="harga"><b>Harga Layanan</b></label>
                    <input type="number" placeholder="Enter the price" name="harga" id="harga" class="form-control-modal" required>
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
            <form action="<?= BASEURL; ?>/layanan/ubah" method="POST" id="form-edit">
                <h3>Update Student</h3>
                <div class="form-group-modal">
                    <label for=""><b>Masukan nama layanan</b></label>
                    <input type="text" name="nama_layanan" placeholder="Enter your name" id="edit_nama_layanan" class="form-control-modal">
                    <input type="hidden" name="kode_layanan" placeholder="Id" id="kode_layanan" class="form-control-modal">
                </div>
                <div class="form-group-modal">
                    <label for=""><b>Masukan Harga Layanan</b></label>
                    <input type="number" name="harga" placeholder="Enter your name" id="edit_harga" class="form-control-modal">
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
                const kode_layanan = link.getAttribute("data-id");

                update_model.style.display = "flex";
            });
        });
        
        $('.tampilModalUbah').on('click', function() {
            const kode_layanan = $(this).data('id');
            // console.log(kode_layanan);
            $.ajax({
            url: '<?= BASEURL ?>/layanan/getubah',
            data: {kode_layanan : kode_layanan},
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#edit_nama_layanan').val(data.nama_layanan);
                $('#edit_harga').val(data.harga);
                $('#kode_layanan').val(data.kode_layanan);
            },
            error: function(xhr, status, error) {
            console.error(xhr.status + ': ' + xhr.statusText);
            console.error(error);
        }
        });
        });

        











        // console.log("Notifikasi sukses: " + success.style.display);
        // console.log("Notifikasi gagal: " + error.style.display);

        // success.style.display = "none"; // Sembunyikan notifikasi sukses
        // error.style.display = "none"; // Sembunyikan notifikasi gagal

        // if (success && error) {
        //     if (success.classList.contains('alert-success')) {
        //         success.style.display = "block"; // Tampilkan notifikasi sukses
        //     } else if (error.classList.contains('alert-danger')) {
        //         error.style.display = "block"; // Tampilkan notifikasi gagal
        //     }
        // }


        
    </script>

</body>

</html>
