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
	
	<title>Example of a Session Check</title>
	
</head>

<body>

	<a href="/examples/some_action_that_requires_a_session_key?session_key=<?= $this->session_security->get_session_key() ?>">Click for a valid session check</a><br />
	<a href="/examples/some_action_that_requires_a_session_key">Click for an <b>invalid</b> session check</a>

</body>
</html>