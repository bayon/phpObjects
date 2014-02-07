<?php 
//BRING OVER DEFINED VARIABLES
//include_once('config.php');
include_once('../../config.php');

class o_app{
	/* DEFAULT DATABASE SETTINGS from  config.php  */
	var $app_id ;
	var $app_name ;
	var $current_pk  ;
	var $current_id  ;
	
	/* */
	function set_app_id($new_app_id){ $this->app_id = $new_app_id; }
	function get_app_id(){  return $this->app_id; }
	
	function set_app_name($new_app_name){ $this->app_name = $new_app_name; }
	function get_app_name(){  return $this->app_name; }
	
	function set_current_pk($new_current_pk){ $this->current_pk = $new_current_pk; }
	function get_current_pk(){  return $this->current_pk; }
	
	function set_current_id($new_current_id){ $this->current_id = $new_current_id; }
	function get_current_id(){  return $this->current_id; }
	 
	 
	function something_app_function($query){
		$sql = mysql_query($query );
			if(mysql_error()){
				$result = mysql_error();
				return $result;
			}else{
				$result=1;
			}
			return $result;
	}
	 
	  
 	 
}
/*----------------------------------------------------------------------------------------------------------------------*/
 
	 
 
 



?>


 
