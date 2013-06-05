<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class Customer {
	private $customer_id;
	private $firstname;
	private $lastname;
	private $email;
	private $telephone;
	private $fax;
	private $newsletter;
	private $customer_group_id;
	private $address_id;
	
  	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
		//####################START JOOMLA LOGIN Integration######################
		global $joomla_db;		
		jimport("joomla.user.helper");		
		if(!isset($default_customer_group_id))
		$default_customer_group_id = $this->config->get('config_customer_group_id');
		$joomla_user = JFactory::getUser();
		if($joomla_user->get('id')>0 && !isset($this->session->data['customer_id']))
		{
			//If Joomla user logged in but jCart user not logged in then make jCart user logged in
			$JConfig = new JConfig();
			
			//Get Joomla logged user information from joomla users table
			$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where id= '".$joomla_user->get('id')."'");
			if($result->num_rows){
				$joomla_login_ok="yes";
				$joomla_user_id=$result->row["id"];
				$joomla_user_name=$result->row["username"];
				$joomla_password=isset($_SESSION['jcart_password'])?$_SESSION['jcart_password']:$result->row["password"];
				$joomla_user_email=$result->row["email"];
				$reg_date=$result->row["registerDate"];
				$joomla_name=$result->row["name"];
				$status="1";
				
				$name=explode(" ",$joomla_name);
				$fname=$name[0];
				$lname="";
				if(count($name)>1){
					for($i=1;$i<count($name);$i=$i+1){
						if($i==1)
							$lname=$name[$i];
						else{
								$lname=$lname." ".$name[$i];
							}
					}
				}
			}
			//Check existing jCart user with joomla logged user email			
			// check whether jCart user exists with joomla user email id.
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE email = '" . $joomla_user_email . "'");
			if ($customer_query->num_rows) {
				//If jcart user is existed with joomla logged email id,then update jcart users information including password
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET password = '" . $this->db->escape($joomla_password) . "',firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "',status = '".$status."',approved='".$status."' WHERE email = '" . $this->db->escape($joomla_user_email) . "'");	
			}
			else{
				//If jcart user not existed with joomla user id or email id,then insert new jcart user same as joomla logged user.
				$data['telephone']="";
				$data['fax']="";
				$data['newsletter']="";
				$data['company']="";
				$data['address_1']="";
				$data['address_2']="";
				$data['country_id']="";
				$data['zone_id']="";
				$data['postcode']="";
				$data['city']="";
				
				//insert data to jcart users table
				$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "', email = '" . $this->db->escape($joomla_user_email) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', password = '" . $this->db->escape($joomla_password) . "', newsletter = '" . $this->db->escape($data['newsletter']) . "', customer_group_id = '".$default_customer_group_id."', status = '".$status."',approved='".$status."',date_added = NOW()");
				$customer_id = $this->db->getLastId();
				// integrating with user profile plugin
				//run this script for only joomla >=1.6		
				if(version_compare(JVERSION, '1.6.0', '<' ) != 1 && isset($joomla_user_id)){			
					//check whether user_profiles table exists
					$user_profile_result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."user_profiles'");
					if ($user_profile_result->num_rows){
						$profiles_entry_array[]=array("key"=>"address1","value"=>"address_1","ordering"=>"1");
						$profiles_entry_array[]=array("key"=>"address2","value"=>"address_2","ordering"=>"2");
						$profiles_entry_array[]=array("key"=>"city","value"=>"city","ordering"=>"3");
						$profiles_entry_array[]=array("key"=>"postal_code","value"=>"postcode","ordering"=>"6");
						$profiles_entry_array[]=array("key"=>"phone","value"=>"telephone","ordering"=>"7");
						$profiles_entry_array[]=array("key"=>"region","value"=>"zone_id","ordering"=>"4");
						$profiles_entry_array[]=array("key"=>"country","value"=>"country_id","ordering"=>"5");						
						foreach($profiles_entry_array as $single_entry){
							$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");
							if($result->num_rows){
								$data[$single_entry["value"]]=$result->row["profile_value"];
								if($single_entry["key"]=="country"){
									$country=$result->row["profile_value"];
									$result = $joomla_db->query("SELECT country_id FROM ".DB_PREFIX."country where name = '".$country."'");
									if($result->num_rows){
										$data["country_id"]=$result->row["country_id"];
									}
								}
								elseif($single_entry["key"]=="region"){
									$region=$result->row["profile_value"];
									$result = $joomla_db->query("SELECT zone_id FROM ".DB_PREFIX."zone where name = '".$region."'");
									if($result->num_rows){
										$data['zone_id']=$result->row["zone_id"];
									}
								}							
							}//end result user profile entry							
						}//end foreach
					}//end if $user_profile_result(table)
				}//end joomla version check
				// end integrating with user profile plugin
				//input an address for this customer in address table
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "'");
				
				$address_id = $this->db->getLastId();
				//update the address id with customer id
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");	
			}
			
			$this->login($joomla_user_email,$joomla_password);
		}
		//################################END JOOMLA LOGIN Integration###############################################
				
				
		if (isset($this->session->data['customer_id'])) { 
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND status = '1'");
			
			if ($customer_query->num_rows) {
				$this->customer_id = $customer_query->row['customer_id'];
				$this->firstname = $customer_query->row['firstname'];
				$this->lastname = $customer_query->row['lastname'];
				$this->email = $customer_query->row['email'];
				$this->telephone = $customer_query->row['telephone'];
				$this->fax = $customer_query->row['fax'];
				$this->newsletter = $customer_query->row['newsletter'];
				$this->customer_group_id = $customer_query->row['customer_group_id'];
				$this->address_id = $customer_query->row['address_id'];
							
      			$this->db->query("UPDATE " . DB_PREFIX . "customer SET cart = '" . $this->db->escape(isset($this->session->data['cart']) ? serialize($this->session->data['cart']) : '') . "', wishlist = '" . $this->db->escape(isset($this->session->data['wishlist']) ? serialize($this->session->data['wishlist']) : '') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");
				
				if (!$query->num_rows) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int)$this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
				}
			} else {
				$this->logout();
			}
  		}
	}
		
  	public function login($email, $password, $override = false) {
		//################################Start JOOMLA LOGIN Integration#############################################
		global $joomla_db;
		jimport("joomla.user.helper");
		
		$joomla_user = JFactory::getUser();
		$encrypted_password="";
		$joomla_user_name="";
		if(!isset($default_customer_group_id))
		$default_customer_group_id = $this->config->get('config_customer_group_id');
		//Check whether joomla user is logged in or not
		if(!$joomla_user->get('id')){
			//If joomla user not logged in then check the inputed password and email id with joomla users table i.e. 
			// start joomla login ok checking.....
			$JConfig = new JConfig();
			$joomla_login_ok="";
			$encrypted_password="";
			$crypt="";
			$salt="";
			$joomla_user_name="";
			$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '". $joomla_db->escape(strtolower($email)) ."'");
			if($result->num_rows){
				$joomla_user_name=$result->row["username"];
				$pass_salt=$result->row["password"];
				$pass_salt=explode(":",$pass_salt);
				$salt=$pass_salt[1];
				if(class_exists("JUserHelper")){
					$crypt=JUserHelper::getCryptedPassword($password,$salt);
					$encrypted_password=$crypt.":".$salt;
				}
			}
			
			$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '". $joomla_db->escape(strtolower($email)) ."' AND password='".$encrypted_password."'");
			if($result->num_rows){
				//If joomla login ok then get joomla user information from joomla users table
				$joomla_login_ok="yes";
				$joomla_user_id=$result->row["id"];
				$joomla_user_name=$result->row["username"];
				$joomla_user_email=$result->row["email"];
				$joomla_name=$result->row["name"];
				$name=explode(" ",$joomla_name);
				$status=$result->row["block"]=="1"?"0":"1";
				$fname=$name[0];
				$lname="";
				if(count($name)>1){
					for($i=1;$i<=count($name);$i=$i+1){
						if($i==1)
							$lname=$name[$i];
						else
							$lname=$lname." ".$name[$i];
					}
				}
			}
			//End joomla login ok checking..........
			
			//Start jCart login ok checking..........
			if($encrypted_password!="")
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."' OR password='".$encrypted_password."') ");
			else
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."')");			
			
			$opencart_login_ok="";	
			$data=array();			
			if ($customer_query->num_rows) {
				//if jcart login ok,then get jcart user information from jcart users table
				$opencart_login_ok="yes";
				$block="0";
				if($customer_query->row["status"]=="1" && $customer_query->row["approved"]=="1")
					$block="0";
				else
					$block="1";
					
				$data["password"]=$password;
				$data['email']=$email;
				$data['firstname']=$customer_query->row["firstname"];
				$data['lastname']=$customer_query->row["lastname"];		
				
											
			}
			
			//if joomla login ok then update existing jcart user's information including password  with joomla user id
			if($joomla_login_ok=="yes" && $opencart_login_ok!="yes" && $joomla_user_id>0 && $encrypted_password!="" && $joomla_user_email!=""){
			
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET password = '" . $this->db->escape(md5($password)) . "',firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "' WHERE email = '" . $joomla_user_email . "'");	
			}
			
			//Start jCart login ok checking..........
			if($opencart_login_ok!="yes"){
				if($encrypted_password!="")
					$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."' OR password='".$encrypted_password."') ");
				else
					$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."')");
		
				
				
				
				$data=array();			
				if ($customer_query->num_rows) {
					//if jcart login ok,then get jcart user information from jcart users table
					$opencart_login_ok="yes";
					$block="0";
					if($customer_query->row["status"]=="1" && $customer_query->row["approved"]=="1")
						$block="0";
					else
						$block="1";
					$data["password"]=$password;
					$data['email']=$email;
					$data['firstname']=$customer_query->row["firstname"];
					$data['lastname']=$customer_query->row["lastname"];													
				}
			}	
			//End jCart login ok checking..........
			$opencart_email="";
			if($opencart_login_ok!="yes"){
				$opencart_login_ok="no";
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "'");
				if ($customer_query->num_rows) {
					$opencart_email=$email;					
				}
			}
			
			
			
			//if joomla login ok but jcart login not ok and  email id same in both joomla and jcart then update jcart user's information  including password
			
			if($joomla_login_ok=="yes" && $opencart_login_ok!="yes" && $opencart_email==$email && $joomla_user_id>0)
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET password ='" . $this->db->escape(md5($password)) . "',firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "'  WHERE email = '" .$opencart_email. "'");
			elseif($joomla_login_ok=="yes" && $opencart_login_ok!="yes"){
				// else if joomla login ok but jcart login not ok then input new jcart user same as joomla user
				$data['telephone']="";
				$data['fax']="";
				$data['newsletter']="";
				$data['company']="";
				$data['address_1']="";
				$data['address_2']="";
				$data['country_id']="";
				$data['zone_id']="";
				$data['postcode']="";
				$data['city']="";
				//input data to jcart customers table 
				$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "', email = '" . $this->db->escape($email) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', password = '" . $this->db->escape(md5($password)) . "', newsletter = '" . $this->db->escape($data['newsletter']) . "', customer_group_id = '".$default_customer_group_id."', status = '".$status."',approved='".$status."', date_added = NOW()");
				$customer_id = $this->db->getLastId();
				// integrating with user profile plugin
				//run this script for only joomla >=1.6		
				if(version_compare(JVERSION, '1.6.0', '<' ) != 1 && isset($joomla_user_id)){			
					//check whether user_profiles table exists
					$user_profile_result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."user_profiles'");
					if ($user_profile_result->num_rows){
						$profiles_entry_array[]=array("key"=>"address1","value"=>"address_1","ordering"=>"1");
						$profiles_entry_array[]=array("key"=>"address2","value"=>"address_2","ordering"=>"2");
						$profiles_entry_array[]=array("key"=>"city","value"=>"city","ordering"=>"3");
						$profiles_entry_array[]=array("key"=>"postal_code","value"=>"postcode","ordering"=>"6");
						$profiles_entry_array[]=array("key"=>"phone","value"=>"telephone","ordering"=>"7");
						$profiles_entry_array[]=array("key"=>"region","value"=>"zone_id","ordering"=>"4");
						$profiles_entry_array[]=array("key"=>"country","value"=>"country_id","ordering"=>"5");						
						foreach($profiles_entry_array as $single_entry){
							$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");
							if($result->num_rows){
								$data[$single_entry["value"]]=$result->row["profile_value"];
								if($single_entry["key"]=="country"){
									$country=$result->row["profile_value"];
									$result = $joomla_db->query("SELECT country_id FROM ".DB_PREFIX."country where name = '".$country."'");
									if($result->num_rows){
										$data["country_id"]=$result->row["country_id"];
									}
								}
								elseif($single_entry["key"]=="region"){
									$region=$result->row["profile_value"];
									$result = $joomla_db->query("SELECT zone_id FROM ".DB_PREFIX."zone where name = '".$region."'");
									if($result->num_rows){
										$data['zone_id']=$result->row["zone_id"];
									}
								}							
							}//end result user profile entry							
						}//end foreach
					}//end if $user_profile_result(table)
				}//end joomla version check
				// end integrating with user profile plugin
				//input an address for this customer in address table
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($fname) . "', lastname = '" . $this->db->escape($lname) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "'");
				
				$address_id = $this->db->getLastId();
				//assign address id to jcart customer/user table
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
			}//if joomla login not ok but jcart login ok then create new joomla users
			elseif($joomla_login_ok!="yes" && $opencart_login_ok=="yes"){
				//Start Create new joomla user
				$JConfig = new JConfig();
				$username_exists="";
				$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '".$joomla_db->escape($data['email'])."'");
				if($result->num_rows){
					$username_exists=$result->row["id"];
					$joomla_user_email=$result->row["email"];
				}
				//if joomla user not already existed then insert data to joomla user table
				if($username_exists==""){
					$core_result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."core_acl_aro_groups'");
					if (!$core_result->num_rows)
						$new_joomla_version="Yes";
					if($new_joomla_version=="Yes"){ //if joomla version is greater than>=1.6
						if(class_exists("JUserHelper")){
							$salt=JUserHelper::genRandomPassword(32);
							$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
							$encrypted_password=$crypt.":".$salt;
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = 'Registered', password = '" . $encrypted_password . "', sendEmail = '1',block='".$block."', registerDate = NOW()");
						$joomla_user_id=$joomla_db->getLastId();
						
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "user_usergroup_map SET group_id = '2',user_id = '" . $joomla_user_id . "'");
						
						
					}
					else{
						$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."core_acl_aro_groups where name ='Registered'");
						
						$user_group_id=$result->row["id"];
						if($user_group_id=="")
							$user_group_id=18;
						if(class_exists("JUserHelper")){
							$salt=JUserHelper::genRandomPassword(32);
							$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
							$encrypted_password=$crypt.":".$salt;
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = 'Registered', password = '" . $encrypted_password . "', gid = '" . (int)$user_group_id . "', sendEmail = '1', registerDate = NOW()");
						$joomla_user_id=$joomla_db->getLastId();
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
						$joomla_acl_aro_id=$joomla_db->getLastId();
						if(!$joomla_acl_aro_id){
							$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
							$joomla_acl_aro_id=$joomla_db->getLastId();
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
						$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."core_acl_groups_aro_map where group_id='".$user_group_id."' and aro_id = '".$joomla_acl_aro_id."'");
						if($result->num_rows){
							//do nothing
						}
						else{
							$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
						}
					}
					//Community Builder
					$result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."comprofiler'");
					if($result->num_rows){
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "comprofiler SET id = '".$joomla_user_id."',user_id = '".$joomla_user_id."'");
					}				
					
				}
				
				//##############################################################
				//If user already exists in joomla table then upadate users information including password in joomla user table
				//##############################################################
				if($username_exists!="" && $joomla_login_ok!="yes" && $opencart_login_ok=="yes"){
					$JConfig = new JConfig();
					$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "' WHERE email='".$joomla_db->escape($email)."'");
					
					if(class_exists("JUserHelper")){
						$salt=JUserHelper::genRandomPassword(32);
						$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
						$encrypted_password=$crypt.":".$salt;
					}
					$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE email='".$joomla_db->escape($email)."'");
					
					
				
				}
				//#######################End##################################
				//End Create new joomla user
			}
		}
		if($encrypted_password!="")
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."' OR password='".$encrypted_password."') AND status = '1'  AND approved = '1'");
		else
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = '" . $this->db->escape(md5($password)) . "' OR password ='".$this->db->escape($password)."') AND status = '1'  AND approved = '1'");
		
		//#####################End JOOMLA LOGIN Integration###################
		
		if ($override) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer where LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND status = '1'");
		} elseif(!$customer_query->num_rows && $encrypted_password=="") {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}
		
		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];	
		    
			if ($customer_query->row['cart'] && is_string($customer_query->row['cart'])) {
				$cart = unserialize($customer_query->row['cart']);
				
				foreach ($cart as $key => $value) {
					if (is_array($this->session->data['cart']) && !array_key_exists($key, $this->session->data['cart'])) {
						$this->session->data['cart'][$key] = $value;
					} else {
						$this->session->data['cart'][$key] += $value;
					}
				}			
			}

			if ($customer_query->row['wishlist'] && is_string($customer_query->row['wishlist'])) {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}
								
				$wishlist = unserialize($customer_query->row['wishlist']);
			
				foreach ($wishlist as $product_id) {
					if (!in_array($product_id, $this->session->data['wishlist'])) {
						$this->session->data['wishlist'][] = $product_id;
					}
				}			
			}
									
			$this->customer_id = $customer_query->row['customer_id'];
			$this->firstname = $customer_query->row['firstname'];
			$this->lastname = $customer_query->row['lastname'];
			$this->email = $customer_query->row['email'];
			$this->telephone = $customer_query->row['telephone'];
			$this->fax = $customer_query->row['fax'];
			$this->newsletter = $customer_query->row['newsletter'];
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->address_id = $customer_query->row['address_id'];
          	
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			if (!$override) {
			//################################Start JOOMLA LOGIN##############################		
			$joomla_user = JFactory::getUser();
			if(!$joomla_user->get('id')){
				$mainframe = JFactory::getApplication();
				$options=array();
				$options["remember"]=$remember_me;
				$options["return"]='';
				$credentials=array();
				if($joomla_user_name!="")
					$credentials['username']=$this->db->escape($joomla_user_name);
				else
					$credentials['username']=$this->db->escape($email);
				$credentials['password']=$this->db->escape($password);
				$mainframe->login($credentials,$options);	
			}
      			//###############################End JOOMLA LOGIN################################
			}
	  		return true;
    	} else {
      		return false;
    	}
  	}
  	
	public function logout() {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET cart = '" . $this->db->escape(isset($this->session->data['cart']) ? serialize($this->session->data['cart']) : '') . "', wishlist = '" . $this->db->escape(isset($this->session->data['wishlist']) ? serialize($this->session->data['wishlist']) : '') . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
		
		unset($this->session->data['customer_id']);

		$this->customer_id = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->email = '';
		$this->telephone = '';
		$this->fax = '';
		$this->newsletter = '';
		$this->customer_group_id = '';
		$this->address_id = '';
		
		if (!isset($this->request->get['token'])) {
			//################################START JOOMLA LOGIN Integration############################
			$mainframe = JFactory::getApplication();
			$mainframe->logout();
			//################################End JOOMLA LOGIN Integration##############################			
			session_destroy();
		}
  	}
  
  	public function isLogged() {
    	return $this->customer_id;
  	}

  	public function getId() {
    	return $this->customer_id;
  	}
      
  	public function getFirstName() {
		return $this->firstname;
  	}
  
  	public function getLastName() {
		return $this->lastname;
  	}
  
  	public function getEmail() {
		return $this->email;
  	}
  
  	public function getTelephone() {
		return $this->telephone;
  	}
  
  	public function getFax() {
		return $this->fax;
  	}
	
  	public function getNewsletter() {
		return $this->newsletter;	
  	}

  	public function getCustomerGroupId() {
		return $this->customer_group_id;	
  	}
	
  	public function getAddressId() {
		return $this->address_id;	
  	}
	
  	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$this->customer_id . "'");
	
		return $query->row['total'];
  	}	
		
  	public function getRewardPoints() {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$this->customer_id . "'");
	
		return $query->row['total'];	
  	}	
}
?>