<?php
    // CONNECTION 
    include('connection.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $date = date('d-m-Y');

        $check = mysqli_query($con, "select * from user where mobile='$mobile' ");

        if($pass!==$cpass){
            echo json_encode($response['success'] = 3);        
        }
        else if(strlen($mobile)!=10){
            echo json_encode($response['success'] = 5);
        }
        else if(mysqli_num_rows($check)>0){
            echo json_encode($response['success'] = 4);
        }
        else
        {
            $enc_pass = md5($pass);
            $enc_pass1 = sha1($enc_pass);
            $enc_pass2 = password_hash($enc_pass1, PASSWORD_DEFAULT);
            $query = mysqli_query($con, "insert into user (name, mobile, email, password, created_at) values('$name','$mobile','$email','$enc_pass2','$date')");
            
            if($query){
                echo json_encode($response['success']=1);
            }
            else{
                echo json_encode($response['success']=0);
            }
        }

       
    }

?>