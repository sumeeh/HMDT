
<?php
$con =mysqli_connect('localhost','root','','myhmsdb');
$sql="SELECT * FROM patreg";
$results=mysqli_query($con,$sql);

$json_array=array();

while($row=mysqli_fetch_assoc($results)){
    $json_array[]=$row;


}
//echo json_encode($json_array);
$encoded_data=json_encode($json_array,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
file_put_contents('patient_info.json',$encoded_data);

