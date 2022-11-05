<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtCategoryID=$_POST['txtCategoryID'];
	$txtCategoryName=$_POST['txtCategoryName'];
	$textDescription=$_POST['textDescription'];

	//Update Category Data in table
	$update_data="UPDATE Category 
				  SET 
				  CName='$txtCategoryName',
				  Description='$textDescription'
				  WHERE CategoryID='$txtCategoryID'
				  ";
	$result=mysqli_query($connection,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Category Information Successfully Updated!')</script>";
		echo "<script>window.location='Category_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Updating Category" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['CategoryID'])) 
{
	$CategoryID=$_GET['CategoryID'];

	$query="SELECT * FROM Category WHERE CategoryID='$CategoryID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$CategoryID="";
	echo "<script>window.alert('Somthing went wrong | CategoryID not found')</script>";
	echo "<script>window.location='Category_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Category Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Category_Update.php" method="post">

<a href="Category_Register.php">Back to Category Register <<</a>

<fieldset>
<legend>Update Category Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtCategoryName" value="<?php echo $rows['CName'] ?>" required />
	</td>
</tr>
<tr>
	<td>Description</td>
	<td>
		<input type="text" name="textDescription" value="<?php echo $rows['Description'] ?>" required />
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
		<input type="hidden" name="txtCategoryID" value="<?php echo $rows['CategoryID'] ?>" />
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