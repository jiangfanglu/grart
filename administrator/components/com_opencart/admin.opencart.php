<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
	// Access check. for joomla 1.6
	if (!JFactory::getUser()->authorise('core.manage', 'com_opencart'))
	{
		return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	}
}
if(!isset($_SESSION["version_checked"])){
	$content="";
	$post_url= "http://www.soft-php.com/index.php";
	$post_data="option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST'];
	if(function_exists("curl_init")){
		$c = curl_init($post_url);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($c, CURLOPT_VERBOSE, 0);
		curl_setopt($c, CURLOPT_HEADER, 0);
		curl_setopt($c, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt($c, CURLOPT_TIMEOUT, 10 );
		if(!ini_get('safe_mode')){
			set_time_limit(3000);
		}
		$content = @curl_exec($c);
	}
	else{
		$content = @file_get_contents("http://www.soft-php.com/index.php?option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST']);
	}
	
	if(trim($content)==""){
		$content = @file_get_contents("http://www.soft-php.com/index.php?option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST']);
	
	}
	$_SESSION["version_checked"]="yes";
}

if(isset($_SESSION["version_checked"])){
	//if click to upgrade link then include upgrade file
    if(isset($_REQUEST["upgn"]) && file_exists("../components/com_opencart/".$_REQUEST["upgn"].".php")){
		require_once("../components/com_opencart/".$_REQUEST["upgn"].".php");
	}//checking upgrade installtion folder uploaded or not.If yes,then upgrade link will be visible
	elseif(file_exists("../components/com_opencart/install/upgrade.php")){
		echo "<div align='left' ><h2>Install folder exists(".$_SERVER['DOCUMENT_ROOT'].str_replace("administrator","", dirname($_SERVER['REQUEST_URI']))."components/com_opencart/install).<br/>Please to upgrade click <a style='color:red'  href='index.php?option=com_opencart&upgn=install/upgrade'>Here</a><br/> Otherwise remove the folder (".$_SERVER['DOCUMENT_ROOT'].str_replace("administrator","", dirname($_SERVER['REQUEST_URI']))."components/com_opencart/install)</h2></div>";

	}
	else{
		//checking upgrade installtion folder uploaded or not.If Not,then include jCart  ouptput using obstart.
		require_once('../components/com_opencart/admin/config.php');

		if(isset($_REQUEST["route"])){
			//start writing jcart code to new extension
			if($_REQUEST["route"]=="extension/module/install" || $_REQUEST["route"]=="extension/shipping/install" || $_REQUEST["route"]=="extension/payment/install" || $_REQUEST["route"]=="extension/total/install" || $_REQUEST["route"]=="extension/feed/install" || ($_REQUEST["route"]=="setting/setting" &&  isset($_REQUEST["config_template"]) && $_REQUEST["config_template"]!="default")){
				//if new extension or template is installed then write jcart code to all previously existing module files
				global $replace_files_array;
				//add new left/right extensions(module) code for joomla module
				if($_REQUEST["route"]=="extension/module/install"){
					$flnm = "catalog/controller/module/".$_REQUEST["extension"].".php";
					$srch='$this->render();';
					$rplc='$this->data[\'template_dir\'] = $this->template;
					global $'.$_REQUEST["extension"].'_mod_data;
					$'.$_REQUEST["extension"].'_mod_data = $this->data;
					$this->render();';
					$existingvar="global";

					$replace_files_array[]=array(
	'file'=>$flnm,'search'=>$srch,'replace'=>$rplc,'existing_var'=>$existingvar);
	
					$flnm = "catalog/controller/module/".$_REQUEST["extension"].".php";
					$srch='$this->response->setOutput($this->render());';
					$rplc='$this->data[\'template_dir\'] = $this->template;
					global  $'.$_REQUEST["extension"].'_mod_data;
					$'.$_REQUEST["extension"].'_mod_data = $this->data;
					$this->response->setOutput($this->render());';
					$existingvar="global  $";

					$replace_files_array[]=array(
	'file'=>$flnm,'search'=>$srch,'replace'=>$rplc,'existing_var'=>$existingvar);
	
				}

				foreach($replace_files_array as $single_file){
					$file_name = '../components/com_opencart/'.$single_file["file"];
					$fh = fopen($file_name, 'r');
					$file_contents = file_get_contents($file_name);
					fclose($fh);
					if(!strstr($file_contents,$single_file["existing_var"]) && file_exists($file_name) && strstr($file_contents,$single_file["search"])){
						$file_contents=str_replace($single_file["search"],$single_file["replace"],$file_contents);
						$fh = fopen($file_name, 'w') or die("can't open file");
						fwrite($fh, $file_contents);
						fclose($fh);
					}
				}
				//if new template is installed then write jcart code to template css file and column_left/right.tpl file
				if($_REQUEST["route"]=="setting/setting" &&  isset($_REQUEST["config_template"]) && $_REQUEST["config_template"]!=""){
					$template_name=$_REQUEST["config_template"];
					global $replace_templates_files_array;
					$css_file_names=array("stylesheet.css","ie7.css","ie6.css");
					$change_template_file="No";
					foreach($css_file_names as $css_f_name){
						$file_name = '../components/com_opencart/catalog/view/theme/'.$template_name.'/stylesheet/'.$css_f_name;
						$file_contents="";
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'r');
							$file_contents = file_get_contents($file_name);
							fclose($fh);
						}
						if(!strstr($file_contents,"content_ext") && file_exists($file_name)){
							foreach($replace_templates_files_array as $key=>$value){
								$file_contents=str_replace($key,$value,$file_contents);
							}
							for($i=500;$i<=1024;$i=$i+1){
								$file_contents=str_replace("width:".$i."px;","width:100%;",$file_contents);
								$file_contents=str_replace("width: ".$i."px;","width:100%;",$file_contents);
							}

							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, $file_contents);
							fclose($fh);
							$change_template_file="Yes";
						}
					}
					if($change_template_file=="Yes"){
						$file_name = '../components/com_opencart/catalog/view/theme/'.$template_name.'/template/common/column_left.tpl';
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, "");
							fclose($fh);
						}

						$file_name = '../components/com_opencart/catalog/view/theme/'.$template_name.'/template/common/column_right.tpl';
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, "");
							fclose($fh);
						}
					}
				}
				//if new extension  is installed then write jcart code to specific module file
				$file_name="";
				if($_REQUEST["route"]=="extension/payment/install"){
					$file_name = '../components/com_opencart/catalog/controller/payment/'.$_REQUEST["extension"].".php";
				}
				elseif($_REQUEST["route"]=="extension/module/install"){
				$file_name = '../components/com_opencart/catalog/controller/module/'.$_REQUEST["extension"].".php";
				}
				elseif($_REQUEST["route"]=="extension/feed/install"){
				$file_name = '../components/com_opencart/catalog/controller/feed/'.$_REQUEST["extension"].".php";
				}
				if($file_name!=""){
					$fh = fopen($file_name, 'r');
					$file_contents = file_get_contents($file_name);
					fclose($fh);

					if(!strstr($file_contents,"com_opencart") && strstr($file_contents,"index.php?route=") && file_exists($file_name)){
						$file_contents=str_replace("index.php?route=","index.php?option=com_opencart&'.ITEM_ID.'route=",$file_contents);
						$fh = fopen($file_name, 'w') or die("can't open file");
						fwrite($fh, $file_contents);
						fclose($fh);
					}

				}
			}//end writing jcart code to new extension
		}//end if isset($_REQUEST["route"])

		//check token
		if(isset($_GET["token"]))
			$_SESSION["token"]=$_GET["token"];
		if(isset($_SESSION["token"])&&!isset($_GET["token"]))
			$_GET["token"]=$_SESSION["token"];


		//echo opencart output in joomla
		global $replace_outputs_array;
		ob_start();


		$pgn=isset($_REQUEST["pgn"])?$_REQUEST["pgn"]:"index";
		if(file_exists("../components/com_opencart/admin/".$pgn.".php"))
			require_once("../components/com_opencart/admin/".$pgn.".php");
		else
			echo "<h1><b>File Not Found</b></h1>";

		$output = ob_get_contents();
		ob_end_clean();

		foreach($replace_outputs_array as $key=>$value){
			$output=str_replace($key,$value,$output);
		}
		global $replace_outputs_check_array;
		foreach($replace_outputs_check_array as $single_array){
			if(!strstr($output,$single_array["existing_var"])){
				$output=str_replace($single_array["search"],$single_array["replace"],$output);
			}
		}
		echo $output;


		//set joomla toolbar sub menu items

		$component="com_opencart";

		//checking permission

		if (isset($session->data['user_id'])) {
			$user_query = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$session->data['user_id'] . "' AND status = '1'");
			$user_group_query =$db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
			$permissions = $user_group_query->row['permission'];

			$permissions =(unserialize($permissions));
			if(in_array("setting/setting",$permissions["modify"])){
				$modify_permission="Yes";
			}
		}

		//if($modify_permission=="Yes"){//show preferences if user has permission to modify setting
			if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
				// Access check. for joomla 1.6
				if (JFactory::getUser()->authorise('core.admin', 'com_opencart'))
				{
					JToolBarHelper::preferences($component, '350', '570');
				}
			}
			else{
				JToolBarHelper::preferences($component, '350', '570');
			}
			
		//}

		if (isset($session->data['user_id'])) {//show submenus in toolbar if user is logged in
			$joomla_toolbar_submenus = array();
			$menu = &JToolBar::getInstance('submenu');
			if(in_array("setting/store",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_setting'),'route'=>'setting/store');

			if(in_array("setting/store",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_category'),'route'=>'catalog/category');

			if(in_array("setting/store",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_product'),'route'=>'catalog/product');

			if(in_array("extension/module",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_module'),'route'=>'extension/module');

			if(in_array("extension/shipping",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_shipping'),'route'=>'extension/shipping');

			if(in_array("extension/payment",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_payment'),'route'=>'extension/payment');

			if(in_array("sale/order",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_order'),'route'=>'sale/order');

			if(in_array("sale/customer",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_customer'),'route'=>'sale/customer');





			foreach($joomla_toolbar_submenus as $sub_menu){
				$menu->appendButton($sub_menu["name"], "index.php?option=".$component."&route=".$sub_menu["route"], true);

			}
		}
		//end joomla toolbar
		if (isset($_REQUEST['tmpl'])) {
			if($_REQUEST['tmpl']=="component")
				exit();
		}
	}//end if(if click to upgrade link then include upgrade file)


}//end if(version checked)
//set joomla toolbar header and sub menu items
JToolBarHelper::title( '<table><tr><td><img src="../components/com_opencart/image/data/shopping_cart.png" /></td><td><big><big><a style="text-decoration:none;" target="_blank" href="http://www.soft-php.com">jCart</a></big></big></td></tr></table>', '' );
?>
