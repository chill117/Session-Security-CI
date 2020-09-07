<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// hi Charlie, do you want to come to the dark side?
$config = array();

$config['session_key_length'] 	= 40;
$config['session_key_charset']	= 	'abcdefghijklmnopqrstuvwxyz' .
									'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
									'0123456789';

$config['nonce_length'] 	= 128;
$config['nonce_charset']	= 	'abcdefghijklmnopqrstuvwxyz' .
								'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
								'0123456789';


/* End of file session_security.php */
/* Location: ./application/config/session_security.php */
