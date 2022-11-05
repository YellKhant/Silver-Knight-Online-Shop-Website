<?php  
session_start(); //Session Declare
include('Header.php');
include('connect.php');
include('Purchase_Functions.php');
include('AutoID_Functions.php');

if(isset($_POST['btnSearch'])) 
{
	$SearchType=$_POST['rdoSearchType'];

	if ($SearchType == 1) 
	{
		$cboPurchaseID=$_POST['cboPurchaseID'];

		$query="SELECT po.*, st.StaffID,st.Name,sup.SupplierID,sup.Name  
			FROM purchaseorder po,staff st,supplier sup
			WHERE po.PurchaseOrderID='$cboPurchaseID'
			AND po.StaffID=st.StaffID
			AND po.SupplierID=sup.SupplierID
			";
		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 2) 
	{
		$From=date('d-M-Y',strtotime($_POST['txtFrom']));
		$To=date('d-M-Y',strtotime($_POST['txtTo']));

		$query="SELECT po.*, st.StaffID,st.Name,sup.SupplierID,sup.Name  
			FROM purchaseorder po,staff st,supplier sup
			WHERE po.Date BETWEEN '$From' AND '$To'
			AND po.StaffID=st.StaffID
			AND po.SupplierID=sup.SupplierID
			";
		$result=mysqli_query($connection,$query);
		$size=mysqli_num_rows($result);
	}

}
elseif (isset($_POST['btnShowall'])) 
{
	$query="SELECT po.*, st.StaffID,st.Name,sup.SupplierID,sup.Name  
			FROM purchaseorder po,staff st,supplier sup
			WHERE po.StaffID=st.StaffID
			AND po.SupplierID=sup.SupplierID
			";
	$result=mysqli_query($connection,$query);
	$size=mysqli_num_rows($result);
}
else
{
	$today=date('d-M-Y');

	$query="SELECT po.*, st.StaffID,st.Name,sup.SupplierID,sup.Name  
			FROM purchaseorder po,staff st,supplier sup
			WHERE po.Date='$today'
			AND po.StaffID=st.StaffID
			AND po.SupplierID=sup.SupplierID
			";
	$result=mysqli_query($connection,$query);
	$size=mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Purchase Search & Report</title>

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

<form action="Purchase_Order_Search.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Choose Search Options below:</legend>
<table width="100%">
	<tr>
		<td>
		<input type="radio" name="rdoSearchType" value="1" checked />Search by Purchase ID <br/>
		<select name="cboPurchaseID">
			<option>Choose Purchase ID</option>
			<?php 
			$P_query="SELECT * FROM purchaseorder";
			$ret=mysqli_query($connection,$P_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$PurchaseOrderID=$rows['PurchaseOrderID'];

				echo "<option value='$PurchaseOrderID'> $PurchaseOrderID</option>";
			}
			?>
		</select>
		</td>

		<td>
		<input type="radio" name="rdoSearchType" value="2" />Search by Date ( From ---<br/>
		<input type="text" name="txtFrom" value="<?php echo date('d-M-Y') ?>" />
		</td>
		<td>
		--- To )
		<input type="text" name="txtTo" value="<?php echo date('d-M-Y') ?>" />
		</td>

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
	echo "<p>No Purchase Record Found...</p>";
}
else
{
?>
	
	<table id="tableid" class="display" border="3">
	<thead>
	<tr>
		<th>#</th>
		<th>Purchase-Order ID</th>
		<th>Date</th>
		<th>Supplier Name</th>
		<th>Total Quantity</th>
		<th>Grand Total</th>
		<th>Action</th>
	</tr>	
	</thead>
	<tbody>
	<?php
	for($i=0;$i<$size;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$PurchaseOrderID=$rows['PurchaseOrderID'];

		echo "<tr>";
			echo "<td>" . ($i + 1) . "</td>";
			echo "<td>" . $rows['PurchaseOrderID'] . "</td>";
			echo "<td>" . $rows['Date'] . "</td>";
			echo "<td>" . $rows['Name'] . "</td>";
			echo "<td>" . $rows['TotalQuantity'] . "</td>";
			echo "<td>" . $rows['GrandTotal'] . "</td>";
			echo "<td>
				  <a href='Purchase_Order_Detail.php?PurchaseOrderID=$PurchaseOrderID'>Details</a> 
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