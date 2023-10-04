<div class="container">
    <div class="alerts">
   
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary tombolTambahData" id="create">Create</button>
        </div>
    </div>
</div>
<div class="container">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Kode Project</th>
                    <th>Keterangan</th>
                    <th>Kode Tim</th>
                    <th>detail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($data['todolist'] as $row) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['kode_project'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td><?= $row['kode_tim'] ?></td>

                        <td><a href="<?= BASEURL; ?>/todolist/detail/<?= $row['id']; ?>">Detail</a></td>
                        <td><a href="<?= BASEURL; ?>/todolist/ubah/<?= $row['id']; ?>" class="tampilModalUbah" data-id="<?= $row['id']; ?>">Edit</a></td>
                        <td><a href="<?= BASEURL; ?>/todolist/hapus/<?= $row['id']; ?>" onclick="return confirm('yakin ingin menghapus?')">Hapus</a></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- create jenis usaha modal -->

<!-- <div class="container"> -->
<div class="modal" id="create-student">
    <div class="modal-body">
        <h3 id="formModalLabel">Create Customer</h3>
        <form action="<?= BASEURL; ?>/customer/tambah" method="POST">
            <!-- Formulir input untuk nama dan harga -->
            <div class="form-group-modal">
                <label for=""><b>Masukan nama perusahaan</b></label>
                <input type="text" placeholder="Enter your name" id="nama_perusahaan" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>masukan alamat</b></label>
                <input type="text" placeholder="Enter your name" id="alamat" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>masukan cp</b></label>
                <input type="text" placeholder="Enter your name" id="cp" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>masukan nomor telp</b></label>
                <input type="number" placeholder="Enter your name" id="phone" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for=""><b>masukan email</b></label>
                <input type="email" placeholder="Enter your name" id="email" class="form-control-modal" required>
            </div>
            <div class="form-group-modal">
                <label for="kode_jenis_usaha"><b>Jenis Usaha</b></label>
                <select name="kode_jenis_usaha" id="kode_jenis_usaha" class="form-control-modal">
                    <?php foreach ($data['jenis_usaha'] as $jenis_usaha) : ?>
                        <option value="<?= $jenis_usaha['kode_jenis_usaha']; ?>"><?= $jenis_usaha['nama']; ?></option>
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
<!-- </div> -->

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

    $(function() {

        $('.tombolTambahData').on('click', function() {
            $('#formModalLabel').html('Tambah Data Usaha');
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $('#nama').val('');
            $('#nrp').val('');
            $('#email').val('');
            $('#jurusan').val('');
            $('#id').val('');
        });


        $('.tampilModalUbah').on('click', function() {

            $('#formModalLabel').html('Ubah Data Usaha');
            $('.modal-footer button[type=submit]').html('Ubah Data');
            $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/customer/ubah');

            const id = $(this).data('id');

            $.ajax({
                url: 'http://localhost/phpmvc/public/customer/getubah',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#nama').val(data.nama);
                    $('#nrp').val(data.nrp);
                    $('#email').val(data.email);
                    $('#jurusan').val(data.jurusan);
                    $('#id').val(data.id);
                }
            });

        });

    });
</script>

</body>

</html>