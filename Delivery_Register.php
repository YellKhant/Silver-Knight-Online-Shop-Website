<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnSave'])) 
{
	$txtTownship=$_POST['txtTownship'];
	$txtCost=$_POST['txtCost'];

	$insert_data="INSERT INTO Delivery
				  (Township,Cost)
				  VALUES
				  ('$txtTownship','$txtCost')
				  ";
	$result=mysqli_query($connection,$insert_data);

	if($result) //True
	{
		echo "<script>window.alert('Deli info Successfully Added!')</script>";
		echo "<script>window.location='Delivery_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Deli info Registeration!" . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Delivery Register</title>

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

<form action="Delivery_Register.php" method="post">

<a href="Staff_Home.php">Back to Staff Home <<</a>

<fieldset>
<legend>Fill Delivery related info here:</legend>

<table>
<tr>
	<td>Township</td>
	<td>
		<input type="text" name="txtTownship" placeholder="Enter Township Name" required />
	</td>
</tr>
<tr>
	<td>Cost</td>
	<td>
		<input type="number" name="txtCost" placeholder="Enter the cost (mmk)" required />
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
<legend>Delivery Info Listing:</legend>

<table id="tableid" class="display" border="1">
<thead align="left">
<tr>
	<th>Delivery ID</th>
	<th>Township</th>
	<th>Cost</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$Deli_select="SELECT * FROM Delivery";
	$Deli_ret=mysqli_query($connection,$Deli_select);
	$Deli_count=mysqli_num_rows($Deli_ret);

	for($i=0;$i<$Deli_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Deli_ret);
		$DeliveryID=$rows['DeliveryID'];

		echo "<tr>";
			echo "<td>$DeliveryID</td>";
			echo "<td>" . $rows['Township'] . "</td>";
			echo "<td align='right'>" . $rows['Cost'] . "(mmk)</td>";
			echo "<td>
				  <a href='Delivery_Update.php?DeliveryID=$DeliveryID'>Edit</a> |
				  <a href='Delivery_Delete.php?DeliveryID=$DeliveryID'>Delete</a>
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