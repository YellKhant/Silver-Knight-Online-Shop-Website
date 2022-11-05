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
	$txtProductName=$_POST['txtProductName'];
	$txtSize=$_POST['txtSize'];
	$txtColor=$_POST['txtColor'];
	$txtPrice=$_POST['txtPrice'];
	$txtQuantity=$_POST['txtQuantity'];
	$cboBrandID=$_POST['cboBrandID'];
	$cboCategoryID=$_POST['cboCategoryID'];
	$txtDescription=$_POST['txtDescription'];
	$cboStatus=$_POST['cboStatus'];

	//Image Upload Coding Start--------------------------------------
	$Image1=$_FILES['Image1']['name'];
	$Folder="ProductImage/";

	$FileName1=$Folder . '_' . $Image1; 

	$copied=copy($_FILES['Image1']['tmp_name'], $FileName1);

	if(!$copied) 
	{
		echo "<p>Product View 1 cannot upload!</p>";
		exit();
	}
	//======================================================
	$Image2=$_FILES['Image2']['name']; 
	$Folder="ProductImage/";

	$FileName2=$Folder . '_' . $Image2; 

	$copied=copy($_FILES['Image2']['tmp_name'], $FileName2);

	if(!$copied) 
	{
		echo "<p>Product View 2 cannot upload!</p>";
		exit();
	}
	//======================================================

	$ProductInsert="INSERT INTO Product
				  (Name,BrandID,CategoryID,Color,Size,Price,Quantity,Status,Image1,Image2,Description)
				  VALUES
				  ('$txtProductName','$cboBrandID','$cboCategoryID','$txtColor','$txtSize','$txtPrice','$txtQuantity','$cboStatus','$FileName1','$FileName2','$txtDescription')
				  ";

	$result=mysqli_query($connection,$ProductInsert);

	if($result) //True
	{
		echo "<script>window.alert('New Product Successfully Registered')</script>";
		echo "<script>window.location='Product_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Product Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Product Entry</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Product_Register.php" method="post" enctype="multipart/form-data">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<script>
	$(document).ready( function (){
		$('#tableid').DataTable();
	} );
</script>

<fieldset>
<legend>Fill Product Information here:</legend>

<table>
<tr>
	<td>Name</td>
	<td>
		<input type="text" name="txtProductName" placeholder="Enter Product Name" required />
	</td>
</tr>
<tr>
	<td>Brand</td>
	<td>
		<select name="cboBrandID">
			<?php 
			$B_query="SELECT * FROM Brand";
			$ret=mysqli_query($connection,$B_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$BrandID=$rows['BrandID'];
				$BrandName=$rows['BName'];

				echo "<option value='$BrandID'> $BrandName </option>";
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td>Category</td>
	<td>
		<select name="cboCategoryID">
			<?php 
			$C_query="SELECT * FROM Category";
			$ret=mysqli_query($connection,$C_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$CategoryID=$rows['CategoryID'];
				$CategoryName=$rows['CName'];

				echo "<option value='$CategoryID'> $CategoryName </option>";
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td>Color</td>
	<td>
		<input type="text" name="txtColor" placeholder="Enter Product Color" required />
	</td>
</tr>
<tr>
	<td>Size</td>
	<td>
		<input type="text" name="txtSize" placeholder="Enter Product Size" required />
	</td>
</tr>
<tr>
	<td>Price</td>
	<td>
		<input type="number" name="txtPrice" placeholder="Enter Product Price" required />
	</td>
</tr>
<tr>
	<td>Quantity</td>
	<td>
		<input type="number" name="txtQuantity" placeholder="Enter Product Quantity" required />
	</td>
</tr>
<tr>
	<td>Status</td>
	<td>
		<select name="cboStatus">
			<option>In Stock</option>
			<option>Sold Out</option>
			<option>Discount</option>
			<option>Promotion</option>
		</select>
	</td>
</tr>
<tr>
	<td>View 1</td>
	<td>
		<input type="file" name="Image1" required />
	</td>
</tr>
<tr>
	<td>View 2</td>
	<td>
		<input type="file" name="Image2" required />
	</td>
</tr>
<tr>
	<td>Description</td>
	<td>
		<textarea name="txtDescription" placeholder="Enter Description Here"></textarea>
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
<legend>Product Listing:</legend>

<table id="tableid" class="display" border="1">
<thead align="left">

<tr>
	<th>Product ID</th>
	<th>View 1</th>
	<th>Name</th>
	<th>Size</th>
	<th>Color</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Status</th>
	<th>Description</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$pro_select="SELECT * FROM Product";
	$pro_ret=mysqli_query($connection,$pro_select);
	$pro_count=mysqli_num_rows($pro_ret);

	for($i=0;$i<$pro_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($pro_ret);
		$ProductID=$rows['ProductID'];
		$Image1=$rows['Image1'];

		echo "<tr>";
			echo "<td>$ProductID</td>";
			echo "<td><img src='$Image1' width='80px' height='100px'/></td>";
			echo "<td>" . $rows['Name'] . "</td>";
			echo "<td>" . $rows['Size'] . "</td>";
			echo "<td>" . $rows['Color'] . "</td>";
			echo "<td align='right'>" . $rows['Price'] . "(mmk)</td>";
			echo "<td>" . $rows['Quantity'] . "</td>";
			echo "<td>" . $rows['Status'] . "</td>";
			echo "<td>" . $rows['Description'] . "</td>";
			echo "<td>
				  <a href='Product_Update.php?ProductID=$ProductID'>Edit</a> |
				  <a href='Product_Delete.php?ProductID=$ProductID'>Delete</a>
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