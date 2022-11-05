<?php  
session_start();
include('connect.php');

$StaffID=$_GET['StaffID'];

$delete="DELETE FROM Staff WHERE StaffID='$StaffID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Staff Account Successfully Deleted!')</script>";
	echo "<script>window.location='Staff_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Staff" . mysqli_error($connection) . "</p>";
}
?>