<?php 

	$filepath = realpath(dirname(__FILE__));
	
    include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();

	include_once ($filepath.'/inc/loginheader.php');
	include_once ($filepath.'/../classes/Admin.php');

	$adm = new Admin();

?>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$adminData = $adm->getAdminData($_POST);
	}
?>

<div class="main">
	<h1>Admin Login</h1>

	<?php 
		if(isset($adminData)){
			echo $adminData;
		}
	?>
	<div class="adminlogin">

		<form action="" method="post">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" name="adminUser"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="adminPass"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="login" value="Login"/></td>
				</tr>
				
			</table>
		</from>
	</div>
</div>

<?php include 'inc/footer.php'; ?>