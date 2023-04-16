<?php
 session_start();

 if(!isset($_SESSION['admin_id'])){
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
    <title>Admin Dashboard - Online Polling System</title>
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
            <div class="col-sm-10 text-center pt-3">
                <p id="brand">Online Polling System</p>
            </div>
            <div class="col-sm-2 text-center pt-3">
                <a class="text-white" href="logout.php">Logout <i class="fa fa-user-circle"></i></a>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">

        <div class="row py-3">
                <div class="col-md-4">
                    <div id="loginSection" class="p-4">
                        <h4 id="groups">Create new poll</h4><br>
                        <form id="createPollForm" enctype="multipart/form-data">
                            <input name="question" type="text" id="question" class="form-control" placeholder="Question." required>
                            <br>
                            <input name="o1" type="text" id="cpost" class="form-control" placeholder="Option 1" required>
                            <br>
                            <input name="o2" type="text" id="cpost" class="form-control" placeholder="Option 2" required>
                            <br>
                            <input name="o3" type="text" id="cpost" class="form-control" placeholder="Option 3" required>
                            <br>
                            <input name="o4" type="text" id="cpost" class="form-control" placeholder="Option 4" required>
                            <br>
                            <div class="input-group" id="imageBox">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="inputGroupFile02" required>
                                    <label class="custom-file-label" for="inputGroupFile02">Upload Image</label>
                                </div> 
                            </div>
                            <br>
                            <input type="submit" class="form-control btn btn-dark" id="btnn" name="regbtn" value="Create">
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div id="loginSection" class="p-4">
                        <div id="Polls"></div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        getPolls();
    });


    function getPolls(){
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 11
            }),
            success : function(data){
                console.log(data);
                var polls = data[0];
                var options = data[1];
                var getPolls = '';
                var sr = '';
                if(data==0){
                   $("#Polls").html('<p>There are no polls right now.</p>');
                }
                else{
                    $.each(polls, function(i, d){
                        sr = i+1;
                        getPolls+='<h5>'+sr+'. '+d.question+'</h5><img class="py-2" src="../uploads/'+d.image+'" height="150" width="150"><br>';
                        $.each(options, function(j, e){
                            if(d.pid==e.pid){
                                getPolls+='<p>'+e.option+' - <b>'+e.votes+' votes</b></p>';
                            }
                        });
                        getPolls+='<button type="button" onclick="deletePoll('+d.pid+')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Remove</button><hr>';
                    });

                    $("#Polls").html(getPolls);
                }
            }
            
        });
    }

    $("#createPollForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url : '../api/poll.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                    swal({
                        title: "Poll created successfully!",
                        text: "New poll is created successfully!",
                        icon: "success",
                        button: "OK!",
                    }).
                    then((done) => {
                        if (done) {
                            location.reload();
                        } 
                    });
                }
            });
        });

        $("#logoForm").on('submit', function(e){
            e.preventDefault();
            $("#exampleModal").modal('hide');
            $.ajax({
                url : '../api/info.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                   
                    getInfo();
                }
            });
    });


    function deletePoll(id){

        var id = id;

        swal({
            title: 'Are you sure?',
            text: "Confirm first if you want to delete any poll!",
            icon: "warning",
            buttons: ['Cancel', 'Confirm'],
            dangerMode: true,
            })
            .then((vote) => {
            if (vote) {
                delCan(id);
            } else {
                swal("Think again!");
            }
        });
    }

    function delCan(id){
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 0,
                id : id
            }),
            success : function(data){
                if(data==1){
                    getPolls();
                }
            }
            
        });
    }

 
</script>

</body>

</html>