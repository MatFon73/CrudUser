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
    function ShowTable($search)
    {
        try {
            $this->Connectiondb->beginTransaction();
            if ($search == "") {
                $query = "SELECT user.id_user, user.name, user.document, typeuser.type FROM user INNER JOIN typeuser ON user.type_user = typeuser.id_type";
            } else {
                $query = "SELECT user.id_user, user.name, user.document, typeuser.type FROM user INNER JOIN typeuser ON user.type_user = typeuser.id_type WHERE user.document LIKE :search";
            }

            $sql = $this->Connectiondb->prepare($query);
            if ($search != "") {
                $sql->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }
            $sql->execute();
            $arrDatas = $sql->fetchAll(PDO::FETCH_ASSOC);

            echo "<table class='table table-striped'><thead>
                    <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Nombre</th>
                    <th scope='col'>Documento</th>
                    <th scope='col'>Tipo</th>
                    </tr></thead><tbody>";
            foreach ($arrDatas as $response) {
                echo "<tr>
                    <td><input type='radio' id='SelectUser' name='SelectUser' value='" . $response["id_user"] . "' '></td>
                    <td style='display: none;'><input type='text' id='SelectUser' value='" . $response["id_user"] . "'></td>
                    <td>" . $response["name"] . "</td>
                    <td>" . $response["document"] . "</td>
                    <td>" . $response["type"] . "</td>
                    </tr>";
            }

            echo "</tbody></table>";
            $this->Connectiondb->commit();
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo  $e->getMessage();
        }
    }
    function ShowEdit($id)
    {

        try {
            $this->Connectiondb->beginTransaction();

            $query = "SELECT * FROM user WHERE id_user = :id";
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $arrData = $sql->fetch(PDO::FETCH_ASSOC);

            if ($arrData) {
                echo json_encode([
                    'r0' => $arrData['id_user'],
                    'r1' => $arrData['name'],
                    'r2' => $arrData['document'],
                    'r3' => $arrData['type_user']
                ]);
            } else {
                echo json_encode(['r1' => 'error', 'r2' => 'Usuario no encontrado']);
            }

            $this->Connectiondb->commit();
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo json_encode(['r1' => 'error', 'r2' => $e->getMessage()]);
        }
    }
    function Add($name, $document, $type)
    {
        try {
            $this->Connectiondb->beginTransaction();
            $query = 'INSERT INTO user (name, document, type_user) VALUES (:name, :document, :type)';
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':document', $document);
            $sql->bindParam(':type', $type);
            $sql->execute();

            echo json_encode(['r1' => 'success', 'r2' => 'Registro con Exitoso.']);
            $this->Connectiondb->commit();
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo json_encode(['r1' => 'error', 'r2' =>  $e->getMessage()]);
        }
    }
    function Edit($id, $name, $document, $type)
    {
        try {
            $this->Connectiondb->beginTransaction();
            $query = 'UPDATE user SET name = :name, document = :document, type_user = :type WHERE id_user = :id';
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':id', $id);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':document', $document);
            $sql->bindParam(':type', $type);
            $sql->execute();

            echo json_encode(['r1' => 'success', 'r2' => 'Editado con Exitoso.']);
            $this->Connectiondb->commit();
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo json_encode(['r1' => 'error', 'r2' =>  $e->getMessage()]);
        }
    }
    function Delete($id)
    {
        try {
            $this->Connectiondb->beginTransaction();
            $query = 'DELETE FROM user WHERE id_user = :id';
            $sql = $this->Connectiondb->prepare($query);
            $sql->bindParam(':id', $id);
            $sql->execute();

            echo json_encode(['r1' => 'success', 'r2' =>  "Eliminado con exito."]);
            $this->Connectiondb->commit();
        } catch (Exception $e) {
            $this->Connectiondb->rollBack();
            echo json_encode(['r1' => 'error', 'r2' => $e->getMessage()]);
        }
    }
}
