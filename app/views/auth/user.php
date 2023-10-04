<div class="container-alert">
        <div class="alerts">
            <?php if (Flasher::has("msg_success")) :?>
            <div class="alert alert-success">
                <p><?= Flasher::get("msg_success")?></p>
            </div>
            <?php endif?>
            
            <?php if (Flasher::has("msg_error")) :?>
            <div class="alert alert-danger">
                <p><?= Flasher::get("msg_error")?></p>
            </div>
            <?php endif?>
        </div>
    </div>



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
                                        <th>First Name </th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data['user'] as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['fname'] ?></td>
                                    <td><?= $row['lname'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['image'] ?></td>
                                    <td><?= $row['role'] ?></td>
                                    
                                    <td>
                                        <div class="actionbtn">
                                            <a href="<?= BASEURL;?>/auth/ubah/<?= $row['id'];?>" class="edit-link tampilModalUbah" data-id="<?= $row['id'];?>">
                                                <div class="actioneditbtn">
                                                    <span class="fa-solid fa-pen-to-square" style="color: #ffffff;"></span>
                                                </div>
                                            </a>
                                            <a href="<?= BASEURL;?>/auth/hapus/<?= $row['id'];?>" onclick="return confirm('yakin ingin menghapus?')">
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

    <!-- <div class="container"> -->
    <div class="modal" id="create-student">
        <div class="modal-body">
            <h3>Create User</h3>
            <form action="<?= BASEURL; ?>/user/register" method="POST">
                <!-- Formulir input untuk nama dan harga -->
                <div class="form-group">
                    <label for="fname"><b>First Name</b></label>
                    <input type="text" placeholder="Enter your name" name="fname" id="fname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lname"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter the price" name="lname" id="lname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter the price" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image"><b>Image</b></label>
                    <input type="text" placeholder="Enter the price" name="image" id="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password"><b>Password</b></label>
                    <input type="text" placeholder="Enter the price" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role"><b>Role</b></label>
                    <input type="password" placeholder="Enter the price" name="role" id="role" class="form-control" required>
                </div>
                <!-- Tombol Save -->
                <div class="form-group buttons">
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
            <form action="<?= BASEURL; ?>/auth/ubah" method="POST" id="form-edit" enctype="multipart/form-data">
                <h3>Update User</h3>
                <div class="form-group">
                    <label for=""><b>Masukan First Name</b></label>
                    <input type="text" name="fname" placeholder="Enter your name" id="edit_fname" class="form-control">
                    <input type="hidden" name="id" placeholder="Id" id="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><b>Masukan Last Name </b></label>
                    <input type="text" name="lname" placeholder="Enter your name" id="edit_lname" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><b>Masukan Email </b></label>
                    <input type="text" name="email" placeholder="Enter your name" id="edit_email" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><b>Masukan Image </b></label>
                    <input type="file" name="image" placeholder="Enter your name" id="edit_image" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><b>Masukan Role </b></label>
                    <input type="text" name="role" placeholder="Enter your name" id="edit_role" class="form-control">
                </div>
                <div class="form-group buttons">
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
                const id = link.getAttribute("data-id");

                update_model.style.display = "flex";
            });
        });
        
        $('.tampilModalUbah').on('click', function() {
            const id = $(this).data('id');
            // console.log(id);
            $.ajax({
            url: '<?= BASEURL ?>/auth/getubah',
            data: {id : id},
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#edit_fname').val(data.fname);
                $('#edit_lname').val(data.lname);
                $('#edit_email').val(data.email);
                $('#edit_role').val(data.role);
                $('#id').val(data.id);
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
