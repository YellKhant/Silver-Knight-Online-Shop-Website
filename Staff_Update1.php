<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtStaffID=$_POST['txtStaffID'];
	$txtStaffName=$_POST['txtStaffName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
	$txtPhone=$_POST['txtPhone'];

	//Update Staff Data in table
	$update_data="UPDATE Staff 
				  SET 
				  Name='$txtStaffName',
				  Email='$txtEmail',
				  Password='$txtPassword',
				  PhoneNumber='$txtPhone'
				  WHERE StaffID='$txtStaffID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Staff Account Successfully Updated!')</script>";
		echo "<script>window.location='Staff_Login.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['StaffID'])) 
{
	$StaffID=$_GET['StaffID'];

	$query="SELECT * FROM Staff WHERE StaffID='$StaffID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$StaffID="";
	echo "<script>window.alert('Somthing went wrong | StaffID not found')</script>";
	echo "<script>window.location='Staff_Home.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Staff_Update1.php" method="post">

<a href="Staff_Profile.php">Back to Your Profile <<</a>

<fieldset>
<legend>Update Staff Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtStaffName" value="<?php echo $rows['Name'] ?>" required />
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
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" value="<?php echo $rows['PhoneNumber'] ?>" required />
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
		<input type="hidden" name="txtStaffID" value="<?php echo $rows['StaffID'] ?>" />
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

include ('Footer.php');

 ?>