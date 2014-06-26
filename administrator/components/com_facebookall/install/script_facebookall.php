<?php
jimport('joomla.filesystem.folder');
jimport('joomla.installer.installer');
/*
 * Script file of facebook all component
 */
class Com_FacebookAllInstallerScript {

  public function postflight($type, $parent) {
    if (!defined('DS')){
      define('DS',DIRECTORY_SEPARATOR);
    }
    $status = new stdClass;
    $status->modules = array();
    $status->plugins = array();
    $db = JFactory::getDBO ();
	$src = $parent->getParent()->getPath('source');
    $manifest = $parent->getParent()->manifest;
	$isUpdate = JFile::exists(JPATH_SITE.DS.'modules'.DS.'mod_facebookall_login'.DS.'mod_facebookall_login.php');
    // create a folder inside your images folder
    JFolder::create(JPATH_ROOT.DS.'images'.DS.'facebookall');

	// Installing modules.
	$modules = $manifest->xpath('modules/module');
	foreach ($modules AS $module) {
      $mod_data = array ();
      foreach ($module->attributes () as $key => $value) {
        $mod_data [$key] = strval ($value);
      }
	  $mod_data ['client'] = JApplicationHelper::getClientInfo ($mod_data ['client'], true);
      if (is_null($mod_data ['client']->name)) $client = 'site';
      $path = $src.DS.$mod_data ['module'];
      $installer = new JInstaller;
      $result = $installer->install($path);
      if ($result) {
        $status->modules[] = array('name'=>$mod_data ['module'],'client'=>$mod_data ['client']->name, 'result'=>$result);
      }
	}
	if (!$isUpdate) {
	  $query = "UPDATE #__modules SET title = '".$mod_data ['title']."', position='".$mod_data ['position']."', ordering='".$mod_data ['order']."', published = 1, access=1 WHERE module='".$mod_data ['module']."'";
      $db->setQuery($query);
      $db->execute();
    }
	$query = 'SELECT `id` FROM `#__modules` WHERE module = ' . $db->Quote ($mod_data ['module']);
    $db->setQuery ($query);
    if (!$db->execute()) {
      $parent->getParent()->abort (JText::_ ('Module') . ' ' . JText::_ ('Install') . ': ' . $db->stderr (true));
      return false;
    }
    $mod_id = $db->loadResult ();
    if ((int) $mod_data ['client']->id == 0) {
      $query = 'REPLACE INTO `#__modules_menu` (moduleid,menuid) values (' . $db->Quote ($mod_id) . ',0)';
      $db->setQuery ($query);
      if (!$db->execute()) {
        // Install failed, roll back changes
        $parent->getParent()->abort (JText::_ ('Module') . ' ' . JText::_ ('Install') . ': ' . $db->stderr (true));
        return false;
      }
	}
  
    // Installing plugins.
	$plugins = $manifest->xpath('plugins/plugin');
    foreach ($plugins AS $plugin) {
      $plg_data = array ();
      foreach ($plugin->attributes() as $key => $value) {
        $plg_data [$key] = strval ($value);
      }
	  $path = $src . DS . 'plg_'.$plg_data['plugin'];
	  $installer = new JInstaller;
      $result = $installer->install($path);
	  if ($result) {
	    $query = "UPDATE #__extensions SET enabled=1 WHERE type='plugin' AND element=".$db->Quote($plg_data ['plugin'])." AND folder=".$db->Quote($plg_data ['group']);
        $db->setQuery($query);
        $db->execute();
	  }      
      // Plugin Installed
      $status->plugins[] = array('name'=>$plg_data ['plugin'], 'group'=>$plg_data ['group']);      
    }
    $this->installationResults($status);
  }
    public function update($type)
    {
        $db = JFactory::getDBO();
		
	}
  private function installationResults($status)
    {
        $rows = 0; 
        if (count($status->modules) AND count($status->plugins)) {?>
  
	<h2><?php echo JText::_ ('Facebook All Installation Completed. Thank you'); ?></h2>
<?php }
    }
 }