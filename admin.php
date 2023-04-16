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
    <title>Admin Sign In - Online Polling System</title>
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
            <div class="col-md-2">
                <a href="index.php"><button class="btn text-white"><i class="fa fa-chevron-circle-left"></i> Back</button> </a>
            </div>
            <div class="col-sm-6 pt-3">
                <p id="brand">Online Polling System</p>
            </div>
            <div class="col-md-2">
                <a href="index.php"><button class="btn text-white"><i class="fa fa-user-circle"></i> Sign In</button> </a>
            </div>
            <div class="col-md-2">
                <a href="routes/register.php"><button class="btn text-white"><i class="fa fa-user-plus"></i> Sign Up</button> </a>
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
                                <h4 style="font-weight: 600;">Admin Sign In</h4><br>
                                <input id="id" type="text" class="form-control" placeholder="Admin ID" required><br>
                                <input id="pass" type="password" class="form-control" placeholder="Password" required><br>
                                <input type="button" class=" btn btn-dark" onclick="loginFun()" value="Sign In"><br>
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

    function loginFun(){
        var id = $("#id").val();
        var pass = $("#pass").val();

        $.ajax({
            url : 'api/admin.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 10,
                id : id,
                pass : pass,
            }),
            success : function(data){
                if(data==0){
                    swal({
                            title: "Invalid Credentials!",
                            text: "Invalid ID or Password!",
                            icon: "error",
                            button: "OK!",
                    });
                }
                else{
                   window.location = 'routes/dashboard.php';
                }
            }
            
        });
    }

 
</script>

</body>

</html>