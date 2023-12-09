<?php

$con =mysqli_connect('localhost','root','','hmdt');

$filename="con_file.json";

$data=file_get_contents($filename);
$array=json_decode($data,true);

foreach($array as $value){
    foreach($array as $value){
        $query="INSERT INTO `patient_files`(`patient_id`,`allergies`,`chronic_diseases`,`symptoms`)
        VALUES('".$value['pid']."','".$value['allergy']."',
        '".$value['disease']."','".$value['symptoms']."')";
    
        mysqli_query($con,$query);
    
    }
    
}
echo "secc";