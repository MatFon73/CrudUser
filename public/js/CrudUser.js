
function AlertWindows(icon, title, text) {
    return Swal.fire({
        icon: icon,
        title: title,
        text: text,
        customClass: {
            title: 'swal2-title-custom',
            confirmButton: 'swal2-confirm-custom'
        }
    });
}
function ShowTable() {
    let Search = document.getElementById('Search');
    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: "Search=" + Search.value,
        success: function (response) {
            $('#data').html(response);
        },
        error: function (e) {
            $('#data').html(e);
        },
    });
    return false;
}
function ShowEdit() {
    let Edit = $('#DataTable').serialize();
    let numberMatch = Edit.match(/SelectUser=(\d+)/);

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: "ShowEdit=" + numberMatch[1],
        dataType: 'json',
        success: function (response) {
            $('#IdUserEdit').val(response.r0);
            $('#NameEdit').val(response.r1);
            $('#DocumentEdit').val(response.r2);
            $('#TypeEdit').val(response.r3);
            document.getElementById('NameEdit').removeAttribute('disabled');
            document.getElementById('DocumentEdit').removeAttribute('disabled');
            document.getElementById('TypeEdit').removeAttribute('disabled');
            document.getElementById('EditButton').removeAttribute('disabled');
        },
        error: function (e) {
            AlertWindows("error", "Registro", e.r2);
        },
    });
    return false;
}
function CreateUser() {
    let Name = document.getElementById('NameRegister');
    let Document = document.getElementById('DocumentRegister');
    let Type = document.getElementById('TypeRegister');

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: "Name=" + Name.value + "&Document=" + Document.value + "&Type=" + Type.value,
        dataType: 'json',
        success: function (response) {
            AlertWindows(response.r1, "Registro", response.r2)
            ShowTable();
        },
        error: function (e) {
            AlertWindows("error", "Registro", e);
        },
    });
    return false;
}
function EditUser() {
    let Name = document.getElementById('NameEdit');
    let Document = document.getElementById('DocumentEdit');
    let Type = document.getElementById('TypeEdit');
    let idEdit = document.getElementById('IdUserEdit');

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: "NameEdit=" + Name.value + "&DocumentEdit=" + Document.value + "&TypeEdit=" + Type.value + "&IdEdit=" + idEdit.value,
        dataType: 'json',
        success: function (response) {
            document.getElementById('NameEdit').value = '';
            document.getElementById('DocumentEdit').value = '';
            document.getElementById('TypeEdit').value = '';
            document.getElementById('IdUserEdit').value = '';
            document.getElementById('NameEdit').setAttribute('disabled', true);
            document.getElementById('DocumentEdit').setAttribute('disabled', true);
            document.getElementById('TypeEdit').setAttribute('disabled', true);
            document.getElementById('EditButton').setAttribute('disabled', true);

            AlertWindows(response.r1, "Editar", response.r2);
            ShowTable();
        },
        error: function (e) {
            console.log(idEdit.value)
            AlertWindows("error", "Editar", e.r2);
        },
    });
    return false;
}
function Delete() {
    let Delete = $('#DataTable').serialize();
    let numberMatch = Delete.match(/SelectUser=(\d+)/);

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: "Delete=" + numberMatch[1],
        dataType: 'json',
        success: function (response) {
            AlertWindows(response.r1, "Borrar", response.r2);
            ShowTable();
        },
        error: function (e) {
            AlertWindows("error", "Borrar", e.r2);
        },
    });
    return false;
}