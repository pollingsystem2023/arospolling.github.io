<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location:../');
    }
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
  <title>Online Polling System - Voting Panel</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

<div id="headerSection" class="sticky-top">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-10 text-center pt-3">
                <p id="brand">Online Voting System</p>
            </div>
            <div class="col-md-2 text-center ">
                <a style="color:white; text-decoration:none" href="logout.php">Logout <i class="fa fa-user-circle"></i></a>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-4 py-1">
                <div id="loginSection" class="p-4">
                    <div id="userData"></div>
                </div>
            </div>
            <div class="col-md-8 py-1"> 
                <div id="loginSection" class="p-4">
                    <h4>Polls</h4><br>
                    <div id="Polls"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        getData();

    });

    function getData(){
        var id = <?php echo $_SESSION['user_id'] ?>;
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 2,
                id : id,
            }),
            success : function(data){
                console.log(data);
                var user = data[0];
                var polls = data[1];
                var options = data[2];
                var getPolls = '';
                var userData = '';
                var sr = '';

                $.each(polls, function(i, d){
                        sr = i+1;
                        getPolls+='<form method="post" action="../api/vote.php" enctype="multipart/form-data"><h5>'+sr+'. '+d.question+'</h5><img class="py-2" src="../uploads/'+d.image+'" height="150" width="150"><br>';
                        $.each(options, function(j, e){
                            if(d.pid==e.pid){
                                getPolls+='<input type="radio" value="'+e.id+'" name="option" required>'+
                                '<input type="hidden" name="votes" value="'+e.votes+'">'+
                                '<input type="hidden" name="pid" value="'+e.pid+'"> '+e.option+'<br>';
                            }
                        });
                        getPolls+='<br><input type="submit" class="btn btn-sm btn-dark" value="Submit"></form><hr>';
                });

                $("#Polls").html(getPolls);
                $("#userData").html(
                    '<h5>'+user.name+'</h5><br>'+
                    '<p><b>Mobile:</b> <br>'+user.mobile+'</p>'+
                    '<p><b>Email:</b> <br>'+user.email+'</p>'
                );            
             }
            
        });
    }
    
</script>

</body>

</html>