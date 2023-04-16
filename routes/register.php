<?php
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <title>Sign Up - Online Polling System</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <link rel="stylesheet" href="../resources/Jquery/jquery-ui.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Jquery/jquery-ui.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

<div id="headerSection" class="sticky-top">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-2">
                <a href="../"><button class="btn text-white"><i class="fa fa-chevron-circle-left"></i> Back</button> </a>
            </div>
            <div class="col-sm-6 pt-3">
                <p id="brand">Online Polling System</p>
            </div>
            <div class="col-md-2">
                <a href="../"><button class="btn text-white"><i class="fa fa-user-circle"></i> Sign In</button> </a>
            </div>
            <div class="col-md-2">
                <a href="../admin.php"><button class="btn text-white"><i class="fa fa-user-circle"></i> Admin</button> </a>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 text-center">
                    <form id="regForm" enctype="multipart/form-data">
                        <div class="form-row py-1">
                            <div class="col-md-3"></div>
                            <div class="form-group col-md-6 text-white">
                                <h4 style="font-weight: 600;">Create new account</h4><br>
                                <input name="name" type="text" class="form-control" placeholder="Name" required><br>
                                <input name="email" type="email" class="form-control" placeholder="Email " required><br>
                                <input name="mobile" id="mobile" type="text" class="form-control" placeholder="Mobile No" required><br>
                                <input name="pass" type="password" class="form-control" placeholder="Password" required><br>
                                <input name="cpass" type="password" class="form-control" placeholder="Confirm password" required><br>
                                <input type="submit" class=" btn btn-dark" id="btnn" name="regbtn" value="Register"><br>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#regForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url : '../api/register.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                    if(data == 1){
                        swal({
                            title: "Registration successfull!",
                            text: "You are registered on online polling panel!",
                            icon: "success",
                            button: "OK!",
                    }).then((value)=>{
                        window.location = '../';
                    });
                    }
                    else if(data==3){
                        swal({
                            title: "Passwords do not match!",
                            text: "Password and Confirm password does not match!",
                            icon: "error",
                            button: "OK!",
                    });
                    }
                    else if(data==4){
                        swal({
                            title: "User already exists!",
                            text: "Mobile number is already taken. Try another!",
                            icon: "error",
                            button: "OK!",
                    });
                    }
                    else if(data==5){
                        swal({
                            title: "Invalid Mobile No!",
                            text: "Only 10 digits required!",
                            icon: "error",
                            button: "OK!",
                    });
                    }
                    else{
                        swal({
                            title: "Error!",
                            text: "Some error occured!",
                            icon: "error",
                            button: "OK!",
                    });
                    }
                }
            });
        });
    });

</script>

</body>

</html>