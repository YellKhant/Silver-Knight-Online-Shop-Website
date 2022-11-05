<?php  
session_start();
include('connect.php');

$CategoryID=$_GET['CategoryID'];

$delete="DELETE FROM Category WHERE CategoryID='$CategoryID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Category Successfully Deleted!')</script>";
	echo "<script>window.location='Category_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Category" . mysqli_error($connection) . "</p>";
}
?>