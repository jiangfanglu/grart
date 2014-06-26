<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}
		
		$this->load->model('account/customer_group');
		
		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
		
		// Properly format customer details with Title case
		if (function_exists('mb_convert_case')) {
			$data['company'] 	= trim($data['company']);
			$data['firstname'] 	= mb_convert_case(trim($data['firstname']), MB_CASE_TITLE, 'UTF-8');
			$data['lastname'] 	= mb_convert_case(trim($data['lastname']), MB_CASE_TITLE, 'UTF-8');
			$data['address_1'] 	= mb_convert_case(trim($data['address_1']), MB_CASE_TITLE,'UTF-8');
			$data['address_2'] 	= mb_convert_case(trim($data['address_2']), MB_CASE_TITLE,'UTF-8');
			$data['city'] 		= mb_convert_case(trim($data['city']), MB_CASE_TITLE, 'UTF-8');
			$data['postcode'] 	= mb_convert_case(trim($data['postcode']), MB_CASE_TITLE, 'UTF-8');
		}
		$customer_group_info_approval=$customer_group_info['approval'];
      	//#############################Start JOOMLA LOGIN Integration################################
		global $joomla_db;
		jimport("joomla.user.helper");
		$JConfig = new JConfig();
		$username_exists="";
		$joomla_user_name="";
		$joomla_user_id="";
		$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '".$joomla_db->escape($data['email'])."'");
		if($result->num_rows){
			$username_exists=$result->row["id"];
			$joomla_user_name=$result->row["username"];
			$joomla_user_email=$result->row["email"];
		}
		// if user already not exists in joomla table,then insert new entry to joomla users table
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
				$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = 'Registered', password = '" . $encrypted_password . "', sendEmail = '1', registerDate = NOW(), params=''");
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
		
		
		//block user in joomla table if it needs aproval
		if ($customer_group_info_approval) {
			$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET block = '1' WHERE email='".$joomla_db->escape($data['email'])."'");		
		}					
		//#############################End JOOMLA LOGIN Integration#######################
		//################START joomla user profile integration#############################	
		//find joomla_user_id if not $joomla_user_id variable already declared
		global $joomla_db;
		
		if(!isset($data['email']))
		$data['email']=$this->customer->getEmail();
		
		$JConfig = new JConfig();
		if(!isset($joomla_user_id) && isset($data['email'])){				
			$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '".$joomla_db->escape($data['email'])."'");
			if($result->num_rows){
				$joomla_user_id=$result->row["id"];					
			}
		}
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
				//find zone name
				if(isset($data["zone_id"])){
					$result = $joomla_db->query("SELECT name FROM ".DB_PREFIX."zone where zone_id = '".(int)$data["zone_id"]."'");
					if($result->num_rows){
						$data["region"]=$result->row["name"];
						$profiles_entry_array[]=array("key"=>"region","value"=>"region","ordering"=>"4");				
					}
				}
				//find country name
				if(isset($data["country_id"])){
					$result = $joomla_db->query("SELECT name FROM ".DB_PREFIX."country where country_id = '".(int)$data["country_id"]."'");
					if($result->num_rows){
						$data["country"]=$result->row["name"];
						$profiles_entry_array[]=array("key"=>"country","value"=>"country","ordering"=>"5");				
					}
				}
				
				
				foreach($profiles_entry_array as $single_entry){
					if(isset($data[$single_entry["value"]]) && $data[$single_entry["value"]]!="" ){
						$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");
						if(!$result->num_rows){
							$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "user_profiles SET user_id = '".$joomla_user_id."',profile_key = 'profile.".$single_entry["key"]."',profile_value='".$data[$single_entry["value"]]."',ordering='".(int)$single_entry["ordering"]."'");
						}
						else{
							$joomla_db->query("UPDATE  " . $JConfig->dbprefix . "user_profiles SET profile_value='".$data[$single_entry["value"]]."' WHERE  user_id = '".$joomla_user_id."' and profile_key = 'profile.".$single_entry["key"]."'");
						}
					}//end isset
				}//end foreach
			}//end if $user_profile_result(table)
                        
		}//end joomla version check
        $this -> setUserArtist($joomla_user_id);
		//################END joomla user profile integration#############################	
      	$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', customer_group_id = '" . (int)$customer_group_id . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");
      	
		$customer_id = $this->db->getLastId();
			
      	$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', company_id = '" . $this->db->escape($data['company_id']) . "', tax_id = '" . $this->db->escape($data['tax_id']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "'");
		
		$address_id = $this->db->getLastId();

      	$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
		
		$this->language->load('mail/customer');
		
		$subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));
		
		$message = sprintf($this->language->get('text_welcome'), $this->config->get('config_name')) . "\n\n";
		
		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}
		
		$message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= $this->config->get('config_name');
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');				
		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		
		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$mail->setTo($this->config->get('config_email'));
			$mail->send();
			
			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_alert_emails'));
			
			foreach ($emails as $email) {
				if (strlen($email) > 0 && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}
                
	}
        
        public function setUserArtist($user_id){
            $db = JFactory::getDbo();
            $query = $db ->getQuery(true);
            $query->insert('#__artist'); 
            $query->set('`user_id`='.(string)$user_id);
            try{
                $db ->setQuery($query);
            } catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
        }
	
	public function editCustomer($data) {
		$data['firstname'] = ucwords(strtolower(trim($data['firstname'])));
		$data['lastname'] = ucwords(strtolower(trim($data['lastname'])));
						//################################START JOOMLA LOGIN Integration###############################################
		global $joomla_db;
		$result = $this->db->query("SELECT email FROM ".DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		
		if($result->num_rows){
			$customer_email=$result->row["email"];	
		}
		if(	$customer_email!=""){		
			$JConfig = new JConfig();
			$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',email = '" . $joomla_db->escape($data['email']) . "' WHERE email='".$joomla_db->escape($customer_email)."'");
			$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET username = '" . $joomla_db->escape($data['email']) . "' WHERE username='".$joomla_db->escape($customer_email)."'");
			
		}
		//################################End JOOMLA LOGIN Integration###############################################
		
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		
		
		
		
	}

	public function editPassword($email, $password) {
		//################################START JOOMLA LOGIN Integration###############################################
		jimport("joomla.user.helper");
		$JConfig = new JConfig();
		if(class_exists("JUserHelper")){
			$salt=JUserHelper::genRandomPassword(32);
			$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($password),$salt);
			$encrypted_password=$crypt.":".$salt;
		}
		$joomla_db->query("UPDATE " . $JConfig->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE email='".$joomla_db->escape($email)."'");
		//################################End JOOMLA LOGIN Integration###############################################
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE email = '" . $this->db->escape($email) . "'");
	}

	public function editNewsletter($newsletter) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	}
					
	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		
		return $query->row;
	}
	
	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE email = '" . $this->db->escape($email) . "'");
		
		return $query->row;
	}
		
	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");
		
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");
		
		return $query->row;
	}
		
	public function getCustomers($data = array()) {
		$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name, cg.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id) ";

		$implode = array();
		
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$implode[] = "LCASE(CONCAT(c.firstname, ' ', c.lastname)) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}
		
		if (isset($data['filter_email']) && !is_null($data['filter_email'])) {
			$implode[] = "c.email = '" . $this->db->escape($data['filter_email']) . "'";
		}
		
		if (isset($data['filter_customer_group_id']) && !is_null($data['filter_customer_group_id'])) {
			$implode[] = "cg.customer_group_id = '" . $this->db->escape($data['filter_customer_group_id']) . "'";
		}	
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}	
		
		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
		}	
			
		if (isset($data['filter_ip']) && !is_null($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}	
				
		if (isset($data['filter_date_added']) && !is_null($data['filter_date_added'])) {
			$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
		
		$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.ip',
			'c.date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);
		
		return $query->rows;	
	}
		
	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "'");
		
		return $query->row['total'];
	}
	
	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");
		
		return $query->rows;
	}	
	
	public function isBlacklisted($ip) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip_blacklist` WHERE ip = '" . $this->db->escape($ip) . "'");
		
		return $query->num_rows;
	}	
}
?>