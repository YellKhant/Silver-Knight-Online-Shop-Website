<?php  
session_start(); //Session Declare
include('Header.php');
include('connect.php');
include('Purchase_Functions.php');
include('AutoID_Functions.php');

$PurchaseOrderID=$_GET['PurchaseOrderID'];

//Single Group------------------------------------------------------------
$query1="SELECT po.*, s.SupplierID,s.Name
		FROM Purchaseorder po,Supplier s
		WHERE po.PurchaseOrderID='$PurchaseOrderID'
		AND po.SupplierID=s.SupplierID
		";
$result1=mysqli_query($connection,$query1);
$row1=mysqli_fetch_array($result1);
//Repeat Group------------------------------------------------------------
$query2="SELECT po.*, pod.*, p.ProductID,p.Name
		FROM Purchaseorder po,PurchaseOrderDetail pod,Product p
		WHERE po.PurchaseOrderID=pod.PurchaseOrderID
		AND pod.ProductID=p.ProductID
		AND pod.PurchaseOrderID='$PurchaseOrderID'
		";
$result2=mysqli_query($connection,$query2);
$count=mysqli_num_rows($result2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order Details :</title>
</head>
<body>
<form action="Purchase_Order_Detail.php" method="post">

<a href="Purchase_Order_Search.php">Back To Purchase Order Search <<</a>

<fieldset>
<legend>Purchase-Order Details for : <?php echo $PurchaseOrderID ?></legend>

<table align="center" border="1" cellpadding="5px" cellspacing="5px">
<tr>
	<td>OrderID</td>
	<td>
		: <b><?php echo $row1['PurchaseOrderID']  ?></b>
	</td>
	<td>Supplier Name</td>
	<td>
		: <b><?php echo $row1['Name'] ?></b>
	</td>
</tr>
<tr>
	<td>Purchase-Order Date</td>
	<td>
		: <b><?php echo $row1['Date']  ?></b>
	</td>
	<td>Report Date</td>
	<td>
		: <b><?php echo date('d-M-Y')  ?></b>
	</td>
</tr>
<tr>
	<td colspan="4">
	<table border="1" width="100%">
	<tr>
		<th>#</th>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Sub-Total</th>
	</tr>
	<?php  
	for($i=0;$i<$count;$i++) 
	{ 
		$row2=mysqli_fetch_array($result2);

		echo "<tr>";	
		echo "<td>" . ($i+1) . "</td>";
		echo "<td>" . $row2['ProductID'] . "</td>";
		echo "<td>" . $row2['Name'] . "</td>";
		echo "<td>" . $row2['PurchasePrice'] . "</td>";
		echo "<td>" . $row2['PurchaseQuantity'] . "</td>";
		echo "<td>" . $row2['PurchasePrice'] * $row2['PurchaseQuantity'] . "</td>";
		echo "</tr>";	
	}
	?>
	</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="right">

	<p>TotalQuantity : <b><?php echo $row1['TotalQuantity'] ?></b> pcs</p>
	<p>TotalAmount : <b><?php echo $row1['TotalAmount'] ?></b> MMK</p>
	<p>Tax(5%) : <b><?php echo $row1['Tax'] ?></b> MMK</p>
	<p>GrandTotal : <b><?php echo $row1['GrandTotal'] ?></b> MMK</p>
	
	</td>
</table>

</fieldset>	

</form>
</body>
</html>

<?php 

include('Footer.php');

 ?>