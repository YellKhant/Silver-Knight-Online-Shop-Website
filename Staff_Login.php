<?php  
session_start(); //Session Declare
include('connect.php');
include('Header.php');

if (isset($_SESSION['loginCount']))
	{
	if($_SESSION ['loginCount'] >=3)
	{
		echo "<script> window.alert ('Please Try Again in 10 Minutes')</script>";
		echo "<script> window.location = 'LoginTimer.php'</script>";
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

	$check="SELECT * FROM Staff 
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
 		echo" <script>alert ('Your Email or Password Incorrect!!!') </script>";
	}
	else
	{
		$_SESSION['StaffID']=$arr['StaffID'];
		$_SESSION['Name']=$arr['Name'];
		$_SESSION['PhoneNumber']=$arr['PhoneNumber'];
		$_SESSION['Role']=$arr['Role'];
		$_SESSION['Email']=$arr['Email'];
		echo "<script>window.alert('Login Success.')</script>";
		echo "<script>window.location='Staff_Home.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
</head>
<body>
<form action="Staff_Login.php" method="post">

<fieldset>
<legend class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Login your Staff account here:</legend>

<table align="center">
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
		<input type="submit" class="btn subscrib-btnn" value="Login" name="btnLogin"/>
		<input type="reset" class="btn subscrib-btnn" value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php 

include ('Footer.php');

 ?>