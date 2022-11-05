<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtSupplierID=$_POST['txtSupplierID'];
	$txtSupplierName=$_POST['txtSupplierName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
	$txtPhone=$_POST['txtPhone'];
	$textOrgAddress=$_POST['textOrgAddress'];

	//Update Supplier Data in table
	$update_data="UPDATE Supplier 
				  SET 
				  Name='$txtSupplierName',
				  Email='$txtEmail',
				  PhoneNumber='$txtPhone',
				  OrgAddress='$textOrgAddress'
				  WHERE SupplierID='$txtSupplierID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Supplier Information Successfully Updated!')</script>";
		echo "<script>window.location='Supplier_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Supplier" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['SupplierID'])) 
{
	$SupplierID=$_GET['SupplierID'];

	$query="SELECT * FROM Supplier WHERE SupplierID='$SupplierID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$SupplierID="";
	echo "<script>window.alert('Somthing went wrong | SupplierID not found')</script>";
	echo "<script>window.location='Supplier_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Supplier Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Supplier_Update.php" method="post">

<a href="Supplier_Register.php">Back to Supplier Register <<</a>

<fieldset>
<legend>Update Supplier Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtSupplierName" value="<?php echo $rows['Name'] ?>" required />
	</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>
		<input type="email" name="txtEmail" value="<?php echo $rows['Email'] ?>" required />
	</td>
</tr>
<tr>
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" value="<?php echo $rows['PhoneNumber'] ?>" required />
	</td>
</tr>
<tr>
	<td>Organization's Address</td>
	<td>
		<input type="text" name="textOrgAddress" value="<?php echo $rows['OrgAddress'] ?>" required />
	</td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtSupplierID" value="<?php echo $rows['SupplierID'] ?>" />
		<input type="submit" value="Update" name="btnUpdate"/>
		<input type="reset" value="Reset"/>
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php 

include ('Footer.php');

 ?>