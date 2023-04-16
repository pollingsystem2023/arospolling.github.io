<?php
    include('connection.php');
    $json = json_decode(file_get_contents("php://input"),true);


    // CREATE NEW POLL

        $question = $_POST['question'];
        $o1 = $_POST['o1'];
        $o2 = $_POST['o2'];
        $o3 = $_POST['o3'];
        $o4 = $_POST['o4'];
        $options = array($o1, $o2, $o3, $o4);
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $pid = mt_rand(100000,999999);
        $date = date('d-F-Y');

        // ADD QUESTION
        $query = mysqli_query($con, "insert into poll (pid, question, image, status, created_at) values('$pid', '$question','$image', 0, '$date')");

        // ADD IMAGE
        $upload = move_uploaded_file($tmp_name,"../uploads/$image");

        // ADD OPTIONS  
        for($i=0; $i<4; $i++)
        {
            $option = $options[$i];
            $query2 = mysqli_query($con, "insert into options (pid, option) values('$pid','$option')");
        }


        // RESPONSE
        if($query and $upload and $query2){
            echo json_encode($response['success']=1);
        }
        else{
            echo json_encode($response['success']=0);
        }
        

?>