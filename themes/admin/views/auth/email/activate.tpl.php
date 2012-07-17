<html>
<body>
	<h1>Account Activation</h1>
	
	<p>Hello <?php echo $identity;?>.</p>
	
	<p>Thank you for registering with us.</p>
	
	<p>To use the site you must activate your account.</p>
	
	<p><?php echo anchor('auth/activate/'. $id .'/'. $activation, 'Activate your account');?></p>
	
	<p>Thank You!</p>
</body>
</html>