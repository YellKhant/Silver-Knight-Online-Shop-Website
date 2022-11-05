<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtProductID=$_POST['txtProductID'];
	$txtProductName=$_POST['txtProductName'];
	$txtColor=$_POST['txtColor'];
	$txtSize=$_POST['txtSize'];
	$txtPrice=$_POST['txtPrice'];
	$txtQuantity=$_POST['txtQuantity'];
	$cboStatus=$_POST['cboStatus'];
	$txtDescription=$_POST['txtDescription'];

	//Update Staff Data in table
	$update_data="UPDATE Product 
				  SET 
				  Name='$txtProductName',
				  Color='$txtColor',
				  Size='$txtSize',
				  Price='$txtPrice',
				  Quantity='$txtQuantity',
				  Status='$cboStatus',
				  Description='$txtDescription'
				  WHERE ProductID='$txtProductID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Product indromation Successfully Updated!')</script>";
		echo "<script>window.location='Product_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Product infromation!" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['ProductID'])) 
{
	$ProductID=$_GET['ProductID'];

	$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$ProductID="";
	echo "<script>window.alert('Somthing went wrong | ProductID not found')</script>";
	echo "<script>window.location='Product_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Product Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Product_Update.php" method="post">

<a href="Product_Register.php">Back to Product Register <<</a>

<fieldset>
<legend>Update Product Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtProductName" value="<?php echo $rows['Name'] ?>" required />
	</td>
</tr>

<tr>
	<td>Color</td>
	<td>
		<input type="text" name="txtColor" value="<?php echo $rows['Color'] ?>" required />
	</td>
</tr>
<tr>
	<td>Size</td>
	<td>
		<input type="text" name="txtSize" value="<?php echo $rows['Size'] ?>" required />
	</td>
</tr>
<tr>
	<td>Price</td>
	<td>
		<input type="number" name="txtPrice" value="<?php echo $rows['Price'] ?>" required />
	</td>
</tr>
<tr>
	<td>Quantity</td>
	<td>
		<input type="number" name="txtQuantity" value="<?php echo $rows['Quantity'] ?>" required />
	</td>
</tr>
<tr>
	<td>Status</td>
	<td>
		<select name="cboStatus">
			<option><?php echo $rows['Status'] ?></option>
			<option>In Stock</option>
			<option>Sold Out</option>
			<option>Discount</option>
			<option>Promotion</option>
		</select>
	</td>
</tr>
<tr>
	<td>Description</td>
	<td>
		<input type="text" name="txtDescription" value="<?php echo $rows['Description'] ?>" required />
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
		<input type="hidden" name="txtProductID" value="<?php echo $rows['ProductID'] ?>" />
		<input type="submit" value="Update" name="btnUpdate"/>
		<input type="reset" value="Reset" />
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