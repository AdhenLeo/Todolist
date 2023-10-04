<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Usaha</title>
    <link rel="stylesheet" href="http://localhost/cmsmvc/public/css/style.css">
    
</head>
<body>
    <div class="container">
        <div class="alerts">
            <div class="alert alert-success">gg</div>
            <div class="alert alert-danger">ee</div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary" id="create">Create</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                   
                </tbody>
            </table>
        </div>
    </div>

    <!-- create jenis usaha modal -->

    <!-- <div class="container"> -->
    <div class="modal" id="create-student">
        <div class="modal-body">
            <h3>Create Student</h3>
            <div class="form-group">
                <label for=""><b>Enter your Name</b></label>
                <input type="text" placeholder="Enter your name" id="nama" class="form-control" required>
            </div>
            <div class="form-group buttons">
                <button class="btn btn-success" type="submit" id="save">Save</button>
                <button class="btn btn-danger" type="submit" id="close">Close</button>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <!-- edit jenis usaha -->
    <div class="modal" id="update-student">
        <div class="modal-body">
            <h3>Update Student</h3>
            <div class="form-group">
                <label for=""><b>Enter your Name</b></label>
                <input type="text" placeholder="Enter your name" id="edit_nama" class="form-control">
                <input type="hidden" placeholder="Id" id="kode_jenis_usaha" class="form-control">
            </div>
            <div class="form-group buttons">
                <button class="btn btn-success" id="update" type="submit">Update</button>
                <button class="btn btn-danger" type="submit" id="update_close">Close</button>
            </div>
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


        // CREATE JENIS USAHA
save.addEventListener("click", async () => {
    try {
        let nama = document.querySelector("#nama").value;
        
        if (nama.trim() === "") {
            alert("Tolong isi nama");
            return;
        }

        const res = await fetch("insert.php", {
            method: "POST",
            body: JSON.stringify({
                "nama": nama
            }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            nama = "";
            modal.style.display = "none";
            getJenisusaha(); // Refresh data
            document.querySelector("#nama").value = "";
            setTimeout(() => {
                success.style.display = "none";
                success.innerText = "";
            }, 1000);
        } else {
            error.style.display = "flex";
            error.innerText = output.message;
            setTimeout(() => {
                error.style.display = "none";
                error.innerText = "";
            }, 1000);
        }
    } catch (error) {
        error.style.display = "flex";
        error.innerText = error.message;
        setTimeout(() => {
            error.style.display = "none";
            error.innerText = "";
        }, 1000);
    }
});

                const getJenisusaha = async () => {
            try {
                const tbody = document.querySelector("#tbody");
                let tr = "";
                const res = await fetch("select.php", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                });

                const output = await res.json();
                if (output.empty === "empty") {
                    tr = "<tr>Record Not Found</td>"
                } else {
                    for (var i in output) {
                        tr += `
                    <tr>
                    <td>${parseInt(i) + 1}</td>
                    <td>${output[i].nama}</td>
                    <td><button onclick="editJenisusaha(${output[i].kode_jenis_usaha})" class="btn btn-success">Edit</button></td>
                    <td><button onclick="deleteStudent(${output[i].kode_jenis_usaha})"  class="btn btn-danger">Delete</button></td>
                    </tr>`
                    }
                }
                tbody.innerHTML = tr;
            } catch (error) {
                console.log("error " + error)
            }
        }
        getJenisusaha();
                
        // edit students

        const editJenisusaha = async (kode_jenis_usaha) => {
            update_model.style.display = "flex";

            const res = await fetch(`edit.php?kode_jenis_usaha=${kode_jenis_usaha}`, {
                method: "GET",
                headers: { 'Content-Type': 'application/json' }
            })
            const output = await res.json();
            if (output["empty"] !== "empty") {
                for (var i in output) {
                    document.querySelector("#kode_jenis_usaha").value = output[i].kode_jenis_usaha
                    document.querySelector("#edit_nama").value = output[i].nama
                }
            }

        }

        // update student

        update.addEventListener("click", async () => {
        let kode_jenis_usaha = document.querySelector("#kode_jenis_usaha").value;
        let name = document.querySelector("#edit_nama").value;

        const res = await fetch("update.php", {
            method: "POST",
            body: JSON.stringify({
                "kode_jenis_usaha": kode_jenis_usaha,
                "nama": name, // Use the correct variable name here
            }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            name = ""; // Reset the name variable
            update_model.style.display = "none";
            getJenisusaha(); // Call the correct function to refresh the data
            setTimeout(() => {
                success.style.display = "none";
                success.innerText = "";
            }, 1000);
        } else {
            error.style.display = "flex";
            error.innerText = output.message;
            setTimeout(() => {
                error.style.display = "none";
                error.innerText = "";
            }, 1000);
        }
    });


        // delete student

        const deleteStudent = async (kode_jenis_usaha) => {
            const res = await fetch("delete.php?kode_jenis_usaha=" + kode_jenis_usaha, {
                method: "GET",
            });
            const output = await res.json();
            if (output.success) {
                success.style.display = "flex";
                success.innerText = output.message;
                setTimeout(() => {
                    success.style.display = "none";
                    success.innerText = "";
                }, 1000)
                getJenisusaha();
                getTotalCount();
            } else {
                error.style.display = "flex";
                error.innerText = output.message;
                setTimeout(() => {
                    error.style.display = "none";
                    error.innerText = "";
                }, 1000)
            }
        }

                
    </script>
</body>

</html>
