<?php  
session_start();
include('connect.php');

$ProductID=$_GET['ProductID'];

$delete="DELETE FROM Product WHERE ProductID='$ProductID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Product Successfully Deleted!')</script>";
	echo "<script>window.location='Product_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Product" . mysqli_error($connection) . "</p>";
}
?>