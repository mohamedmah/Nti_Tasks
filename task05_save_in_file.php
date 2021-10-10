<?php

//first step *** clean function()
function clean($input)
{
    $input = htmlspecialchars($input); //stop html code.
    $input = trim($input);  //Strip unnecessary characters (extra space, tab, newline) from the user input data.
    $input = stripslashes($input); //Remove backslashes (\) from the user input data because attakers use it.

    return $input;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = clean($_POST['name']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $url = clean($_POST['url']);
    $address = clean($_POST['address']);



    $errors = [];

    # Name Validation ... 
    if (empty($name)) {
        $errors['Name'] = "Field Required";
    } elseif (is_numeric($name)) {
        $errors['name'] = "Field must be string";
    }

    # Email Validation ... 
    if (empty($email)) {
        $errors['Email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Invalid Email";
    }

    # Password Validation ... 
    if (empty($password)) {
        $errors['Password'] = "Field Required";
    } elseif (strlen($password) <= 6) {
        $errors['password'] = "Field must be greater than 6 letters";
    }

    # URL Validation ... 
    if (empty($email)) {
        $errors['URL'] = "Field Required";
    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors['URL'] = "Invalid URL";
    }

    # Address Validation ... 
    if (empty($address)) {
        $errors['Address'] = "Field Required";
    } elseif (strlen($address) <= 10) {
        $errors['password'] = "Field must be greater than 10 chars";
    }

    # Gender Validation ... 
    if (isset($_POST['gender'])) { //to check gender found or not found
        $gender = clean($_POST['gender']);
    } else {
        $errors['gender'] = "Field Required";
    }



    //print errors
    if (count($errors) > 0) {
        foreach ($errors as $key => $val) {
            echo '* ' . $key . ' :  ' . $val . '<br>';
        }
    } else {
        echo 'Valid Data';

        //collect data in file
        $dataInput = "$name.$email.$password.$address.$url.$gender\n";  

        // create file and read it
        $file = fopen("data.txt",'a') or die('Unable to open file');
      fwrite($file,$dataInput);

    
      $file = fopen("data.txt",'r') or die('Unable to open file');
            while(!feof($file)) {
                 echo  fgets($file).'<br>';
  
              }
      fclose($file);
      
    }



    if (!empty($_FILES['cv']['name'])) {

        $fileTmp   =  $_FILES['cv']['tmp_name'];
        $fileName  =  $_FILES['cv']['name'];
        $fileSize  =  $_FILES['cv']['size'];
        $fileType  =  $_FILES['cv']['type']; 

        $allowdEx  = ['pdf'];

        $typeArray = explode('/', $fileType);

        if (in_array($typeArray[1], $allowdEx)) {

            echo $finalName = rand(1, 50) . time() . '.' . $typeArray[1];

            $disPath = './uploads/'. $finalName;

            if (move_uploaded_file($fileTmp, $disPath)) {
                echo 'File Uploaded';
            } else {
                echo 'Error Try Again';
            }
        } else {
            echo 'Not Allowed Extension';
        }
    } else {
        echo 'CV Required';
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
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="url">Website URL</label>
                <input type="url" id="url" name="url" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control">
            </div>
            <br><br>

            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="radio" id="gender" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="gender" name="gender" value="female">
                <label for="female">Female</label>
            </div>

            <div class="form-group">
                <label for="cv">CV</label>
                <input type="file" id="cv" name="cv" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</body>

</html>