<?php  
session_start();
include('connect.php');

$CustomerID=$_GET['CustomerID'];

$delete="DELETE FROM Customer WHERE CustomerID='$CustomerID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Account Successfully Deleted!')</script>";
	echo "<script>window.location='Home.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Account" . mysqli_error($connection) . "</p>";
}
?>