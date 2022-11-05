<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtDeliveryID=$_POST['txtDeliveryID'];
	$txtTownship=$_POST['txtTownship'];
	$textCost=$_POST['textCost'];

	//Update Brand Data in table
	$update_data="UPDATE Delivery
				  SET 
				  Township='$txtTownship',
				  Cost='$textCost'
				  WHERE DeliveryID='$txtDeliveryID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Deli Info Successfully Updated!')</script>";
		echo "<script>window.location='Delivery_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Deli info" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['DeliveryID'])) 
{
	$DeliveryID=$_GET['DeliveryID'];

	$query="SELECT * FROM Delivery WHERE DeliveryID='$DeliveryID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$BrandID="";
	echo "<script>window.alert('Somthing went wrong | Deli ID not found')</script>";
	echo "<script>window.location='Delivery_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Delivery Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Delivery_Update.php" method="post">

<a href="Delivery_Register.php">Back to Delivery Register <<</a>

<fieldset>
<legend>Update Deli info here:</legend>

<table>
<tr>
	<td>Township</td>
	<td>
		<input type="text" name="txtTownship" value="<?php echo $rows['Township'] ?>" required />
	</td>
</tr>
<tr>
	<td>Cost</td>
	<td>
		<input type="text" name="textCost" value="<?php echo $rows['Cost'] ?>" required />
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
		<input type="hidden" name="txtDeliveryID" value="<?php echo $rows['DeliveryID'] ?>" />
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