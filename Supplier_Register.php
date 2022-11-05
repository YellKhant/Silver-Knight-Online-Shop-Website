<?php  
session_start();
include('connect.php');
include('Header.php');

if ($_SESSION['Role'] == 'Customer Service Provider')
	{
	echo "<script>alert('Access Denied. Please Login With Higher Account Level like Manager or Administrator!!!');</script>";
	echo "<script>window.location='Staff_Home.php';</script>";
	}

if(isset($_POST['btnSave'])) 
{
	$txtSupplierName=$_POST['txtSupplierName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPhone=$_POST['txtPhone'];
	$txtAddress=$_POST['txtAddress'];

	$check_email="SELECT * FROM Supplier WHERE Email='$txtEmail'";
	$result=mysqli_query($connection,$check_email);
	$count=mysqli_num_rows($result);

	if($count > 0) 
	{
		echo "<script>window.alert('Supplier Email is aleready exist!')</script>";
		echo "<script>window.location='Supplier_Register.php'</script>";
		exit();
	}

	$insert_data="INSERT INTO Supplier
				  (Name,Email,PhoneNumber,OrgAddress)
				  VALUES
				  ('$txtSupplierName','$txtEmail','$txtPhone','$txtAddress')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Supplier Account Successfully Created!')</script>";
		echo "<script>window.location='Supplier_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Supplier Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Supplier Register</title>

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

<form action="Supplier_Register.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill the Supplier Register form here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtSupplierName" placeholder="Enter Supplier Name" required />
	</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95************" required />
	</td>
</tr>
<tr>
	<td>Organization's Address</td>
	<td>
		<textarea name="txtAddress"></textarea>
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
<legend>Supplier Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align="left">
<tr>
	<th>Supplier ID</th>
	<th>Name</th>
	<th>E-mail</th>
	<th>Phone Number</th>
	<th>Org Address</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$Supplier_select="SELECT * FROM Supplier";
	$Supplier_ret=mysqli_query($connection,$Supplier_select);
	$Supplier_count=mysqli_num_rows($Supplier_ret);

	for($i=0;$i<$Supplier_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Supplier_ret);
		$SupplierID=$rows['SupplierID'];

		echo "<tr>";
			echo "<td>$SupplierID</td>";
			echo "<td>" . $rows['Name'] . "</td>";
			echo "<td>" . $rows['Email'] . "</td>";
			echo "<td>" . $rows['PhoneNumber'] . "</td>";
			echo "<td>" . $rows['OrgAddress'] . "</td>";
			echo "<td>
				  <a href='Supplier_Update.php?SupplierID=$SupplierID'>Edit</a> |
				  <a href='Supplier_Delete.php?SupplierID=$SupplierID'>Delete</a>
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