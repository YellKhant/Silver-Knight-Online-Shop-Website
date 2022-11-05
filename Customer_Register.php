<?php  
session_start();
include('Header1.php');
include('connect.php');
include('AutoID_Functions.php');

if(isset($_POST['btnSave'])) 
{
	$txtFirstName=$_POST['txtFirstName'];
	$txtLastName=$_POST['txtLastName'];
	$txtAddress=$_POST['txtAddress'];
	$txtPhone=$_POST['txtPhone'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$Image1=$_FILES['Image1']['name']; 
	$Folder="CustomerImage/";

	$FileName1=$Folder . '_' . $Image1; 

	$copied=copy($_FILES['Image1']['tmp_name'], $FileName1);

	if(!$copied) 
	{
		echo "<p>Profile Picture cannot upload!</p>";
		exit();
	}

	$check_email="SELECT * FROM Customer WHERE Email='$txtEmail'";
	$result=mysqli_query($connection,$check_email);
	$count=mysqli_num_rows($result);

	if($count > 0) 
	{
		echo "<script>window.alert('Email aleready exist!')</script>";
		echo "<script>window.location='Customer_Register.php'</script>";
		exit();
	}

	$insert_data="INSERT INTO Customer
				  (FirstName,LastName,Address,PhoneNumber,Email,Password,ProfileImage)
				  VALUES
				  ('$txtFirstName','$txtLastName','$txtAddress','$txtPhone','$txtEmail','$txtPassword','$FileName1')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Account Successfully Created!')</script>";
		echo "<script>window.location='Customer_Login.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Customer Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Register</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>

<form action="Customer_Register.php" method="post" enctype="multipart/form-data">

<a href="Home.php">Back to Home Page <<</a>

<fieldset>
<legend>Fill the Customer Register form here:</legend>

<table>
<tr>
	<td>First Name</td>
	<td>
		<input type="text" name="txtFirstName" placeholder="Enter First Name" required />
	</td>
</tr>
<tr>
	<td>Last Name</td>
	<td>
		<input type="text" name="txtLastName" placeholder="Enter Last Name" required />
	</td>
</tr>
<tr>
	<td>Address</td>
	<td>
		<textarea name="txtAddress"></textarea>
	</td>
</tr>
<tr>
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95************" required />
	</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="************" required />
	</td>
</tr>
<tr>
	<td>Upload Profile Picture</td>
	<td>
		<input type="file" name="Image1" required />
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
		<input type="submit" value="Save" name="btnSave"/>
		<input type="reset" value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php 

include('Footer1.php');

 ?>