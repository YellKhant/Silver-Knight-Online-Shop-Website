<?php  
session_start();
include('connect.php');

$DeliveryID=$_GET['DeliveryID'];

$delete="DELETE FROM Delivery WHERE DeliveryID='$DeliveryID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Deli info Successfully Deleted!')</script>";
	echo "<script>window.location='Delivery_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Deli info" . mysqli_error($connection) . "</p>";
}
?>