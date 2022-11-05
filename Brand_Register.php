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
	$txtBrandName=$_POST['txtBrandName'];
	$txtDescription=$_POST['txtDescription'];

	$insert_data="INSERT INTO Brand
				  (BName,Description)
				  VALUES
				  ('$txtBrandName','$txtDescription')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Brand Successfully Added!')</script>";
		echo "<script>window.location='Brand_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Brand Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Brand Register</title>

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

<form action="Brand_Register.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill the Brand Register form here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtBrandName" placeholder="Enter Brand Name" required />
	</td>
</tr>
<tr>
	<td>Description</td>
	<td>
		<textarea name="txtDescription"></textarea>
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
<legend>Brand Listing:</legend>

<table id="tableid" class="display" border="1">
<thead align="left">
<tr>
	<th>Brand ID</th>
	<th>Name</th>
	<th>Description</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$Brand_select="SELECT * FROM Brand";
	$Brand_ret=mysqli_query($connection,$Brand_select);
	$Brand_count=mysqli_num_rows($Brand_ret);

	for($i=0;$i<$Brand_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Brand_ret);
		$BrandID=$rows['BrandID'];

		echo "<tr>";
			echo "<td>$BrandID</td>";
			echo "<td>" . $rows['BName'] . "</td>";
			echo "<td>" . $rows['Description'] . "</td>";
			echo "<td>
				  <a href='Brand_Update.php?BrandID=$BrandID'>Edit</a> |
				  <a href='Brand_Delete.php?BrandID=$BrandID'>Delete</a>
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