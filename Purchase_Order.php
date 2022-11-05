<?php  
session_start(); //Session Declare
include('connect.php');
include('AutoID_Functions.php');
include('Purchase_Functions.php');
include('Header.php');

if ($_SESSION['Role'] == 'Customer Service Provider')
	{
	echo "<script>alert('Access Denied. Please Login With Higher Account Level like Manager or Administrator!!!');</script>";
	echo "<script>window.location='Staff_Home.php';</script>";
	}

if (isset($_POST['btnSave'])) 
{
	$txtPurchaseOrderID=$_POST['txtPurchaseOrderID'];
	$txtPurchaseDate=$_POST['txtPurchaseDate'];
	$txtTotalAmount=$_POST['txtTotalAmount'];
	$txtTotalQuantity=$_POST['txtTotalQuantity'];
	$txtVAT=$_POST['txtVAT'];
	$txtGrandTotal=$_POST['txtGrandTotal'];
	$cboSupplierID=$_POST['cboSupplierID'];

	$StaffID=$_SESSION['StaffID'];

	$POInsert="INSERT INTO `purchaseorder`
			(`PurchaseOrderID`, `SupplierID`, `StaffID`, `Date`, `TotalQuantity`, `TotalAmount`, `Tax`, `GrandTotal`) 
				VALUES
			('$txtPurchaseOrderID','$cboSupplierID','$StaffID','$txtPurchaseDate','$txtTotalQuantity','$txtTotalAmount','$txtVAT','$txtGrandTotal') 
		   	  ";
	$ret=mysqli_query($connection,$POInsert);

	//Looping and Insert Data to Dummy Table
	$size=count($_SESSION['Purchase_Functions']);

	for($i=0; $i<$size;$i++) 
	{ 
		$ProductID=$_SESSION['Purchase_Functions'][$i]['ProductID'];
		$PurchasePrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$PODInsert="INSERT INTO `purchaseorderdetail`
					(`PurchaseOrderID`, `ProductID`, `PurchasePrice`, `PurchaseQuantity`) 
					VALUES
					('$txtPurchaseOrderID','$ProductID','$PurchasePrice','$PurchaseQuantity')
		   	  ";
		$ret=mysqli_query($connection,$PODInsert);
	}

	if($ret) //True
	{
		unset($_SESSION['Purchase_Functions']);
		echo "<script>window.alert('Purchase Order Successfully Save!')</script>";
		echo "<script>window.location='Purchase_Order.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Purchase_Order" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_POST['btnAdd'])) 
{	
	$ProductID=$_POST['cboProductID'];
	$PurchasePrice=$_POST['txtPurchasePrice'];
	$PurchaseQuantity=$_POST['txtPurchaseQuantity'];

	AddProduct($ProductID,$PurchasePrice,$PurchaseQuantity);
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
	<title>Purchase Order</title>
</head>
<body>
<form action="Purchase_Order.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill Purchase Order Information here:</legend>

<table>
<tr>
	<td>Purchase Order ID</td>
	<td>
		<input type="text" name="txtPurchaseOrderID" value="<?php echo AutoID('PurchaseOrder','PurchaseOrderID','PUR-',6) ?>" readonly />
	</td>
</tr>
<tr>
	<td>Purchase Date</td>
	<td>
		<input type="text" name="txtPurchaseDate" value="<?php echo date('d-M-Y') ?>" readonly />
	</td>
</tr>
<tr>
	<td>Staff Name</td>
	<td>
		<input type="text" name="txtStaffInfo" value="<?php echo $_SESSION['Name'] ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td>Total Quantity</td>
	<td>
		<input type="text" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>" readonly />
	</td>
</tr>
<tr>
	<td>Total Amount</td>
	<td>
		<input type="text" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly />
	</td>
</tr>
<tr>
	<td>TAX (5%)</td>
	<td>
		<input type="text" name="txtVAT" value="<?php echo CalculateVAT() ?>" readonly />
	</td>
</tr>
<tr>
	<td>Grand Total</td>
	<td>
		<input type="text" name="txtGrandTotal" value="<?php echo CalculateTotalAmount() + CalculateVAT() ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td>Product</td>
	<td>
		<select name="cboProductID">
			<?php 
			$P_query="SELECT * FROM Product";
			$ret=mysqli_query($connection,$P_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$ProductID=$rows['ProductID'];
				$ProductName=$rows['Name'];

				echo "<option value='$ProductID'> $ProductID - $ProductName </option>";
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td>Purchase Price</td>
	<td>
		<input type="number" name="txtPurchasePrice" value="0" required/>
	</td>
</tr>
<tr>
	<td>Purchase Quantity</td>
	<td>
		<input type="number" name="txtPurchaseQuantity" value="0" required/>
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnAdd" value="Add" />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
</table>

</fieldset>

<fieldset>
<legend>Purchase Details:</legend>
<?php  
if(!isset($_SESSION['Purchase_Functions'])) 
{
	echo "<p>No Purchase Details Found.</p>";
}
else
{
?>
	<table border="1">
	<tr>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>PurchasePrice</th>
		<th>PurchaseQuantity</th>
		<th>Sub-Total</th>
		<th>Image</th>
		<th>Action</th>
	</tr>
	<?php  
	$count=count($_SESSION['Purchase_Functions']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ProductID=$_SESSION['Purchase_Functions'][$i]['ProductID'];
		$ProductImage1=$_SESSION['Purchase_Functions'][$i]['Image1'];

		$PurchasePrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice']; 
		$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];
		$SubTotal=$PurchasePrice * $PurchaseQuantity;

		echo "<tr>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['ProductID'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['Name'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['PurchasePrice'] . " MMK</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'] . " pcs</td>";

			echo "<td>" . $SubTotal . " MMK </td>";

			echo "<td><img src='$ProductImage1' width='80px' height='100px' /></td>";

			echo "<td>
					<a href='Purchase_Order.php?action=remove&ProductID=$ProductID'>Remove</a>
				  </td>";

		echo "</tr>";
	}
	?>
 	<tr>
		<td colspan="7" align="right">
		<a href="Purchase_Order.php?action=clearall">Clear All</a>

		<p align="left">Choose Supplier from below:</p>
		<select name="cboSupplierID">
			<?php 
			$S_query="SELECT * FROM Supplier";
			$ret=mysqli_query($connection,$S_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$SupplierID=$rows['SupplierID'];
				$SupplierName=$rows['Name'];

				echo "<option value='$SupplierID'> $SupplierID - $SupplierName </option>";
			}
			?>
		</select>
		
		<input type="submit" name="btnSave" value="Save" />
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

include('Footer.php');

?>