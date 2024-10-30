document.addEventListener('DOMContentLoaded', () => {
    const searchInput = $('#Search'); 
    if (searchInput.length) { 
        searchInput.on('input', ShowTable); 
    }
    ShowTable();

    $('#CreateButton').on('click', function (event) {
        event.preventDefault();
        CreateUser();
    });
    $('#DeleteButton').on('click', function (event) {
        event.preventDefault();
        DeleteUser();
    });
    $('#ShowEditButton').on('click', function (event) {
        event.preventDefault();
        ShowEdit();
    });
    $('#EditButton').on('click', function (event) {
        event.preventDefault();
        EditUser();
    });
});

function AlertWindows(icon = "info", title = "Información", text = "") {
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
    const search = $('#Search').val() || "";
    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: { action: "ShowTable", Search: search },
        success: function (response) {
            $('#data').html(response);
        },
        error: function (e) {
            AlertWindows("error", "Error", "No se pudo cargar la tabla.");
            console.error("Error en ShowTable:", e);
        },
    });
    return false;
}

function ShowEdit() {
    const Edit = $('#DataTable').serialize();
    const numberMatch = Edit.match(/SelectUser=(\d+)/);
    if (!numberMatch) {
        AlertWindows("error", "Edición", "No se ha seleccionado un usuario válido para editar.");
        return false;
    }
    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: { action: "ShowEdit", ShowEdit: numberMatch[1] },
        dataType: 'json',
        success: function (response) {
            if (response) {
                $('#IdUserEdit').val(response.r0);
                $('#NameEdit').val(response.r1);
                $('#DocumentEdit').val(response.r2);
                $('#TypeEdit').val(response.r3);
                $('#NameEdit, #DocumentEdit, #TypeEdit, #EditButton').prop('disabled', false);
            } else {
                AlertWindows("error", "Registro", "Error en la respuesta del servidor.");
            }
        },
        error: function (xhr) {
            AlertWindows("error", "Registro", "No se pudo cargar la información de edición.");
            console.error("Error en ShowEdit:", xhr);
        },
    });
    return false;
}

function CreateUser() {
    const Name = $('#NameRegister').val();
    const Document = $('#DocumentRegister').val();
    const Type = $('#TypeRegister').val();

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: { action: "CreateUser", Name: Name, Document: Document, Type: Type },
        dataType: 'json',
        success: function (response) {
            $('#NameRegister, #DocumentRegister, #TypeRegister').val('');
            AlertWindows(response.r1, "Registro", response.r2);
            ShowTable();
        },
        error: function (e) {
            AlertWindows("error", "Registro", "No se pudo crear el usuario.");
            console.error("Error en CreateUser:", e);
        },
    });
    return false;
}

function EditUser() {
    const Name = $('#NameEdit').val();
    const Document = $('#DocumentEdit').val();
    const Type = $('#TypeEdit').val();
    const idEdit = $('#IdUserEdit').val();

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: { action: "EditUser", NameEdit: Name, DocumentEdit: Document, TypeEdit: Type, IdEdit: idEdit },
        dataType: 'json',
        success: function (response) {
            $('#NameEdit, #DocumentEdit, #TypeEdit, #IdUserEdit').val('').prop('disabled', true);
            $('#EditButton').prop('disabled', true);
            AlertWindows(response.r1, "Editar", response.r2);
            ShowTable();
        },
        error: function (e) {
            AlertWindows("error", "Editar", "No se pudo editar el usuario.");
            console.error("Error en EditUser:", e);
        },
    });
    return false;
}

function DeleteUser() {
    const Delete = $('#DataTable').serialize();
    const numberMatch = Delete.match(/SelectUser=(\d+)/);

    if (!numberMatch) {
        AlertWindows("error", "Eliminar", "No se ha seleccionado un usuario válido para eliminar.");
        return false;
    }

    $.ajax({
        url: "app/Execute_controller.php",
        type: "POST",
        data: { action: "DeleteUser", Delete: numberMatch[1] },
        dataType: 'json',
        success: function (response) {
            AlertWindows(response.r1, "Borrar", response.r2);
            ShowTable();
        },
        error: function (e) {
            AlertWindows("error", "Borrar", "No se pudo eliminar el usuario.");
            console.error("Error en DeleteUser:", e);
        },
    });
    return false;
}