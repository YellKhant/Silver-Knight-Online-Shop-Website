<?php  
session_start();
include('Header2.php');
include('connect.php');
include('Shopping_Cart_Functions.php');

if(isset($_POST['btnAddtoCart'])) 
{
	$ProductID=$_POST['txtProductID'];
	$Quantity=$_POST['txtBuyQuantity'];

	AddtoCart($ProductID,$Quantity);
}

$ProductID=$_GET['ProductID'];

$query="SELECT p.*, b.BrandID,b.BName,c.CategoryID,c.CName 
		FROM Product p, Brand b, Category c
		WHERE ProductID='$ProductID' 
		AND b.BrandID=p.BrandID
		AND c.CategoryID=p.CategoryID";
$ret=mysqli_query($connection,$query);
$rows=mysqli_fetch_array($ret);

$ProductImage1=$rows['Image1'];
$ProductImage2=$rows['Image2'];

list($width,$heigh)=getimagesize($ProductImage1);
$w=$width/20;
$h=$heigh/20;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Details</title>
</head>
<body>
<form action="Product_Details.php" method="post">

<a href="Product_Display.php">Back to Product Display <<</a>

<table align="center">
<tr>
	<td>
		<img id="PImage" src="<?php echo $ProductImage1 ?>" width="300" height="300" />
		<hr/>
		<img src="<?php echo $ProductImage1 ?>" width="150px" height="150px" 
		onClick="document.getElementById('PImage').src='<?php echo $ProductImage1 ?>'" />

		<img src="<?php echo $ProductImage2 ?>" width="150px" height="150px" 
		onClick="document.getElementById('PImage').src='<?php echo $ProductImage2 ?>'" />

	</td>
	<td>
		<table cellspacing="4px" cellpadding="4px">
		<tr>
			<td>ProductName</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['Name'] ?></b>
			</td>
		</tr>
		<tr>
			<td>BrandName</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['BName'] ?></b>
			</td>
		</tr>
		<tr>
			<td>CategoryName</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['CName'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Color</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['Color'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Size</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['Size'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>-</td>
			<td>
				<b><?php echo $rows['Status'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Price</td>
			<td>-</td>
			<td>
				<b style="color: red;"><?php echo $rows['Price'] ?> MMK</b>
			</td>
		</tr>
		<tr>
			<td>Buy Quantity</td>
			<td>-</td>
			<td>
				<input type="number" name="txtBuyQuantity" value="1" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<hr/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<input type="hidden" name="txtProductID" value="<?php echo $rows['ProductID'] ?>" />
				<input type="submit" name="btnAddtoCart" value="Add to Cart" />
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>

</form>
</body>
</html>

<?php 

include('Footer1.php');

 ?>