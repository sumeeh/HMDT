<?php

$con =mysqli_connect('localhost','root','','hmdt');


$filename="users.json";

$data=file_get_contents($filename);
$array=json_decode($data,true);


foreach($array as $value){
    $query="INSERT INTO `users`(`user_id`,`username`,`password`,`phone_number`
    ,`firstname`,`lastname`,`email`,`gender`,`group_id`,`user_code`)
    VALUES('".$value['user_id']."','".$value['user_name']."',
    '".$value['password']."','".$value['phone_number']."'
    ,'".$value['frist_name']."','".$value['last_name']."'
    ,'".$value['email']."','".$value['gender']."'
    ,'".$value['group_id']."'
    ,'".$value['user_code']."')";

    mysqli_query($con,$query);

}

echo"data suc";