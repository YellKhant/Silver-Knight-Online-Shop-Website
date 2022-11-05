<?php 
session_start();
include('Header3.php');
include('connect.php');
include('AutoID_Functions.php');
include('Shopping_Cart_Functions.php');

if(isset($_POST['btnCheckout'])) 
{
	$txtOrderID=$_POST['txtOrderID'];
	$txtOrderDate=$_POST['txtOrderDate'];

	$CustomerID=$_SESSION['CustomerID'];

	$rdoAddress=$_POST['rdoAddress'];

	if ($rdoAddress==="SameAddress") 
	{
		$Address=$_SESSION['Address'];
		$Phone=$_SESSION['PhoneNumber'];
	}
	else
	{
		$Address=$_POST['txtAddress'];
		$Phone=$_POST['txtPhone'];
	}

	$TotalQuantity=CalculateTotalQuantity();
	$TotalAmount=CalculateTotalAmount();
	$VAT=CalculateVAT();

	$txtDeliveryCost=$_POST['txtDeliveryCost'];
	$txtGrandTotal=$_POST['txtGrandTotal'];

	$rdoPayment=$_POST['rdoPayment'];
	$OrderStatus="Pending";
	$PaymentStatus="Pending";

	$InsertOrder="INSERT INTO `orders`(`OrderID`, `CustomerID`, `Date`, `Location`, `Contact`, `TotalQuantity`, `TotalAmount`, `Tax`, `DeliveryCost`, `GrandTotal`, `PaymentType`, `OrderStatus`, `PaymentStatus`) 
				   VALUES
				  ('$txtOrderID','$CustomerID','$txtOrderDate','$Address','$Phone','$TotalQuantity','$TotalAmount','$VAT','$txtDeliveryCost','$txtGrandTotal','$rdoPayment','$OrderStatus','$PaymentStatus')
				   ";
	$ret=mysqli_query($connection,$InsertOrder);

	$size=count($_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCart_Functions'][$i]['ProductID'];
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['Quantity'];

		$InsertOrderDetails="INSERT INTO `orderdetail`(`OrderID`, `ProductID`, `Price`, `Quantity`) 
							 VALUES
							 ('$txtOrderID','$ProductID','$Price','$Quantity')
							";
		$ret=mysqli_query($connection,$InsertOrderDetails);
	}

	if($ret) //True
	{
		unset($_SESSION['ShoppingCart_Functions']);
		echo "<script>window.alert('Checkout Process Complete Successfully')</script>";
		echo "<script>window.location='Home.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in making Checkout" . mysqli_error($connection) . "</p>";
	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout Now</title>

<script type="text/javascript">
function SameAddress()
{
	document.getElementById('Same').style.display="block";
	document.getElementById('Other').style.display="none";
}
function OtherAddress()
{
	document.getElementById('Same').style.display="none";
	document.getElementById('Other').style.display="block";
}
function COD()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('WAVEmoney').style.display="none";
}
function KBZPay()
{
	document.getElementById('KBZPay').style.display="block";
	document.getElementById('WAVEmoney').style.display="none";
}
function WAVEmoney()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('WAVEmoney').style.display="block";
}
function GetDeliveryCost()
{
	var e=document.getElementById('cboTownshipID');
	var result=e.options[e.selectedIndex].value;
	document.getElementById('txtDeliveryCost').value=result;

	var TotalAmount=document.getElementById('txtTotalAmount').value;
	var VAT=document.getElementById('txtVAT').value;

	document.getElementById('txtGrandTotal').value=Number(result)+Number(TotalAmount)+Number(VAT);
}
</script>


</head>
<body>

<form action="Checkout.php" method="post">

<a href="Shopping_Cart.php">Back To Shopping Cart <<</a>

<fieldset>
<legend>Checkout Details:</legend>
<table>
<tr>
	<td>OrderID</td>
	<td>
		<input type="text" name="txtOrderID" value="<?php echo AutoID('Orders','OrderID','ORD-',6) ?>" readonly />
	</td>
</tr>
<tr>
	<td>OrderDate</td>
	<td>
		<input type="text" name="txtOrderDate" value="<?php echo date('d-M-Y') ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
	<hr/>
	<input type="hidden" name="txtTotalAmount" id="txtTotalAmount" value="<?php echo CalculateTotalAmount()  ?>">
	<input type="hidden" name="txtVAT" id="txtVAT" value="<?php echo CalculateVAT() ?>">

	Choose Township To Deliver:<br/>
	<select name="cboTownshipID" id="cboTownshipID" onchange="GetDeliveryCost()">
		<option>-Choose Township-</option>
		<?php 
		$T_query="SELECT * FROM Delivery";
		$ret=mysqli_query($connection,$T_query);
		$count=mysqli_num_rows($ret);

		for($i=0;$i<$count;$i++) 
		{ 
			$rows=mysqli_fetch_array($ret);
			$TownshipID=$rows['DeliveryID'];
			$TownshipName=$rows['Township'];
			$DeliveryCost=$rows['Cost'];

			echo "<option value='$DeliveryCost'> $TownshipName - $DeliveryCost MMK </option>";
		}
		?>
	</select>
	<br/> Delivery Cost <br/>
	<input type="text" name="txtDeliveryCost" id="txtDeliveryCost" value="0" readonly />

	<br/> Grand Total <br/>
	<input type="text" name="txtGrandTotal" id="txtGrandTotal" value="0" readonly />

	<hr/>
	<input type="radio" name="rdoAddress" value="SameAddress" onClick="SameAddress()" checked />Same Address	
	<input type="radio" name="rdoAddress" value="OtherAddress" onclick="OtherAddress()" />Other Address	
	
	<div id="Same">
		<p>Your Address :</p>
		<b><?php echo $_SESSION['Address'] ?></b>
		<p>Phone Number :</p>
		<b><?php echo $_SESSION['PhoneNumber'] ?></b>
		<hr/>
	</div>
	
	<div id="Other" style="display: none;">
		<p>Address :</p>
		<textarea name="txtAddress" cols="30"></textarea>
		<p>Phone Number :</p>
		<input type="text" name="txtPhone" placeholder="+95-----------" >
		<hr/>
	</div>
</tr>
<tr>
	<td colspan="2">
	<hr/>
	Choose Payment Types <br/>
	<input type="radio" name="rdoPayment" value="COD" onClick="COD()" checked />
	<img src="images/COD.png" width="90px" height="90px" />

	<input type="radio" name="rdoPayment" value="KBZPay" onClick="KBZPay()" />
	<img src="images/KBZPAY.png" width="90px" height="90px" />

	<input type="radio" name="rdoPayment" value="WAVEmoney" onClick="WAVEmoney()" />
	<img src="images/WAVEmoney.jpg" width="90px" height="90px" />
	<hr/>

	<div id="KBZPay" style="display: none;">
		<p><b>Scan Here to Checkout with KBZ Pay :</b></p>
		<img src="images/KBZQR.png" width="250px" height="250px">
		<hr/>
	</div>

	<div id="WAVEmoney" style="display: none;">
		<p><b>Scan Here to Checkout with Wavemoney :</b></p>
		<img src="images/WAVEQR.jpg" width="250px" height="250px">
		<hr/>
	</div>
	
	<a href="Shopping_Cart.php?action=clearall">Cancel</a> | 
	<input type="submit" name="btnCheckout" value="Checkout Now" />
	</td>
</tr>
</table>
</fieldset>
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
	<table border="1">
	<tr>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Sub-Total</th>
		<th>Image</th>
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
		echo "</tr>";
	}
	?>
	<tr>
		<td colspan="7" align="right">
		Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
		<br/>
		Total Amount : <b><?php echo CalculateTotalAmount() ?> MMK</b>
		<br/>
		Gov Tox (VAT): : <b><?php echo CalculateVAT() ?> MMK</b>
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