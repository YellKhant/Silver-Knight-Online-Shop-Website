<?php  
session_start();
include('connect.php');

$BrandID=$_GET['BrandID'];

$delete="DELETE FROM Brand WHERE BrandID='$BrandID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Brand Successfully Deleted!')</script>";
	echo "<script>window.location='Brand_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Brand" . mysqli_error($connection) . "</p>";
}
?>