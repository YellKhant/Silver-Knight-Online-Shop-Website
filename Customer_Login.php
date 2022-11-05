<?php  
session_start(); //Session Declare
include('connect.php');
include('Header1.php');

if (isset($_SESSION['loginCount']))
	{
	if($_SESSION ['loginCount'] >=3)
	{
		echo "<script> window.alert ('Please Try Again in 10 Minutes')</script>";
		echo "<script> window.location = 'LoginTimer1.php'</script>";
	}
	}
	else if (!isset($_SESSION['loginCount']))
	{
	$_SESSION['loginCount']=0;
	}

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$check="SELECT * FROM Customer
			WHERE Email='$txtEmail'
			AND Password='$txtPassword'
			";
	$result=mysqli_query($connection,$check); // Run the Query for Email and Password Checking
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	//print_r($arr);

	if($count < 1) 
	{
		$_SESSION['loginCount']++;
 		echo "<script> window.alert ('Invalid! Login Attempt:".$_SESSION['loginCount']."')</script>";
 		echo" <script>alert ('Your Email or Password Incorrect!') </script>";
	}
	else
	{
		$_SESSION['CustomerID']=$arr['CustomerID'];
		$_SESSION['FirstName']=$arr['FirstName'];
		$_SESSION['LastName']=$arr['LastName'];
		$_SESSION['PhoneNumber']=$arr['PhoneNumber'];
		$_SESSION['Email']=$arr['Email'];
		$_SESSION['Address']=$arr['Address'];
		$_SESSION['ProfileImage']=$arr['ProfileImage'];
		echo "<script>window.alert('Login Success.')</script>";
		echo "<script>window.location='Home.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
</head>
<body>
<form action="Customer_Login.php" method="post">

<a href="Home.php">Back to Home Page <<</a>

<fieldset>
<legend>Login to your account here:</legend>

<table>
<tr>
	<td>E-mail</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="**********" required />
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
		<input type="submit" value="Login" name="btnLogin"/>
		<input type="reset" value="Clear" />
	</td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Note:</td>
	<td>
		If you don't have an account, register an account >><a href="Customer_Register.php">Here</a><<
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php 

include('Footer1.php');

 ?>