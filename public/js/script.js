// $(function() {

//     $('.tombolTambahData').on('click', function() {
//         $('#formModalLabel').html('Tambah Data Mahasiswa');
//         $('.modal-footer button[type=submit]').html('Tambah Data');
//         $('#nama').val('');
//         $('#nrp').val('');
//         $('#email').val('');
//         $('#jurusan').val('');
//         $('#id').val('');
//     });


//     $('.tampilModalUbah').on('click', function() {

//         $('#formModalLabel').html('Ubah Data Mahasiswa');
//         $('.modal-footer button[type=submit]').html('Ubah Data');
//         $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');

//         const id = $(this).data('id');

//         $.ajax({
//             url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
//             data: {id : id},
//             method: 'post',
//             dataType: 'json',
//             success: function(data) {
//                 $('#nama').val(data.nama);
//                 $('#nrp').val(data.nrp);
//                 $('#email').val(data.email);
//                 $('#jurusan').val(data.jurusan);
//                 $('#id').val(data.id);
//             }
//         });

//     });

// });



(function ($) {
  'use strict';
  $(function () {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    $('.todo-list-add-btn').on("click", function (event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
        todoListItem.append("<li><div class='form-check-todo'><label class='form-check-label-todo'><input class='checkbox' type='checkbox'/>" + item + "</label></div><i class='remove fa-solid fa-circle-xmark'></i></li>");
        todoListInput.val("");
      }

    });

    todoListItem.on('change', '.checkbox', function () {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
      } else {
        $(this).attr('checked', 'checked');
      }

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('click', '.remove', function () {
      $(this).parent().remove();
    });

  });
})(jQuery);
// todolist js //

// dropdown profile menu //
const profile = document.querySelector('.profile');
const dropdown = document.querySelector('.dropdown__wrapper');

profile.addEventListener('click', () => {
  dropdown.classList.remove('none');
  dropdown.classList.toggle('hide');
})

document.addEventListener("click", (event) => {
  const isClickInsideDropdown = dropdown.contains(event.target);
  const isProfileClicked = profile.contains(event.target);

  if (!isClickInsideDropdown && !isProfileClicked) {
    dropdown.classList.add('hide');
    dropdown.classList.add('dropdown__wrapper--fade-in');
  }
});
// dropdown profile menu //

// dropdown menu sidebar //
function toggleDropdown(element) {
  var dropdownMenu = element.nextElementSibling;

  if (dropdownMenu.style.maxHeight) {
    dropdownMenu.style.maxHeight = null; // Tutup dropdown
  } else {
    dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + "px"; // Buka dropdown
  }
}
// dropdown menu sidebar //



// Mendapatkan elemen tombol toggle
const toggleSidebarButton = document.querySelector('.navbar-toggler');

// Mendapatkan elemen sidebar
const sidebar = document.getElementById('sidebar');

// Fungsi untuk menampilkan atau menyembunyikan sidebar
function toggleSidebar() {
  sidebar.classList.toggle('hidden'); // Menambah atau menghapus class 'hidden' pada sidebar
}

// Menambahkan event listener ke tombol toggle
toggleSidebarButton.addEventListener('click', toggleSidebar);