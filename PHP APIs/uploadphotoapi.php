<?php
include'db.php';

  
    $photo = $_POST['photo'];

$serverpath="https://btpproject2019.000webhostapp.com/APIs/";

   $path = "photos/".rand().time().".jpg";

   
        if ( file_put_contents( $path, base64_decode($photo) ) ) { 
            
            $result['success'] = "1";
            $result['photourl']=$serverpath.$path;
            echo json_encode($result);
        }




?>