<?php

class Crud
{
    protected $Connection;
    protected $Connectiondb;

    function __construct()
    {
        $this->Connection = new Connection();
        $this->Connectiondb = $this->Connection->connect();
    }
    function ShowTable()
    {
    
    }
    function Add($name, $email, $type)
    {
        try {
            $this->Connectiondb->beginTransaction();
            $query = 'INSERT INTO user (name, email, type_user) VALUES (:name, :email, :type)';     
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':type', $type);
            $sql->execute();
            $this->Connectiondb->commit();
            echo "Se ha añadido con exito.";
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo 'error: ' . $e;
        }
    }
    function Edit($Id, $name, $email, $type)
    {
        try {
            $this->Connectiondb->beginTransaction();
            $query = 'UPDATE user SET (name = :name, email = :email, type_user= :type WHERE id_user = $Id';     
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':type', $type);
            $sql->execute();
            $this->Connectiondb->commit();
            echo "Se ha añadido con exito.";
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo 'error: ' . $e;
        }
    }
    function ShowEdit()
    {
    }
    function Delete($Id)
    {
        try {
            $query = 'DELETE From user WHERE id = :id';
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':id', $Id);
            $sql->execute();

            echo "Se ha borrado con exito.";
        } catch (Exception $e) {
            //Reconocer un error y revertir los cambios
            $this->Connectiondb->rollBack();
            echo 'error: ' . $e;
        }
    }
}
