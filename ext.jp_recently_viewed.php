<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jp_recently_viewed_ext { 
	
	var $name		= 'JP Recently Viewed';
	var $version 		= '1.0';
	var $description	= 'Allows you to filter exp:channel:entries for entries recenty viewed by the user.';
	var $settings_exist	= 'n';
	var $docs_url		= 'http://www.joeparavisini.com';

	var $settings        = array();

	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	function Jp_recently_viewed_ext($settings='')
	{
		$this->EE =& get_instance();
		
		$this->settings = $settings;
	}
	
	
	
	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://codeigniter.com/user_guide/database/index.html for
	 * more information on the db class.
	 *
	 * @return void
	 */
	function activate_extension()
	{
		$this->settings = array();
		
		
		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'recently_viewed',
			'hook'		=> 'channel_entries_query_result',
			'settings'	=> serialize($this->settings),
			'priority'	=> 10,
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);
		
		$this->EE->db->insert('extensions', $data);
	}
	
	
	
	/**
	 * Read the recently viewed ids from the session
	 * 
	 * @param 	array 	array from the preg_match
	 * @return 	string	Newly truncated Link.
	 */
	function recently_viewed($obj, $query_result) {
	if (array_key_exists('recently_viewed',$_COOKIE)) {
	$recent = unserialize($_COOKIE['recently_viewed']);
	} else {
	$recent = array();
	}

	// Check for our parameter from the exp:channel:entries tag
	$recently_viewed = $this->EE->TMPL->fetch_param('recently_viewed', '');
	// if parameter found
	if ($recently_viewed == 'yes' || $recently_viewed == 'y') {
	$recent_entries = array();
		foreach ($query_result as $entry) 
		{
			if (in_array($entry['entry_id'], $recent)) {
			$recent_entries[] = $entry;
			}
		}
		return $recent_entries;
	} else {

	return $query_result;
		}

	}

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}

		$data = array();
		$data['version'] = $this->version;

		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->update('exp_extensions', $data);
	}
	
	
	
	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}





}
// END CLASS

/* End of file ext.jp_recently_viewed.php */