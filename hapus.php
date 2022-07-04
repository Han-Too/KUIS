<?php
  $conn = mysqli_connect("localhost", "root","","farhan");
$kdbuku = $_GET['kdbuku'];
$query="DELETE FROM tbl_farhan WHERE kdbuku='$kdbuku'";
mysqli_query($conn,$query);
header("Location:index.php");
?>