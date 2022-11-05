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
	$txtCategoryName=$_POST['txtCategoryName'];
	$txtDescription=$_POST['txtDescription'];

	$insert_data="INSERT INTO Category
				  (CName,Description)
				  VALUES
				  ('$txtCategoryName','$txtDescription')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Category Successfully Added!')</script>";
		echo "<script>window.location='Category_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Category Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Category Register</title>

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

<form action="Category_Register.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill the Category Register form here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtCategoryName" placeholder="Enter Category Name" required />
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
<legend>Category Listing:</legend>

<table id="tableid" class="display" border="1">
<thead align="left">
<tr>
	<th>Category ID</th>
	<th>Name</th>
	<th>Description</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$Category_select="SELECT * FROM Category";
	$Category_ret=mysqli_query($connection,$Category_select);
	$Category_count=mysqli_num_rows($Category_ret);

	for($i=0;$i<$Category_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Category_ret);
		$CategoryID=$rows['CategoryID'];

		echo "<tr>";
			echo "<td>$CategoryID</td>";
			echo "<td>" . $rows['CName'] . "</td>";
			echo "<td>" . $rows['Description'] . "</td>";
			echo "<td>
				  <a href='Category_Update.php?CategoryID=$CategoryID'>Edit</a> |
				  <a href='Category_Delete.php?CategoryID=$CategoryID'>Delete</a>
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