<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	
	<title>Example Form Submission Using a Nonce</title>
	
</head>

<body>

	<form action="/examples/nonce" method="post">

		<h1>Example Form Submission Using a Nonce</h1>
		<p>Submit the form to see if it works!</p>

		<input type="text" name="name" value="" />

		<input type="submit" value="Submit" />

		<input type="hidden" name="nonce" value="<?= $this->session_security->create_nonce('name_of_nonce') ?>" />

	</form>

</body>
</html>