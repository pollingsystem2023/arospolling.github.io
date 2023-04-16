
<?php
    session_start();

    // CONNECTION
    include('connection.php');

    // DATA DECODING
    $json = json_decode(file_get_contents("php://input"),true);
    

    // LOGIN
    if($json['call'] == 1){
        
        $mobile = $json['mobile'];
        $pass = $json['pass'];

        $enc_pass = md5($pass);
        $enc_pass1 = sha1($enc_pass);
        $enc_pass2 = password_verify($enc_pass1, PASSWORD_DEFAULT);

        $query = mysqli_query($con, "select * from user where mobile='$mobile'");
        if(mysqli_num_rows($query)>0){
            while($data = mysqli_fetch_array($query)){
                $check_pass = $data['password'];
                if(password_verify($enc_pass1, $check_pass)){
                    $id = $data['id'];
                    $_SESSION['user_id'] = $id;
                    echo json_encode($response['success'] = 1);
                }
                else{
                    echo json_encode($response['success'] = 0);
                }
            }
        }
        else{
            echo json_encode($response['success'] = 0);
        }

    }

    // GET USER AND POLLS DATA
      if($json['call'] == 2){
        
        $id = $json['id'];
        $query = mysqli_query($con, "select id, name, mobile, email from user where id='$id'");
        $getPolls = mysqli_query($con, "select * from poll");
        $getOptions = mysqli_query($con, "select * from options");

        if(mysqli_num_rows($query)>0){
            $user = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $empty = mysqli_free_result($query);
            $polls = mysqli_fetch_all($getPolls, MYSQLI_ASSOC);
            $empty1 = mysqli_free_result($getPolls);
            $options = mysqli_fetch_all($getOptions, MYSQLI_ASSOC);
            $empty1 = mysqli_free_result($getOptions);
            echo json_encode([$user, $polls, $options]);
        }
    }


    // GET POLLS
       if($json['call'] == 11){
        
        $getPolls = mysqli_query($con, "select * from poll");
        $getOptions = mysqli_query($con, "select * from options");

        if(mysqli_num_rows($getPolls)>0){
            $polls = mysqli_fetch_all($getPolls, MYSQLI_ASSOC);
            $empty = mysqli_free_result($getPolls);
            $options = mysqli_fetch_all($getOptions, MYSQLI_ASSOC);
            $empty = mysqli_free_result($getOptions);
            echo json_encode([$polls, $options]);
        }
        else{
            echo json_encode($response['success'] = 0);
        }
    }


    // DELETE POLL
    if($json['call']==0){
        $id = $json['id'];
        $delPoll= mysqli_query($con,"delete from poll where pid='$id'");
        $delOptions= mysqli_query($con,"delete from options where pid='$id'");

        if($delPoll and $delOptions){
            echo json_encode($response['success']=1);
        }
    }
?>