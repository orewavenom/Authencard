<?php
//fetch.php
 include 'connect_database.php';

if(isset($_POST["id"]))
{
 $id = $_POST["id"];
 $query = "SELECT * FROM teachers WHERE id = '$id'";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  $data["email"] 		= $row["email"];
  $data["name"] 		= $row["name"];
  $data["phone"] 		= $row["phone"];
 }

 echo json_encode($data);
}
?>