<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelDesignLayout extends Model {	
	public function getLayout($route) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route WHERE '" . $this->db->escape($route) . "' LIKE CONCAT(route, '%') AND store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY route ASC LIMIT 1");
		
		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;	
		}
	}
}
?>