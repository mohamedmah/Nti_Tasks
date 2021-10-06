<?php


function clean($input){

    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = trim($input);

    return $input;

}



if($_SERVER['REQUEST_METHOD'] == "POST"){

$name =  clean($_POST['name']); 
$password =  clean($_POST['password']);
$email   =  clean($_POST['email']);
$address   =  clean($_POST['address']);
$link   =  clean($_POST['url']);


  # Name Validation ... 
  if(empty($name)){
      echo '* Name Required';
  }

  # Password Validation ... 
  if(empty($password)){
      echo '*  Password Required';
  }

    # Email Validation ... 
    if(empty($email)){
      echo '*  Email Required';
  }

  # Address Validation ... 
  if(empty($address)){
    echo '*  Address Required';
}

# Linkedin Validation ... 
if(empty($link)){
    echo '*  link Required';
}


  if(!empty($name) && !empty($password) && !empty($email) && !empty($address) && !empty($link))
   {
       echo 'Valid Data';

   }



   $errors = [];

   # Name Validation ... 
  if(empty($name)){
     $errors['Name'] = "Field Required";
  }

  # Password Validation ... 
  if(empty($password)){
      $errors['Password'] = "Field Required";
  }

    # Email Validation ... 
    if(empty($email)){
      $errors['Email'] = "Field Required";
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors['Email'] = "Invalid Email";
  }

  # Address Validation ... 
  if(empty($address)){
    $errors['Addresss'] = "Field Required";
}

# Link Validation ... 
if(empty($link)){
    $errors['Link'] = "Field Required";
}




  if(count($errors) > 0){
      foreach($errors as $key => $val ){
          echo '* '.$key.' :  '.$val.'<br>';
      }
  }else{
      echo 'Valid Data';
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

<div class="container">
<h2>Register</h2>
<form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"   enctype ="multipart/form-data">



<div class="form-group">
  <label for="exampleInputEmail1">Name</label>
  <input type="text"  name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>


<div class="form-group">
  <label for="exampleInputEmail1">Email</label>
  <input type="email"   name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
</div>

<div class="form-group">
  <label for="exampleInputPassword1">Password</label>
  <input type="password"   name = "password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>

<div class="form-group">
  <label for="exampleInputAddress">Address</label>
  <input type="address"   name="adderss" class="form-control" id="exampleInputAddress" placeholder="Address">
</div>

<div class="form-group">
<label for="Gender">Gender</label>
    <input type='radio' name='gender' value='male'></input>
    <input type='radio' name='gender' value='female'>
</div>


<div class="form-group">
  <label for="exampleInputLinkedin">Linkedin Link</label>
  <input type="url"   name = "url"  class="form-control" id="exampleInputURL" placeholder="url">
</div>


<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>