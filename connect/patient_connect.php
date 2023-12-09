<?php

$con =mysqli_connect('localhost','root','','hmdt');

$filename="patient_info.json";

$data=file_get_contents($filename);
$array=json_decode($data,true);

foreach($array as $value){
    
    $query="INSERT INTO `patients`(`patient_id`,`patient_name`,`patient_phone`) VALUES ('".$value['pid']."','".$value['fname']."','".$value['contact']."' )";

    mysqli_query($con,$query);
}