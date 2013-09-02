<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('Session_security');
	}

	public function session_check()
	{
		$this->load->view('examples/session_check');
		exit;
	}

	public function some_action_that_requires_a_session_key()
	{
		// Show the user an error if the correct 'session_key' isn't included in the query string.
		if (!$this->session_security->session_check('get'))
			show_error('Invalid session key', 400);

		echo 'Yay! You provided a valid session key.';
		exit;
	}

	public function nonce()
	{
		if ($this->input->post())
		{
			// Check the randomly-generated, one-time use token.
			// Show the user an error if the nonce wasn't passed or isn't correct.
			if (!$this->session_security->check_nonce('name_of_nonce', 'post'))
				show_error('Invalid nonce', 400);

			echo 'Yay! You provided a valid nonce.';
			exit;
		}

		$this->load->view('examples/nonce');
		exit;
	}
	
}