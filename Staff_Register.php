<?php  
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Header.php');

if ($_SESSION['Role'] <> 'Web Administrator')
	{
	echo "<script>alert('Access Denied. Please Login With Web Administrator Account.');</script>";
	echo "<script>window.location='Staff_Home.php';</script>";
	}

if(isset($_POST['btnSave'])) 
{
	$txtStaffName=$_POST['txtStaffName'];
	$cboRole=$_POST['cboRole'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
	$txtPhone=$_POST['txtPhone'];

	$check_email="SELECT * FROM Staff WHERE Email='$txtEmail'";
	$result=mysqli_query($connection,$check_email);
	$count=mysqli_num_rows($result);

	if($count > 0) 
	{
		echo "<script>window.alert('Staff Email $txtEmail aleready exist!')</script>";
		echo "<script>window.location='Staff_Register.php'</script>";
		exit();
	}

	$insert_data="INSERT INTO Staff
				  (Name,Role,Email,Password,PhoneNumber)
				  VALUES
				  ('$txtStaffName','$cboRole','$txtEmail','$txtPassword','$txtPhone')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Staff Account Successfully Created!')</script>";
		echo "<script>window.location='Staff_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Register</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>

<script>
	$(document).ready( function (){
		$('#tableid').DataTable();
	} );
</script>

<form action="Staff_Register.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill the Staff Register form here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtStaffName" placeholder="Enter Staff Name" required />
	</td>
</tr>
<tr>
	<td>Role</td>
	<td>
		<select name="cboRole">
			<option>Customer Service Provider</option>
			<option>Marketing Manager</option>
			<option>Warehouse Manager</option>
			<option>Web Administrator</option>
		</select>
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
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95************" required />
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
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Staff Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align="left">
<tr>
	<th>Staff ID</th>
	<th>Name</th>
	<th>Role</th>
	<th>E-mail</th>
	<th>Phone Number</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$staff_select="SELECT * FROM Staff";
	$staff_ret=mysqli_query($connection,$staff_select);
	$staff_count=mysqli_num_rows($staff_ret);

	for($i=0;$i<$staff_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($staff_ret);
		$StaffID=$rows['StaffID'];

		echo "<tr>";
			echo "<td>$StaffID</td>";
			echo "<td>" . $rows['Name'] . "</td>";
			echo "<td>" . $rows['Role'] . "</td>";
			echo "<td>" . $rows['Email'] . "</td>";
			echo "<td>" . $rows['PhoneNumber'] . "</td>";
			echo "<td>
				  <a href='Staff_Update.php?StaffID=$StaffID'>Edit</a> |
				  <a href='Staff_Delete.php?StaffID=$StaffID'>Delete</a>
				  </td>";
		echo "</tr>";
	}

?>
</tbody>
</table>

</fieldset>

</form>
</body>
</html>

<?php 

include ('Footer.php');

 ?>