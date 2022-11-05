<?php  
session_start(); //Session Declare
include('Header.php');
include('connect.php');
include('AutoID_Functions.php');

if(isset($_POST['btnSearch']))
{
	$SearchType=$_POST['rdoSearchType'];

	if ($SearchType == 1) 
	{
		$cboOrderID=$_POST['cboOrderID'];

		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			WHERE ord.OrderID='$cboOrderID'
			AND cu.CustomerID=ord.CustomerID
			";

		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 2) 
	{
		$From=date('d-M-Y',strtotime($_POST['txtFrom']));
		$To=date('d-M-Y',strtotime($_POST['txtTo']));

		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			WHERE ord.Date BETWEEN '$From' AND '$To'
			AND cu.CustomerID=ord.CustomerID
			";
		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 3) 
	{
		$cboOrderStatus=$_POST['cboOrderStatus'];

		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			WHERE ord.OrderStatus='$cboOrderStatus'
			AND cu.CustomerID=ord.CustomerID
			";
		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 4) 
	{
		$cboPaymentStatus=$_POST['cboPaymentStatus'];

		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			WHERE ord.PaymentStatus='$cboPaymentStatus'
			AND cu.CustomerID=ord.CustomerID
			";
		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}
}
elseif (isset($_POST['btnShowall'])) 
{
		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			Where cu.CustomerID=ord.CustomerID
			";

	$result=mysqli_query($connection,$query);
	$size=mysqli_num_rows($result);
}
else
{
	$today=date('d-M-Y');

		$query="SELECT cu.*, ord.*
			FROM Orders ord, Customer cu
			WHERE ord.Date='$today'
			AND cu.CustomerID=ord.CustomerID
			";

	$result=mysqli_query($connection,$query);
	$size=mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Search & Report</title>

<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />

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

<form action="" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Choose search method below:</legend>
<table width="100%">
	<tr>
		<td>
		<input type="radio" name="rdoSearchType" value="1" checked />Search by Order ID <br/>
		<select name="cboOrderID">
			<option>Choose Order ID</option>
        <?php 
        $query="SELECT * FROM Orders";
        $ret=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $OrderID=$row['OrderID'];

            echo "<option value='$OrderID'> $OrderID </option>";
        }
         ?>
		</select>
		</td>

		<td>
		<input type="radio" name="rdoSearchType" value="2" />Search by Date ( From -----------<br/>
		<input type="text" name="txtFrom" value="<?php echo date('d-M-Y') ?>" onClick="showCalender(calender,this)"/>
		</td>
		<td>
		To )
		<input type="text" name="txtTo" value="<?php echo date('d-M-Y') ?>" onClick="showCalender(calender,this)"/>
		</td>

		<td>
		<input type="radio" name="rdoSearchType" value="3" />Search by Order Status <br/>
		<select name="cboOrderStatus">
			<option>Choose Order Status</option>
			<option>Pending</option>
			<option>Confirmed</option>
			<option>Denied</option>
		</select>
		</td>
		<td>
		<input type="radio" name="rdoSearchType" value="4" />Search by Payment Status <br/>
		<select name="cboPaymentStatus">
			<option>Choose Payment Status</option>
			<option>Pending</option>
			<option>Recieved</option>
			<option>Denied Order</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>
			<br/>
			<input type="submit" name="btnSearch" value="Search" />
			<input type="submit" name="btnShowall" value="Show All" />
		</td>
	</tr>
</table>

<hr/>

<?php  

if($size < 1) 
{
	echo "<p>No Order Record Found...</p>";
}
else
{
?>
	
	<table id="tableid" class="display" border="3">
	<thead  align='center'>
	<tr>
		<th>#</th>
		<th>Order ID</th>
		<th>Order Date</th>
		<th>Customer Name</th>
		<th>Total Amount</th>
		<th>Total Quantity</th>
		<th>Grand Total</th>
		<th>Order Status</th>
		<th>Payment Status</th>
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
				   <a href='Order_Details1.php?OrderID=$OrderID'>Details</a> |
				   <a href='Order_Status_Update.php?OrderID=$OrderID'>Edit Status</a>
				  </td>";
		echo "</tr>";
	}
	?>
</tbody>
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