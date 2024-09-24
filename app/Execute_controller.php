<?php
include  'controllers/Crud_controller.php';
include  'Connection.php';

$Crud = new Crud();

if(isset($_POST['Search'])){
    $Crud->ShowTable($_POST['Search']);
}

if (isset($_POST['Name'], $_POST['Document'], $_POST['Type'])) {
    $Crud->Add($_POST['Name'], $_POST['Document'], $_POST['Type']);
}

if(isset($_POST['Delete'])){
    $Crud->Delete($_POST['Delete']);
}


if(isset($_POST['ShowEdit'])){
    $Crud->ShowEdit($_POST['ShowEdit']);
}

if (isset($_POST['NameEdit'], $_POST['DocumentEdit'], $_POST['TypeEdit'], $_POST['IdEdit'])) {
    $Crud->Edit($_POST['IdEdit'],$_POST['NameEdit'], $_POST['DocumentEdit'], $_POST['TypeEdit']);
}