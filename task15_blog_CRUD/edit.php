<?php

require './classes/validator.php';
require './classes/blog.php';

$validate = new validator;
# Fech Old Data .... 

$id = $_GET['id'];

if(!$validate->validate($id,5)){

  echo "Invalid Id";

  header("Location: index.php");

}

$conn  = new DataBase;
$sql = "SELECT * FROM blog where id = $id";
$result = $conn->DoQuery($sql);
$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    

    $title       =  $validate->clean($_POST['title']);
    $content       =  $validate->clean($_POST['content']);

    # Image Details ..... 
    $ImageTmp   =  $_FILES['image']['tmp_name'];
    $ImageName  =  $_FILES['image']['name'];
    $ImageSize  =  $_FILES['image']['size'];
    $ImageType  =  $_FILES['image']['type'];

    $TypeArray = explode('/', $ImageType);


    $errors = [];

    # Name Validation 
    if (!$validate->validate($title, 1)) {
        $errors['Name'] = " Name Field Required";
    }

    # Content Validation 
    if (!$validate->validate($content, 3, 50)) {
        $errors['Content'] = " Content Field Required";
    }

    # Image Validation 

    if (!$validate->validate($ImageName, 1)) {
        $errors['image'] = "Image Field Required";
    } elseif (!$validate->validate($TypeArray[1], 6)) {
        $errors['image'] = "Invalid Extension";
    }


    if (count($errors) > 0) {
       print_r($errors);
    } else {

        // code 
        $FinalName = rand(1, 100) . time() . '.' . $TypeArray[1];
        $disPath = './uploads/' . $FinalName;

        if (move_uploaded_file($ImageTmp, $disPath)) {
            // code .... 
            $blog = new Blog($title, $content, $FinalName);
            $blog->edit($id);

            if ($blog) {
                echo 'Data updated';
                header("Location: index.php");
                exit();
            } else {
                echo 'Error Try Again';
                
            }
        } else {
            echo 'Error Try Again';
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>


                <div class="container">
                    <form action="edit.php?id=<?php echo $row['id'];?>" method="post" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Title" value="<?php echo $row['title'];?>">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>

                            <textarea name="content" class="form-control" id="exampleInputName" cols="30" rows="10"><?php echo $row['content'];?></textarea>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input type="file" name="image">
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>


            </div>
        </main>
    </div>
</body>

</html>