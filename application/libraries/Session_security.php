<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session_security
{

	protected $_nonces = array();

	function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->library('Session');

		$this->ci->config->load('session_security');

		$this->_nonces = $this->ci->session->userdata('nonces');

		$this->prepare_session_key();
		$this->prepare_nonces_array();
	}

	/*
		Sets a session key, if there is not already one set.
	*/
	protected function prepare_session_key()
	{
		if (!$this->get_session_key())
			$this->set_session_key();
	}

	public function session_check($method, $fatal = false)
	{
		$session_key = false;

		if ($method == 'get')
			$session_key = $this->ci->input->get('session_key');
		elseif ($method == 'post')
			$session_key = $this->ci->input->post('session_key');

		$is_valid = $this->is_valid_session_key($session_key);
		
		if (!$is_valid && $fatal)
		{
			show_error('Invalid session key.', 400);

			// Make sure script execution stops.
			exit;
		}

		return $is_valid;
	}

	public function get_session_key()
	{
		return $this->ci->session->userdata('session_key');
	}

	protected function is_valid_session_key($session_key)
	{
		return $session_key && $session_key === $this->get_session_key();
	}

	protected function set_session_key()
	{
		$session_key = $this->generate_session_key();

		$this->ci->session->set_userdata('session_key', $session_key);
	}

	protected function generate_session_key()
	{
		return 	$this->generate_random_string(
					$this->ci->config->item('session_key_length'),
					$this->ci->config->item('session_key_charset')
				);
	}

	public function check_nonce($name, $method, $fatal = false, $destroy = true)
	{
		$is_valid = false;

		if ($method == 'get')
			$nonce = $this->ci->input->get('nonce');
		elseif ($method == 'post')
			$nonce = $this->ci->input->post('nonce');

		$is_valid = $this->is_valid_nonce($name, $nonce);

		if ($destroy)
			$this->destroy_nonce($name);
		
		if (!$is_valid && $fatal)
		{
			show_error('Invalid nonce.', 400);

			// Make sure script execution stops.
			exit;
		}

		return $is_valid;
	}

	protected function is_valid_nonce($name, $nonce)
	{
		return $nonce && $nonce === $this->get_nonce($name);
	}

	protected function get_nonce($name)
	{
		return !isset($this->_nonces[$name]) ? null : $this->_nonces[$name];
	}

	protected function destroy_nonce($name)
	{
		if (isset($this->_nonces[$name]))
		{
			unset($this->_nonces[$name]);

			$this->save_nonces();
		}
	}

	public function create_nonce($name)
	{
		$nonce = $this->generate_nonce();

		$this->_nonces[$name] = $nonce;

		$this->save_nonces();

		return $nonce;
	}

	protected function prepare_nonces_array()
	{
		if (!$this->_nonces && !is_array($this->_nonces))
		{
			$this->_nonces = array();

			$this->save_nonces();
		}
	}

	protected function save_nonces()
	{
		$this->ci->session->set_userdata('nonces', $this->_nonces);
	}

	protected function generate_nonce()
	{
		return 	$this->generate_random_string(
					$this->ci->config->item('nonce_length'),
					$this->ci->config->item('nonce_charset')
				);
	}

	protected function generate_random_string($length, $character_set)
	{
		$code = '';

		$charset_length = strlen($character_set);

		while (strlen($code) < $length)
			$code .= $this->get_random_character($character_set, $charset_length);

		return $code;
	}

	protected function get_random_character($string, $length)
	{
		return substr($string, mt_rand(0, $length - 1), 1);
	}

}


/* End of file Session_security.php */
/* Location: ./application/libraries/Session_security.php */