<?php  
session_start(); //Session Declare
include('Header3.php');
include('connect.php');

if (!isset($_SESSION['CustomerID'])) 
  {
    echo "<script>alert('Please Login Account.');</script>";
    echo "<script>window.location='Customer_Login.php';</script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Profile</title>
</head>
<body>
<form action="Customer_Profile" method="post">

<h2 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Welcome, <?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']?></h2>
<h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Have a Nice Day...</h3>

<hr/>

<table>
<tr>
	<td width="170pt">Profile Image</td>
	<td width="50pt">-</td>
	<td><?php echo "<img src='".$_SESSION['ProfileImage']."' width='200px' height='200px'>";?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">First Name</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['FirstName']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Last Name</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['LastName']?></td>
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
<tr>
	<td width="170pt">Address</td>
	<td width="50pt">-</td>
	<td><?php echo $_SESSION['Address']?></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>

<?php  

	$CustomerID=$_SESSION['CustomerID'];
	
	$cu_select="SELECT * FROM Customer WHERE CustomerID='$CustomerID'";
	$cu_ret=mysqli_query($connection,$cu_select);
	$cu_count=mysqli_num_rows($cu_ret);

	for($i=0;$i<$cu_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($cu_ret);

		echo "<tr>";
			echo "<td>
				  <a href='Customer_Update.php?CustomerID=$CustomerID'>Update Profile</a>
				  </td>";
			echo "<td>
					|
				 </td>";
			echo "<td>
				  <a href='Customer_Delete.php?CustomerID=$CustomerID'>Delete Account</a>
				  </td>";
		echo "</tr>";
	}

?>
</table>

</form>
</body>
</html>

<?php 

include ('Footer1.php');

 ?>