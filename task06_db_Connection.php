<?php

function returnFile()
{

    if (!empty($_FILES['image']['name'])) {

        $fileTmp   =  $_FILES['image']['tmp_name'];
        $fileName  =  $_FILES['image']['name'];
        $fileSize  =  $_FILES['image']['size'];
        $fileType  =  $_FILES['image']['type'];

        $allowdEx  = ['png', 'jpg'];

        $typeArray = explode('/', $fileType);

        if (in_array($typeArray[1], $allowdEx)) {

            $finalName = rand(1, 50) . time() . '.' . $typeArray[1];

            // $disPath = './uploads/'. $finalName;

            return $finalName;
        } else {
            echo 'Not Allowed Extension';
        }
    } else {
        echo 'image Required';
    }
}







//first step *** clean function()
function clean($input)
{
    $input = htmlspecialchars($input); //stop html code.
    $input = trim($input);  //Strip unnecessary characters (extra space, tab, newline) from the user input data.
    $input = stripslashes($input); //Remove backslashes (\) from the user input data because attakers use it.

    return $input;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = clean($_POST['title']);
    $content = clean($_POST['content']);



    $errors = [];

    # Name Validation ... 
    if (empty($title)) {
        $errors['Title'] = "Field Required";
    } elseif (is_numeric($title)) {
        $errors['title'] = "Field must be string";
    }

    # content Validation ... 
    if (empty($content)) {
        $errors['content'] = "Field Required";
    } elseif (strlen($content) <= 50) {
        $errors['content'] = "Field must be greater than 50 chars";
    }

    //print errors
    if (count($errors) > 0) {
        foreach ($errors as $key => $val) {
            echo '* ' . $key . ' :  ' . $val . '<br>';
        }

    } elseif(returnFile()) {


        //DB connection
        $server = "localhost";
        $dbName = "test_db";
        $dbUser = 'root';
        $dbPassword = '';

        $connection = mysqli_connect($server, $dbUser, $dbPassword, $dbName);
        if ($connection) {
            echo "Successfully connected"."<br>";
        } else {
            die("Error" . mysqli_connect_error());
        }



        $name = returnFile();

        $sql = "insert into articales (title,content,image) values ('$title','$content','$name')";
        $op  =  mysqli_query($connection, $sql);

        if ($op) {
            echo 'Data Inserted';
        } else {
            echo 'Error Try Again';
        }
        # close connection ... 
        mysqli_close($connection);
    }
    else{
echo "failed";
    }
}


?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="content">content</label>
                <input type="text" id="content" name="content" class="form-control">
            </div>
            <br><br>


            <div class="form-group">
                <label for="image">Iamge</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</body>

</html>