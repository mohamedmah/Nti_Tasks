<?php

require './classes/database.php';
require './classes/validator.php';

$conn  = new DataBase;

$sql = "SELECT * FROM blog";
$result = $conn->DoQuery($sql);


?>

<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>action</th>
            </tr>
     <?php 
          while($row = $result->fetch_assoc()){
     ?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['title'];?></td>
              <td><?php echo $row['content'];?></td>
               <td> <img src="./uploads/<?php echo $row['image'];?>"> </td>
                <td>
                    <a href='delete.php?id=<?php echo $row['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit.php?id=<?php echo $row['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                </td>

            </tr>
   <?php } ?>
      
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>