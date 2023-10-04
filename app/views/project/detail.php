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
                <h4 class="card-title">To Do List</h4>
                <div class="card-list-button"><button type="submit" class="submit tombolTambahData" id="create">Tambah</button></div>
            </div>
            <div class="body-table">
                <table class="table">
                    <thead>
                        <tr class="th-color">
                            <th></th>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Kode Project</th>
                            <th>Tugas</th>
                            <th>Kode Tim</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["todolist"] as $i => $row) : ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label for="form-check-label">
                                            <input name="status" type="checkbox" data-id="<?= $row['id'] ?>" data-keterangan="<?= $row['keterangan'] ?>" <?= $row['keterangan'] == "Selesai" ? "checked" : "" ?> class="form-check-input">
                                        </label>
                                    </div>
                                </td>
                                <td><?=  $i + 1?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['nama_project'] ?></td>
                                <td><?= $row['tugas'] ?></td>
                                <td><?= isset($row['nama_user']) ? $row['nama_user'] : 'Tidak ada nama user'; ?></td>
                                <td><span class="ket <?= $row['keterangan'] == "Selesai" ? 'success-badge outline-success' : 'warning-badge outline-warning'?>"><?= $row['keterangan'] ?></span></td>
                                <td>
                                    <div class="actionbtn">
                                        <a href="<?= BASEURL; ?>/project/ubah/<?= $row['id']; ?>" class="edit-link tampilModalUbah" data-id="<?= $row['id']; ?>">
                                            <div class="actioneditbtn">
                                                <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                            </div>
                                        </a>
                                        <a href="<?= BASEURL; ?>/project/hapus/<?= $row['id']; ?>" onclick="return confirm('yakin ingin menghapus?')">
                                            <div class="actiondeletelistbtn">
                                                <span class="remove-todo fa-solid fa-circle-xmark" style="color: #ffffff;"></span>
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
                            <a class="page__numbers" href="<?= BASEURL;?>/project/detail/<?= $data['kode_project']?>/<?php echo $i; ?>"><?php echo $i; ?></a>
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
        <h3 id="formModalLabel">Create Todolist</h3>
        <form action="<?= BASEURL; ?>/todolist/tambah/<?= $data['kode_project']?>" method="POST">
            <input type="text" name="kode_project" hidden value="<?= $data['kode_project']; ?>" class="form-control-modal" required>
            
            <div class="form-group-modal">
                <label for="keterangan"><b>Keterangan</b>:</label>
                <select id="keterangan" name="keterangan" class="form-control-modal">
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tanggal</b></label>
                <input type="date" name="tanggal" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tugas</b></label>
                <input type="text" name="tugas" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="kode_user"><b>Kode User</b></label>
                <select name="id_user" id="id_user" class="form-control-modal">
                    <option value="" selected hidden>Pilih Anggota</option>
                    <option value="<?= $data['project']['id_user']; ?>"><?= $data['project']['nama_user']; ?> (Pemimpin)</option>
                    <?php foreach ($data['tims'] as $user) : ?>
                        <option value="<?= $user['id_user']; ?>"><?= $user['nama_user']; ?></option>
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
        <h3 id="formModalLabel">Edit Project</h3>
        <form action="<?= BASEURL; ?>/todolist/ubah/<?= $data['kode_project']?>" method="POST">
        <input type="text" name="kode_project" id="edit_kode_project" hidden value="<?= $data['kode_project']; ?>" class="form-control-modal" > 
        <input type="text" name="id" id="edit_id" hidden class="form-control" > 
            <div class="form-group-modal">
                <label for="keterangan"><b>Keterangan</b>:</label>
                <select id="edit_keterangan" name="keterangan" class="form-control-modal">
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tanggal</b></label>
                <input type="date" name="tanggal" id="edit_tanggal" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>Tugas</b></label>
                <input type="text" id="edit_tugas" name="tugas" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="kode_user"><b>Kode User</b></label>
                <select name="id_user" id="edit_id_user" class="form-control-modal">
                    <option value="" selected hidden>Pilih Anggota</option>
                    <option value="<?= $data['project']['id_user']; ?>"><?= $data['project']['nama_user']; ?> (Pemimpin)</option>
                    <?php foreach ($data['tims'] as $user) : ?>
                        <option value="<?= $user['id_user']; ?>"><?= $user['nama_user']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tombol Save -->
            <div class="form-group-modal buttons">
                <button class="btn btn-success" type="submit" id="save">Save</button>
                <button class="btn btn-danger" id="update_close" type="button" id="close">Close</button>
            </div>
        </form>
    </div>
</div>
<!-- </div> -->



<script defer>
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
            const id = link.getAttribute("data-id");

            update_model.style.display = "flex";
        });
    });

    $('.tampilModalUbah').on('click', function() {
        const id = $(this).data('id');
        console.log(id);
    $.ajax({
        url: '<?= BASEURL ?>/todolist/getubah',
        data: {
            id: id
        },
        method: 'POST',
        dataType: 'json',
        success: (ress) => {
            console.log(ress);
            $("#edit_id").val(ress.id);
            $("#edit_kode_project").val(ress.kode_project);
            $("#edit_keterangan").val(ress.keterangan);
            $("#edit_tanggal").val(ress.tanggal);
            $("#edit_tugas").val(ress.tugas);
            $("#edit_id_user").val(ress.id_user);
        },
        error: function(xhr, status, error) {
            console.error(xhr.status + ': ' + xhr.statusText);
            console.error(error);
        }
    });
});




$('input[name="status"]').each((i , data) => {
    
    $(data).on("change", () => {
        const rowKet = $('.ket')[i]

        if($(rowKet).html() == "Proses"){
            $(rowKet).html("Selesai")
            $(rowKet).removeClass("warning-badge outline-warning")
            $(rowKet).addClass("success-badge outline-success")
        }else {
            $(rowKet).html("Proses")
            $(rowKet).removeClass("success-badge outline-success")
            $(rowKet).addClass("warning-badge outline-warning")
        }

        const id = $(data).data("id")
        const keterangan = $(data).data("keterangan")
        
        $.ajax({
            url: '<?= BASEURL ?>/todolist/setKeterangan',
            data: {
                id,
                keterangan
            },
            method: 'POST',
            success: (ress) => {
                console.log(ress);
            },
            
        });
    })
})





</script>

</body>

</html>