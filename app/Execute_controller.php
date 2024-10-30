<?php
require '../vendor/autoload.php';
require  'controllers/Crud_controller.php';
require  'Connection.php';

$Crud = new Crud();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'ShowTable':
            if (isset($_POST['Search'])) {
                $Crud->ShowTable($_POST['Search']);
            } else {
                echo "Error: Falta el parámetro 'Search'.";
            }
            break;
        case 'CreateUser':
            if (isset($_POST['Name'], $_POST['Document'], $_POST['Type'])) {
                $Crud->Add($_POST['Name'], $_POST['Document'], $_POST['Type']);
            } else {
                echo "Error: Faltan parámetros para agregar un registro.";
            }
            break;
        case 'DeleteUser':
            if (isset($_POST['Delete'])) {
                $Crud->Delete($_POST['Delete']);
            } else {
                echo "Error: Falta el parámetro 'Delete'.";
            }
            break;
        case 'ShowEdit':
            if (isset($_POST['ShowEdit'])) {
                $Crud->ShowEdit($_POST['ShowEdit']);
            } else {
                echo "Error: Falta el parámetro 'ShowEdit'.";
            }
            break;
        case 'EditUser':
            if (isset($_POST['IdEdit'], $_POST['NameEdit'], $_POST['DocumentEdit'], $_POST['TypeEdit'])) {
                $Crud->Edit($_POST['IdEdit'], $_POST['NameEdit'], $_POST['DocumentEdit'], $_POST['TypeEdit']);
            } else {
                echo "Error: Faltan parámetros para editar un registro.";
            }
            break;
        default:
            echo "Error: Acción no válida.";
            break;
    }
} else {
    echo "Error: No se ha definido ninguna acción.";
}
