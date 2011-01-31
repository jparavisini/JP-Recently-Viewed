<?php


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jp_recently_viewed {

  function __construct()
  {
	$this->EE =& get_instance(); 
	
  }

  function setcookie() {
	$entry_id = $this->EE->TMPL->fetch_param('entry_id');

	if (isset($_COOKIE['recently_viewed'])) {
	$currentSession = unserialize($_COOKIE['recently_viewed']);
		if (!in_array($entry_id, $currentSession)) {
		$currentSession[] = $entry_id;
		} else {}
	$currentSession = serialize($currentSession);
	setcookie('recently_viewed', $currentSession, pow(2,31)-1, '/', '');
	} else {
	$recently_viewed[] = $entry_id;
	$currentSession = serialize($recently_viewed);
	setcookie('recently_viewed', $currentSession, pow(2,31)-1, '/', '');
	}

  }

}

/* End of file pi.plugin_name.php */ 
/* Location: ./system/expressionengine/third_party/jp_recently_viewed/pi.jp_recently_viewed.php */