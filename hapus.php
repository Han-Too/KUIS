<?php
  $conn = mysqli_connect("localhost", "root","","KUIS");
$kdikan = $_GET['kd_ikan'];
$query="DELETE FROM tbl_ikan WHERE kd_ikan='$kdikan'";
mysqli_query($conn,$query);
header("Location:index.php");
?>