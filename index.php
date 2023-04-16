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
  <title>Home - Online Polling System</title>
  <link rel="stylesheet" href="resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/css/stylesheet.css">
    <script src="resources/Jquery/jquery-3.5.1.js"></script>
    <script src="resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/sweetalert.min.js"></script>
</head>

<body>

<div id="headerSection" class="sticky-top">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-sm-8 pt-3">
                <p id="brand">Online Polling System</p>
            </div>
            <div class="col-md-2">
                <a href="routes/register.php"><button class="btn text-white"><i class="fa fa-user-plus"></i> Sign Up</button> </a>
            </div>
            <div class="col-md-2">
                <a href="admin.php"><button class="btn text-white"><i class="fa fa-user-circle"></i> Admin</button> </a>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 text-center pb-3">
            <img src="uploads/istockphoto-1226256523-612x612.jpg" style="border-radius:10px" height="400" width="400"><br><br>
            </div>
            <div class="col-md-6 text-justify text-white">
                <h3>Welcome to Online Polling System</h3><br>
                <p>
                An Online Polling System is a web-based platform that allows users to participate in polls and 
                surveys. It can be used for various purposes such as market research, academic research, or simply for 
                gathering opinions on a particular topic.
                </p>
                <hr>
                    <form>
                        <h5>Sign In</h5>
                        <div class="form-row">
                            <div class="form-group pt-1 col-md-6">
                            <input type="text" id="mobile" class="form-control" placeholder="Mobile No">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <input id="pass" type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <input type="button" onclick="loginFun()" id="loginbtn" class="btn btn-dark" value="Login">
                            </div>
                        </div>
                    </form>                
            </div>
        </div>
    </div>
</div>

<script>

    function loginFun(){
        var mobile = $("#mobile").val();
        var pass = $("#pass").val();

        $.ajax({
            url : 'api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 1,
                mobile : mobile,
                pass : pass,
            }),
            success : function(data){
                if(data==0){
                    swal({
                            title: "Invalid Credentials!",
                            text: "Mobile or Password is invalid!",
                            icon: "error",
                            button: "OK!",
                    });
                }
                else{
                   window.location = 'routes/main.php';
                }
            }
            
        });
    }

 
</script>

</body>

</html>