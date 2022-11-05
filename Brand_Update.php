<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtBrandID=$_POST['txtBrandID'];
	$txtBrandName=$_POST['txtBrandName'];
	$textDescription=$_POST['textDescription'];

	//Update Brand Data in table
	$update_data="UPDATE Brand 
				  SET 
				  BName='$txtBrandName',
				  Description='$textDescription'
				  WHERE BrandID='$txtBrandID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Brand Information Successfully Updated!')</script>";
		echo "<script>window.location='Brand_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Brand" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['BrandID'])) 
{
	$BrandID=$_GET['BrandID'];

	$query="SELECT * FROM Brand WHERE BrandID='$BrandID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$BrandID="";
	echo "<script>window.alert('Somthing went wrong | BrandID not found')</script>";
	echo "<script>window.location='Brand_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Brand Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Brand_Update.php" method="post">

<a href="Brand_Register.php">Back to Brand Register <<</a>

<fieldset>
<legend>Update Brand Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtBrandName" value="<?php echo $rows['BName'] ?>" required />
	</td>
</tr>
<tr>
	<td>Description</td>
	<td>
		<input type="text" name="textDescription" value="<?php echo $rows['Description'] ?>" required />
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
		<input type="hidden" name="txtBrandID" value="<?php echo $rows['BrandID'] ?>" />
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