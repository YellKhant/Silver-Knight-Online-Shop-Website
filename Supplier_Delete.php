<?php  
session_start();
include('connect.php');

$SupplierID=$_GET['SupplierID'];

$delete="DELETE FROM Supplier WHERE SupplierID='$SupplierID'";
$result=mysqli_query($connection,$delete);

if($result) //True
{
	echo "<script>window.alert('Supplier Account Successfully Deleted!')</script>";
	echo "<script>window.location='Supplier_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Supplier" . mysqli_error($connection) . "</p>";
}
?>