<?php  
session_start();
include('Header3.php');
include('connect.php');
include('Shopping_Cart_Functions.php');

if (!isset($_SESSION['CustomerID'])) 
  {
    echo "<script>alert('Please Login Account.');</script>";
    echo "<script>window.location='Customer_Login.php';</script>";
  }

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];
	
	if($action === "remove") 
	{
		$ProductID=$_GET['ProductID'];
		RemoveProduct($ProductID);
	}
	elseif ($action === "clearall") 
	{
		ClearAll();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
</head>
<body>
<form>

<fieldset>
<legend>Shopping Cart Details :</legend>
<?php  
if(!isset($_SESSION['ShoppingCart_Functions'])) 
{
	echo "<p>Empty Cart!</p>";
	echo "<a href='Product_Display.php'>Back to Product Display</a>";
}
else
{
?>
	<table border="1" align="center" width="100%">
	<tr>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Sub-Total</th>
		<th>Image</th>
		<th>Action</th>
	</tr>
	<?php  
	$count=count($_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCart_Functions'][$i]['ProductID'];
		$ProductImage1=$_SESSION['ShoppingCart_Functions'][$i]['Image1'];
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price']; 
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['Quantity'];
		$SubTotal=$Price * $Quantity;

		echo "<tr>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['ProductID'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Name'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Price'] . " MMK</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Quantity'] . " pcs</td>";

			echo "<td>" . $SubTotal . " MMK </td>";

			echo "<td><img src='$ProductImage1' width='80px' height='100px' /></td>";

			echo "<td>
					<a href='Shopping_Cart.php?action=remove&ProductID=$ProductID'>Remove</a>
				  </td>";

		echo "</tr>";
	}
	?>
	<tr>
		<td colspan="7" align="right">
		Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
		<br/>
		Total Amount : <b><?php echo CalculateTotalAmount() ?> MMK</b>
		<br/>
		Tax : <b><?php echo CalculateVAT() ?> MMK</b>
		<br/>
		Grand Total : <b><?php echo CalculateTotalAmount() + CalculateVAT() ?> MMK</b>
		</td>
	</tr>
	<tr>
		<td colspan="7" align="right">
		<a href="Product_Display.php">Continue Shopping</a>
		|
		<a href="Shopping_Cart.php?action=clearall">Clear All</a>
		|
		<a href="Checkout.php">Checkout Now</a>
		</td>
	</tr>
	</table>
<?php
}
?>
</fieldset>	

</form>
</body>
</html>

<?php 

include ('Footer1.php');

 ?>