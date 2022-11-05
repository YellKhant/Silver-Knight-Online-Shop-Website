<?php  
function AddtoCart($ProductID,$Quantity)
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

	if ($Quantity < 1) 
	{
		echo "<p>Please enter correct quantity to Order.</p>";
		exit();
	}

	if(isset($_SESSION['ShoppingCart_Functions'])) 
	{
		$index=IndexOf($ProductID);

		if($index == -1) 
		{
			$size=count($_SESSION['ShoppingCart_Functions']);

			$_SESSION['ShoppingCart_Functions'][$size]['ProductID']=$ProductID;
			$_SESSION['ShoppingCart_Functions'][$size]['Quantity']=$Quantity;

			$_SESSION['ShoppingCart_Functions'][$size]['Name']=$rows['Name'];
			$_SESSION['ShoppingCart_Functions'][$size]['Price']=$rows['Price'];
			$_SESSION['ShoppingCart_Functions'][$size]['Image1']=$rows['Image1'];
		}
		else
		{
			$_SESSION['ShoppingCart_Functions'][$index]['Quantity']+=$Quantity;
		}
	}
	else
	{
		//Condition 1

		$_SESSION['ShoppingCart_Functions']=array();

		$_SESSION['ShoppingCart_Functions'][0]['ProductID']=$ProductID;
		$_SESSION['ShoppingCart_Functions'][0]['Quantity']=$Quantity;

		$_SESSION['ShoppingCart_Functions'][0]['Name']=$rows['Name'];
		$_SESSION['ShoppingCart_Functions'][0]['Price']=$rows['Price'];
		$_SESSION['ShoppingCart_Functions'][0]['Image1']=$rows['Image1'];
	}

	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function RemoveProduct($ProductID)
{
	$index=IndexOf($ProductID);

	unset($_SESSION['ShoppingCart_Functions'][$index]);
	$_SESSION['ShoppingCart_Functions']=array_values($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='Shopping_Cart.php'</script>";

}

function ClearAll()
{
	unset($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	@$size=count((array)$_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['Quantity'];

		$TotalAmount+=($Price * $Quantity);
	}
	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	@$size=count((array)$_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['Quantity'];

		$TotalQuantity+=$Quantity;
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
	if(!isset($_SESSION['ShoppingCart_Functions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['ShoppingCart_Functions']); 

	if($size < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++) 
	{ 
		if ($ProductID == $_SESSION['ShoppingCart_Functions'][$i]['ProductID']) 
		{
			return $i;
		}
	}
	return -1;
}


?>