<div class="list-table">
                <div class="card-listtable">
                    <div class="body-list">
                        <div class="card-list-flex">
                        <h4 class="card-title">Akun</h4>
                        <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
                        </div>
                        <div class="body-table">
                            <table class="table">
                                <thead>
                                    <tr class="th-color">
                                        <th>Kode Customer</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>CP</th>
                                        <th>Nomor Telp</th>
                                        <th>Email</th>
                                        <th>Kode Usaha</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['customer'] as $row): ?>
                                <tr>
                                    <td><?= $row['kode_customer'] ?></td>
                                    <td><?= $row['nama_perusahaan'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['cp'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td>
                                        <div class="actionbtn">
                                            <a href="<?= BASEURL;?>/customer/ubah/<?= $row['kode_customer'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['kode_customer'];?>">
                                                <div class="actioneditbtn">
                                                    <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/customer/hapus/<?= $row['kode_customer'];?>" onclick="return confirm('yakin ingin menghapus?')">
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
                        </div>
                    </div>
                </div>
            </div>

<!-- create jenis usaha modal -->

<div class="modal" id="create-student">
    <div class="modal-body" id="banyak">
        <h3 id="formModalLabel">Create Customer</h3>
        <form action="<?= BASEURL; ?>/customer/tambah" method="POST">
            <div class="form-group-modal">
                <label for="nama_perusahaan"><b>Nama Perusahaan:</b></label>
                <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control-modal" placeholder="Masukan nama perusahaan" required>
            </div>
            <div class="form-group-modal">
                <label for="alamat"><b>Alamat:</b></label>
                <input type="text" id="alamat" name="alamat" class="form-control-modal" placeholder="Masukan alamat" required>
            </div>
            <div class="form-group-modal">
                <label for="cp"><b>CP:</b></label>
                <input type="text" id="cp" name="cp" class="form-control-modal" placeholder="Masukan cp" required>
            </div>
            <div class="form-group-modal">
                <label for="phone"><b>Nomor Telepon:</b></label>
                <input type="number" id="phone" name="phone" class="form-control-modal" placeholder="Masukan nomor telepon" required>
            </div>
            <div class="form-group-modal">
                <label for="email"><b>Email:</b></label>
                <input type="email" id="email" name="email" class="form-control-modal" placeholder="Masukan email" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Nama Pimro</b></label>
                <select name="kode_jenis_usaha" id="kode_jenis_usaha" class="form-control-modal">
                    <option value="" hidden selected>Pilih Usaha</option>
                    <?php foreach ($data['usaha'] as $usaha) : ?>
                        <option value="<?= $usaha['kode_jenis_usaha']; ?>">
                            <?= $usaha['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tombol Save -->
            <div class="form-group-modal buttons">
                <button class="btn btn-success" type="submit" id="save">Save</button>
                <button class="btn btn-danger" type="button" id="close">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- edit jenis usaha modal -->
<div class="modal" id="update-student">
    <div class="modal-body">
        <form action="<?= BASEURL; ?>/customer/ubah" method="POST">
            <h3>Update Student</h3>
            <div class="form-group-modal">
                <label for="nama_perusahaan"><b>Nama Perusahaan:</b></label>
                <input type="text" id="edit_nama_perusahaan" name="nama_perusahaan" class="form-control-modal" placeholder="Masukan nama perusahaan" required>
                <input type="hidden" id="kode_customer" name="kode_customer" class="form-control-modal" placeholder="Masukan nama perusahaan" required>
            </div>
            <div class="form-group-modal">
                <label for="alamat"><b>Alamat:</b></label>
                <input type="text" id="edit_alamat" name="alamat" class="form-control-modal" placeholder="Masukan alamat" required>
            </div>
            <div class="form-group-modal">
                <label for="cp"><b>CP:</b></label>
                <input type="text" id="edit_cp" name="cp" class="form-control-modal" placeholder="Masukan cp" required>
            </div>
            <div class="form-group-modal">
                <label for="phone"><b>Nomor Telepon:</b></label>
                <input type="number" id="edit_phone" name="phone" class="form-control-modal" placeholder="Masukan nomor telepon" required>
            </div>
            <div class="form-group-modal">
                <label for="email"><b>Email:</b></label>
                <input type="email" id="edit_email" name="email" class="form-control-modal" placeholder="Masukan email" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Usaha</b></label>
                <select name="kode_jenis_usaha" id="edit_kode_jenis_usaha" class="form-control-modal">
                    <?php foreach ($data['usaha'] as $user) : ?>
                        <option value="<?= $user['kode_jenis_usaha']; ?>"><?= $user['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <!-- Tombol Save -->
            <div class="form-group-modal buttons">
                <button class="btn btn-success" type="submit" id="save">Save</button>
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
            const kode_customer = link.getAttribute("data-id");

            update_model.style.display = "flex";
        });
    });

    $('.tampilModalUbah').on('click', function() {
        const kode_customer = $(this).data('id');
        console.log(kode_customer);
        $.ajax({
            url: '<?= BASEURL ?>/customer/getubah',
            data: {
                kode_customer: kode_customer
            },
            method: 'post',
            dataType: 'json',
            success: (data) => {
                console.log(data)
                $("#kode_customer").val(data.kode_customer)
                $("#edit_nama_perusahaan").val(data.nama_perusahaan)
                $("#edit_alamat").val(data.alamat)
                $("#edit_cp").val(data.cp)
                $("#edit_email").val(data.email)
                $("#edit_phone").val(data.phone)
                $("#edit_kode_jenis_usaha").val(data.kode_jenis_usaha)
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