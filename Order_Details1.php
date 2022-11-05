<?php  
session_start(); //Session Declare
include('Header.php');
include('connect.php');
include('Shopping_Cart_Functions.php');
include('AutoID_Functions.php');

$OrderID=$_GET['OrderID'];

//Single Group------------------------------------------------------------
$query1="SELECT ord.*, c.CustomerID,c.FirstName,c.LastName
		FROM orders ord,customer c
		WHERE ord.OrderID='$OrderID'
		AND ord.CustomerID=c.CustomerID
		";
$result1=mysqli_query($connection,$query1);
$row1=mysqli_fetch_array($result1);
//Repeat Group------------------------------------------------------------
$query2="SELECT ord.*, ordd.*, p.ProductID,p.Name
		FROM orders ord,orderdetail ordd,product p
		WHERE ord.OrderID=ordd.OrderID
		AND ordd.ProductID=p.ProductID
		AND ordd.OrderID='$OrderID'
		";
$result2=mysqli_query($connection,$query2);
$count=mysqli_num_rows($result2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Order Details :</title>
</head>
<body>
<form action="Order_Details1.php" method="post">

<a href="Order_Search.php">Back To Order Search <<</a>

<fieldset>
<legend>Order Details for : <?php echo $OrderID ?></legend>

<table align="center" border="1" cellpadding="5px" cellspacing="5px">
<tr>
	<td>OrderID</td>
	<td>
		: <b><?php echo $row1['OrderID']  ?></b>
	</td>
	<td>Customer Name</td>
	<td>
		: <b><?php echo $row1['FirstName'] . ' ' . $row1['LastName']  ?></b>
	</td>
</tr>
<tr>
	<td>Order Status</td>
	<td>
		: <b><?php echo $row1['OrderStatus']  ?></b>
	</td>
	<td>Payment Status</td>
	<td>
		: <b><?php echo $row1['PaymentStatus']  ?></b>
	</td>
</tr>
<tr>
	<td>Order Date</td>
	<td>
		: <b><?php echo $row1['Date']  ?></b>
	</td>
	<td>Report Date</td>
	<td>
		: <b><?php echo date('d-M-Y')  ?></b>
	</td>
</tr>
<tr>
	<td>Address To Deliver</td>
	<td>
		: <b><?php echo $row1['Location'] ?></b>
	</td>
	<td>Contact</td>
	<td>
		: <b><?php echo $row1['Contact'] ?></b>
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
		echo "<td>" . $row2['Price'] . "</td>";
		echo "<td>" . $row2['Quantity'] . "</td>";
		echo "<td>" . $row2['Price'] * $row2['Quantity'] . "</td>";
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
	<p>Delivery Fee : <b><?php echo $row1['DeliveryCost'] ?></b> MMK</p>
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