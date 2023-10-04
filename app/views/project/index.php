<div class="container">
    <div class="alerts">
        <?php if (Flasher::has("msg_success")) : ?>
            <div class="alert alert-success">
                <p><?= Flasher::get("msg_success") ?></p>
            </div>
        <?php endif ?>

        <?php if (Flasher::has("msg_error")) : ?>
            <div class="alert alert-danger">
                <p><?= Flasher::get("msg_error") ?></p>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="list-table">
                <div class="card-listtable">
                    <div class="body-list">
                        <div class="card-list-flex">
                        <h4 class="card-title">project</h4>
                        <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
                        </div>
                        <div class="body-table">
                            <table class="table">
                                <thead>
                                    <tr class="th-color">
                                        <th>Kode project</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Nama Layanan</th>
                                        <th>Nama Project</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Pemimpin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['project'] as $row): ?>
                                <tr>
                                    <td><?= $row['kode_project'] ?></td>
                                    <td><?= isset($row['nama_perusahaan']) ? $row['nama_perusahaan'] : 'Tidak ada nama perusahaan'; ?></td>
                                    <td><?= $row['kode_layanan'] ?></td>
                                    <td><?= $row['nama_project'] ?></td>
                                    <td><?= $row['tanggal_awal'] ?></td>
                                    <td><?= $row['tanggal_akhir'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td>
                                        <div class="actionbtn">
                                            <a href="<?= BASEURL;?>/project/detail/<?= $row['kode_project'];?>">
                                                <div class="actiondetailbtn">
                                                    <span class="fa-solid fa-calendar-week" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/project/ubah/<?= $row['kode_project'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['kode_project'];?>">
                                                <div class="actioneditbtn">
                                                    <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/project/hapus/<?= $row['kode_project'];?>" onclick="return confirm('yakin ingin menghapus?')">
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
                                    <a class="page__numbers" href="<?= BASEURL;?>/project/<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- create jenis usaha modal -->

<!-- <div class="container"> -->
<!-- modal create -->
<div class="modal" id="create-student">
    <div class="modal-body">
        <h3 id="formModalLabel">Create Project</h3>
        <form action="<?= BASEURL; ?>/project/tambah" method="POST">
            <!-- Formulir input untuk nama dan harga -->
            <div class="form-group-modal">
                <label for="kode_customer"><b>Nama Perusahaan</b></label>
                <select name="kode_customer" id="kode_customer" class="form-control-modal">
                    <?php foreach ($data['customer'] as $customer) : ?>
                        <option value="<?= $customer['kode_customer']; ?>"><?= $customer['nama_perusahaan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for="kode_layanan"><b>Layanan</b></label>
                <select name="kode_layanan" id="kode_layanan" class="form-control-modal">
                    <?php foreach ($data['layanan'] as $layanan) : ?>
                        <option value="<?= $layanan['kode_layanan']; ?>"><?= $layanan['nama_layanan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Nama Project</b></label>
                <input type="text" name="nama_project" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b> Tanggal awal</b></label>
                <input type="date" name="tanggal_awal" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tanggal akhir</b></label>
                <input type="date" name="tanggal_akhir" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Nama Pimro</b></label>
                <select name="id_user" id="id" class="form-control-modal">
                    <option value="" hidden selected>Pilih Pimpro</option>
                    <?php foreach ($data['user'] as $user) : ?>
                        <option <?= in_array($user['id'], $data['pimpro_id']) ? "hidden" : "" ?> value="<?= $user['id']; ?>"><?= $user['nama']; ?> || <?= $user['id'] ?></option>
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

<!-- modal edit -->
<div class="modal" id="update-student">
    <div class="modal-body">
        <h3 id="formModalLabel">Update Project</h3>
        <form action="<?= BASEURL; ?>/project/ubah" method="POST">
            <!-- Formulir input untuk nama dan harga -->
            <input type="hidden" name="id_project" id="id_project">
            <div class="form-group-modal">
                <label for="kode_project"><b>Nama Perusahaan</b></label>
                <select name="kode_project" id="edit_kode_project" class="form-control-modal">
                    <?php foreach ($data['project'] as $project) : ?>
                        <option value="<?= $project['kode_project']; ?>"><?= $project['nama_perusahaan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for="kode_layanan"><b>Layanan</b></label>
                <select name="kode_layanan" id="edit_kode_layanan" class="form-control-modal">
                    <?php foreach ($data['layanan'] as $layanan) : ?>
                        <option value="<?= $layanan['kode_layanan']; ?>"><?= $layanan['nama_layanan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b> Tanggal awal</b></label>
                <input type="date" name="tanggal_awal" id="edit_tanggal_awal" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tanggal akhir</b></label>
                <input type="date" name="tanggal_akhir" id="edit_tanggal_akhir" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Nama Pimro</b></label>
                <select name="id_user" id="edit_id_user" class="form-control-modal">
                    <option value="" hidden selected>Pilih Pimpro</option>
                    <?php foreach ($data['user'] as $user) : ?>
                        <option value="<?= $user['id']; ?>"><?= $user['nama']; ?></option>
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
<!-- </div> -->

<script>
    let create = document.querySelector("#create");
    let modal = document.querySelector("#create-student");
    let close = document.querySelector("#close")
    let update_model = document.querySelector("#update-student");
    let update_close = document.querySelector("#update_close")

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
        const kode_project = $(this).data('id');
        // console.log(kode_project);
        $.ajax({
            url: '<?= BASEURL ?>/project/getubah',
            data: {
                kode_project: kode_project
            },
            method: 'post',
            dataType: 'json',
            success: (data) => {
                console.log(data)
                $("#id_project").val(data.kode_project)
                $("#edit_kode_project").val(data.kode_project)
                $("#edit_kode_layanan").val(data.kode_layanan)
                $("#edit_tanggal_awal").val(data.tanggal_awal)
                $("#edit_tanggal_akhir").val(data.tanggal_akhir)
                $("#edit_id_user").val(data.id_user)
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