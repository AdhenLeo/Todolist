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
                        <h4 class="card-title">Team Project</h4>
                        <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
                        </div>
                        <div class="body-table">
                            <table class="table">
                                <thead>
                                    <tr class="th-color">
                                        <th>Kode tim</th>
                                        <th>Nama project</th>
                                        <th>Nama Job Desk</th>
                                        <th>Nama anggota</th>
                                        <th>Pemimpin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['tim'] as $row) : ?>
                                <tr>
                                    <td><?= $row['kode_tim'] ?></td>
                                    <td><?= $row['nama_project'] ?></td>
                                    <td><?= $row['nama_job_desk_user'] ?></td>
                                    <td><?= $row['nama_user'] ?></td>
                                    <td><?= $row['nama_pemimpin'] ?></td>
                                    <td>
                                        <div class="actionbtn">
                                            <a href="<?= BASEURL;?>/tim/ubah/<?= $row['kode_tim'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['kode_tim'];?>">
                                                <div class="actioneditbtn">
                                                    <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/tim/hapus/<?= $row['kode_tim'];?>" onclick="return confirm('yakin ingin menghapus?')">
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
                                    <a class="page__numbers" href="<?= BASEURL;?>/tim/<?php echo $i; ?>"><?php echo $i; ?></a>
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
        <h3 id="formModalLabel">Create Tim Project</h3>
        <form action="<?= BASEURL; ?>/tim/tambah" method="POST">
            <div class="form-group-modal">
                <label for="kode_project"><b>Kode Project</b></label>
                <select name="kode_project" id="kode_project" class="form-control-modal">
                <option value="" hidden selected>Pilih Kode Project</option>
                    <?php foreach ($data['project'] as $layanan) : ?>
                        <option value="<?= $layanan['kode_project']; ?>"><?= $layanan['nama_project']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Nama Job Desk</b></label>
                <input type="text" name="nama_job_desk_user" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Nama Anggota</b></label>
                <select name="kode_user" id="id" class="form-control-modal">
                    <option value="" hidden selected>Pilih Anggota</option>
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
        <h3 id="formModalLabel">Edit Tim Project</h3>
        <form action="<?= BASEURL; ?>/tim/ubah" method="POST">
            <!-- Formulir input untuk nama dan harga -->
            <input type="hidden" name="kode_tim" id="edit_kode_tim">
            <div class="form-group-modal">
                <label for="kode_project"><b>Kode Project</b></label>
                <select name="kode_project" id="edit_kode_project" class="form-control-modal">
                <option value="" hidden selected>Pilih Kode Project</option>
                    <?php foreach ($data['project'] as $layanan) : ?>
                        <option value="<?= $layanan['kode_project']; ?>"><?= $layanan['kode_project']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Nama Job Desk</b></label>
                <input type="text" name="nama_job_desk_user" id="edit_nama_job_desk_user" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="id"><b>Nama Anggota</b></label>
                <select name="kode_user" id="edit_kode_user" class="form-control-modal">
                    <option value="" hidden selected>Pilih Anggota</option>
                    <?php foreach ($data['user'] as $user) : ?>
                        <option <?= in_array($user['id'], $data['pimpro_id']) ? "hidden" : "" ?> value="<?= $user['id']; ?>"><?= $user['nama']; ?> || <?= $user['id'] ?></option>
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
            const kode_tim = link.getAttribute("data-id");

            update_model.style.display = "flex";
        });
    });

    $('.tampilModalUbah').on('click', function() {
        const kode_tim = $(this).data('id');
        // console.log(kode_tim);
        $.ajax({
            url: '<?= BASEURL ?>/tim/getubah',
            data: {
                kode_tim: kode_tim
            },
            method: 'post',
            dataType: 'json',
            success: (data) => {
                console.log(data)
                $("#edit_kode_tim").val(data.kode_tim)
                $("#edit_kode_project").val(data.kode_project)
                $("#edit_nama_job_desk_user").val(data.nama_job_desk_user)
                $("#edit_kode_user").val(data.kode_user)
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