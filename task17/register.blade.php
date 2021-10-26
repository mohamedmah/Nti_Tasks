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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <h2>Register</h2>
    <form  action="{{ url('/submit')  }}"   method="post"   enctype ="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text"  name="name"   value="{{ old('name') }}" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email"   name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password"   name = "password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text"   name="address" value="{{ old('address') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your address">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Linkedin account</label>
            <input type="url"   name="url" value="{{ old('url') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Linkedin url">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="radio"   name="gender" value="male"  >
            <label for="male">Male</label>
            <input type="radio"   name="gender" value="female" >
            <label for="female">Female</label>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
