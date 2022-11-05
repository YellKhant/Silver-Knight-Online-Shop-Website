<?php  
function AddProduct($ProductID,$PurchasePrice,$PurchaseQuantity)
{
	include('connect.php');

	$query="SELECT * FROM Product WHERE ProductID='$ProductID' ";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);

	if ($count < 1) 
	{
		echo "<p>No Product Information Found!</p>";
		exit();
	}

	if ($PurchaseQuantity < 1) 
	{
		echo "<p>Please enter correct quantity to purchase.</p>";
		exit();
	}

	if(isset($_SESSION['Purchase_Functions'])) 
	{
		$index=IndexOf($ProductID);

		if($index == -1) 
		{
			$size=count($_SESSION['Purchase_Functions']);

			$_SESSION['Purchase_Functions'][$size]['ProductID']=$ProductID;
			$_SESSION['Purchase_Functions'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['Purchase_Functions'][$size]['PurchaseQuantity']=$PurchaseQuantity;

			$_SESSION['Purchase_Functions'][$size]['Name']=$rows['Name'];
			$_SESSION['Purchase_Functions'][$size]['Image1']=$rows['Image1'];
		}
		else
		{
			$_SESSION['Purchase_Functions'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		//Condition 1

		$_SESSION['Purchase_Functions']=array();

		$_SESSION['Purchase_Functions'][0]['ProductID']=$ProductID;
		$_SESSION['Purchase_Functions'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['Purchase_Functions'][0]['PurchaseQuantity']=$PurchaseQuantity;

		$_SESSION['Purchase_Functions'][0]['Name']=$rows['Name'];
		$_SESSION['Purchase_Functions'][0]['Image1']=$rows['Image1'];
	}

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function RemoveProduct($ProductID)
{
	$index=IndexOf($ProductID);

	unset($_SESSION['Purchase_Functions'][$index]);
	$_SESSION['Purchase_Functions']=array_values($_SESSION['Purchase_Functions']);
	echo "<script>window.location='Purchase_Order.php'</script>";

}

function ClearAll()
{
	unset($_SESSION['Purchase_Functions']);
	echo "<script>window.location='Purchase_Order.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;
	@$size=count((array)$_SESSION['Purchase_Functions']);          //big problem

	for($i=0;$i<$size;$i++) 
	{ 
		$PurchasePrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalAmount+=($PurchasePrice * $PurchaseQuantity);
	}
	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	@$size=count((array)$_SESSION['Purchase_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalQuantity+=$PurchaseQuantity;
	}
	return $TotalQuantity;
}

function CalculateVAT()
{
	$VAT=0;

	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function IndexOf($ProductID)
{
	//Linear Search
	if(!isset($_SESSION['Purchase_Functions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['Purchase_Functions']); 

	if($size < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++) 
	{ 
		if ($ProductID == $_SESSION['Purchase_Functions'][$i]['ProductID']) 
		{
			return $i;
		}
	}
	return -1;
}
?>