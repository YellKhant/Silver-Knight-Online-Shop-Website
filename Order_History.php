<?php  
session_start();
include('Header3.php');
include('connect.php');

if (!isset($_SESSION['CustomerID'])) 
  {
    echo "<script>alert('Please Login Account.');</script>";
    echo "<script>window.location='Customer_Login.php';</script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
<title>Orders</title>

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

<form action="Order_History.php" method="post">
<fieldset>
<legend>Your Order History :</legend>
<?php  
	$CustomerID=$_SESSION['CustomerID'];

	$query="SELECT ord.*, c.CustomerID,c.FirstName, c.LastName
			FROM Orders ord,Customer c
			WHERE ord.CustomerID='$CustomerID'
			AND ord.CustomerID=c.CustomerID
			";
	$result=mysqli_query($connection,$query);
	$size=mysqli_num_rows($result);
?>
	<table id="tableid" class="display" border="3">
	<thead>
	<tr>
		<th>#</th>
		<th>OrderID</th>
		<th>OrderDate</th>
		<th>CustomerName</th>
		<th>TotalAmount</th>
		<th>TotalQuantity</th>
		<th>GrandTotal</th>
		<th>Order Status</th>
		<th> Payment Status</th>
		<th>Action</th>
	</tr>	
	</thead>
	<tbody>
	<?php
	for($i=0;$i<$size;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$OrderID=$rows['OrderID'];

		echo "<tr>";
			echo "<td>" . ($i + 1) . "</td>";
			echo "<td>" . $rows['OrderID'] . "</td>";
			echo "<td>" . $rows['Date'] . "</td>";
			echo "<td>" . $rows['FirstName'] . ' ' . $rows['LastName'] . "</td>";
			echo "<td>" . $rows['TotalAmount'] . "</td>";
			echo "<td>" . $rows['TotalQuantity'] . "</td>";
			echo "<td>" . $rows['GrandTotal'] . "</td>";
			echo "<td>" . $rows['OrderStatus'] . "</td>";
			echo "<td>" . $rows['PaymentStatus'] . "</td>";
			echo "<td>
				  <a href='Order_Details.php?OrderID=$OrderID'>Details</a> 
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

include('Footer1.php');

 ?>