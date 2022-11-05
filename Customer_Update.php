<?php  
session_start();
include('Header3.php');
include('connect.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtFirstName=$_POST['txtFirstName'];
	$txtLastName=$_POST['txtLastName'];
	$txtAddress=$_POST['txtAddress'];
	$txtPhone=$_POST['txtPhone'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$update_data="UPDATE Customer 
				  SET 
				  FirstName='$txtFirstName',
				  LastName='$txtLastName',
				  Address='$txtAddress',
				  Email='$txtEmail',
				  Password='$txtPassword',
				  PhoneNumber='$txtPhone'
				  WHERE CustomerID='$txtCustomerID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Profile Successfully Updated!')</script>";
		echo "<script>window.location='Customer_Login.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Profile info" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['CustomerID'])) 
{
	$CustomerID=$_GET['CustomerID'];

	$query="SELECT * FROM Customer WHERE CustomerID='$CustomerID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$CustomerID="";
	echo "<script>window.alert('Somthing went wrong | Customer ID not found')</script>";
	echo "<script>window.location='Customer_Profile.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Customer_Update.php" method="post">

<a href="Customer_Profile.php">Back to Your Profile <<</a>

<fieldset>
<legend>Update Your Profile info here:</legend>

<table>
<tr>
	<td>First Name</td>
	<td>
		<input type="text" name="txtFirstName" value="<?php echo $rows['FirstName'] ?>" required />
	</td>
</tr>
<tr>
	<td>Last Name</td>
	<td>
		<input type="text" name="txtLastName" value="<?php echo $rows['LastName'] ?>" required />
	</td>
</tr>
<tr>
	<td>Address</td>
	<td>
		<input type="text" name="txtAddress" value="<?php echo $rows['Address'] ?>" required />
	</td>
</tr>
<tr>
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" value="<?php echo $rows['PhoneNumber'] ?>" required />
	</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>
		<input type="email" name="txtEmail" value="<?php echo $rows['Email'] ?>" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" value="<?php echo $rows['Password'] ?>" required />
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
		<input type="hidden" name="txtCustomerID" value="<?php echo $rows['CustomerID'] ?>" />
		<input type="submit" value="Update" name="btnUpdate"/>
		<input type="reset" value="Reset" />
	</td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Note:</td>
	<td>
		After updatig your profile, login form will appear and you need to login again.
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php 

include ('Footer1.php');

 ?>