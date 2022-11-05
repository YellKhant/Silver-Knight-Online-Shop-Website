<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtOrderID=$_POST['txtOrderID'];
	$cboOrderStatus=$_POST['cboOrderStatus'];
	$cboPaymentStatus=$_POST['cboPaymentStatus'];

	$update_data="UPDATE Orders
				  SET 
				  OrderStatus='$cboOrderStatus',
				  PaymentStatus='$cboPaymentStatus'
				  WHERE OrderID='$txtOrderID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Status Successfully Updated!')</script>";
		echo "<script>window.location='Order_Search.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Status" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['OrderID'])) 
{
	$OrderID=$_GET['OrderID'];

	$query="SELECT * FROM Orders WHERE OrderID='$OrderID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$OrderID="";
	echo "<script>window.alert('Somthing went wrong | OrderID not found')</script>";
	echo "<script>window.location='Order_Search.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Order & Payment' Status Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Order_Status_Update.php" method="post">

<a href="Order_Search.php">Back to Order Search <<</a>

<fieldset>
<legend>Update Order & Payment' Status here:</legend>

<table>
<tr>
	<td>Order ID</td>
	<td>
		<input type="text" name="txtOrderID" value="<?php echo $rows['OrderID'] ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Order Status</td>
	<td>
		<select name="cboOrderStatus">
			<option><?php echo $rows['OrderStatus'] ?></option>
			<option>Pending</option>
			<option>Confirmed</option>
			<option>Denied</option>
		</select>
	</td>
</tr>
<tr>
	<td>Payment Status</td>
	<td>
		<select name="cboPaymentStatus">
			<option><?php echo $rows['PaymentStatus'] ?></option>
			<option>Pending</option>
			<option>Recieved</option>
			<option>Denied Order</option>
		</select>
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