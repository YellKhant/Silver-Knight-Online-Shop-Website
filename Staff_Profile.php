<?php  
session_start(); //Session Declare
include('Header.php');
include('connect.php');

if (!isset($_SESSION['StaffID'])) 
  {
    echo "<script>alert('Please Login with Staff Account.');</script>";
    echo "<script>window.location='Staff_Login.php';</script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Profile</title>
</head>
<body>
<form action="Staff_Profile" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Your Profile:</legend>	

<table>

<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Staff ID</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['StaffID']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Name</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['Name']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Role</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['Role']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Phone Number</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['PhoneNumber']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">E-mail</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['Email']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>

</table>


</fieldset>
<fieldset>
<?php  

	$StaffID=$_SESSION['StaffID'];
	
	$staff_select="SELECT * FROM Staff WHERE StaffID='$StaffID'";
	$staff_ret=mysqli_query($connection,$staff_select);
	$staff_count=mysqli_num_rows($staff_ret);

	for($i=0;$i<$staff_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($staff_ret);

		echo "<tr>";
			echo "<td>
				  <a href='Staff_Update1.php?StaffID=$StaffID'>Update Profile</a> |
				  <a href='Staff_Delete.php?StaffID=$StaffID'>Delete Account</a>
				  </td>";
		echo "</tr>";
	}

?>

</fieldset>

</form>
</body>
</html>

<?php 

include ('Footer.php');

 ?>