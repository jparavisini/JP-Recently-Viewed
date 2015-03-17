<?php

$plugin_info = array(
	'pi_name'			=> 'JP Recently Viewed',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Joe Paravisini',
	'pi_author_url'		=> 'https://devot-ee.com/add-ons/jp-recently-viewed',
	'pi_description'	=> 'Create the recently viewed cookie',
	'pi_usage'			=> Jp_recently_viewed::usage()
);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jp_recently_viewed
{

	function Jp_recently_viewed()
	{
		$this->EE =& get_instance(); 
	}

	function setcookie()
	{
		$entry_id = $this->EE->TMPL->fetch_param('entry_id');
		
		if (isset($_COOKIE['recently_viewed']))
		{
			$currentSession = unserialize($_COOKIE['recently_viewed']);
			if (!in_array($entry_id, $currentSession))
			{
				$currentSession[] = $entry_id;
			}
			$currentSession = serialize($currentSession);
			setcookie('recently_viewed', $currentSession, pow(2,31)-1, '/', '');
		}
		else
		{
			$recently_viewed[] = $entry_id;
			$currentSession = serialize($recently_viewed);
			setcookie('recently_viewed', $currentSession, pow(2,31)-1, '/', '');
		}
	}
	
	function usage()
	{
		ob_start(); 
	?>
		Set the cookie with the following tag:
		{exp:jp_recently_viewed:setcookie entry_id="{entry_id}"}

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

}

/* End of file pi.plugin_name.php */ 
/* Location: ./system/expressionengine/third_party/jp_recently_viewed/pi.jp_recently_viewed.php */
