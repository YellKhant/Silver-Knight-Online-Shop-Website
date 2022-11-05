<?php  
session_start();
include('connect.php');
include('Header2.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Display</title>
</head>
<body>
<form action="Product_Display.php" method="post">

<table width="100%">
<tr>
	<td align="right">
	<input type="text" name="txtData" placeholder="Enter Search Data" />
	</td>
	<td>
		<p></p>
	</td>
	<td>
		<input type="submit" name="btnSearch" value="Search Now">	
	</td>
</tr>
</table>

<hr/>

<table align="left" cellpadding="8px" cellspacing="8px">
<?php  

if(isset($_POST['btnSearch'])) 
{
	$txtData=$_POST['txtData'];

	$query1="SELECT * FROM Product
			 WHERE Name LIKE '%$txtData%'
			 OR Price='$txtData'
			 ";
	$result1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($result1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM Product
				WHERE Name LIKE '%$txtData%'
				OR Price='$txtData'
				LIMIT $i,4";
		$result2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($result2);	

		echo "<tr>";
		for ($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($result1);

			$ProductID=$row['ProductID'];
			$ProductName=$row['Name'];
			$Price=$row['Price'];
			$ProductImage1=$row['Image1'];

			list($width,$heigh)=getimagesize($ProductImage1);
			$w=$width/20;
			$h=$heigh/20;
		?>
			<td>
				<img src="<?php echo $ProductImage1 ?>" width="<?php echo $w ?>" height="<?php echo $h ?>" />
				<hr/>
				<b><?php echo $ProductName ?></b>
				<hr/>
				<b><?php echo $Price ?>  MMK</b>
				<hr/>
				<a href="Product_Details.php?ProductID=<?php echo $ProductID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}

}
else
{
	$query1="SELECT * FROM Product";
	$result1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($result1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM Product
				 LIMIT $i,4";
		$result2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($result2);	

		echo "<tr>";
		for ($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($result1);

			$ProductID=$row['ProductID'];
			$ProductName=$row['Name'];
			$Price=$row['Price'];
			$ProductImage1=$row['Image1'];

			list($width,$heigh)=getimagesize($ProductImage1);
			$w=$width/20;
			$h=$heigh/20;
		?>
			<td>
				<img src="<?php echo $ProductImage1 ?>" width="150pt" height="150pt" />
				<hr/>
				<b><?php echo $ProductName ?></b>
				<hr/>
				<b><?php echo $Price ?>  MMK</b>
				<hr/>
				<a href="Product_Details.php?ProductID=<?php echo $ProductID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}
}

?>

</table>

</form>
</body>
</html>

<?php 

include('Footer2.php');

 ?>