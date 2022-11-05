<?php  
session_start(); //Session Declare
include('Header.php');

if (!isset($_SESSION['StaffID'])) 
  {
    echo "<script>alert('Please Login with Staff Account.');</script>";
    echo "<script>window.location='Staff_Login.php';</script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Home</title>
</head>
<body>
<form action="#" method="post">

<h2 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Welcome From Staff Home, <?php echo $_SESSION['Name']?></h2>
<h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Have a Nice Day...</h3>

<hr/>

<table>
<tr>
	<td width="170pt">Manage Staffs</td>
	<td width="50pt">:</td>
	<td><a href="Staff_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td width="170pt">Manage Suppliers</td>
	<td width="50pt">:</td>
	<td><a href="Supplier_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Delivery info</td>
	<td>:</td>
	<td><a href="Delivery_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Categories</td>
	<td>:</td>
	<td><a href="Category_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Brands</td>
	<td>:</td>
	<td><a href="Brand_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Products</td>
	<td>:</td>
	<td><a href="Product_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Customer Orders</td>
	<td>:</td>
	<td><a href="Order_Search.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Input Purchase Orders</td>
	<td>:</td>
	<td><a href="Purchase_Order.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>View Purchase Orders</td>
	<td>:</td>
	<td><a href="Purchase_Order_Search.php">Here</a></td>
</tr>

</table>


</form>
</body>
</html>

<?php 

include ('Footer.php');

 ?>