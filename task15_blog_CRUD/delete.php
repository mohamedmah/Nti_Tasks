<?php

require './classes/database.php';
require './classes/validator.php';

$id = $_GET['id'];

$conn  = new DataBase;
$validate = new validator;

if($validate->validate($id,5)){
    $sql = "DELETE FROM blog WHERE id=$id";

    if ($conn->DoQuery($sql)) {
        echo "Record deleted successfully";
        header("Location: index.php");

      } else {
        echo "Error deleting record";
      }

}else{

    echo "Invalid Id";

}


?>