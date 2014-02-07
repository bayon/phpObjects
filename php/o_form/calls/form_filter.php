<?php 
//FORM FILTER CONTACTS -----------------------------
	$o_sortBy_form = new o_form();
	$o_sortBy_form->set_form_id('form_filter_contacts1');		
	$o_sortBy_form->set_controller('section1/section1_controller.php');		
	$o_sortBy_form->set_function('sortBy_submission');	
	$o_sortBy_form->set_sectionTitle($a_pages[0]);		//CROSS REFERENCE -> navigation.php
	$development_info .="<br>VARIABLE: ".$a_pages[0];
	$filter = $o_sortBy_form->form_sortByPost();



if ($_POST['function']=="sortBy_submission"){
	 	$table="forte.contacts";
	  	$a_fields = array( 'id','contact_name','monthly','vendor' );
	  	$keyword = $_POST[sortKey] ;
	  	$sql = $o_db->search_AllFields($table,$a_fields,$keyword);
	 	$a_data = $o_db->custom_query($sql);   
	 }else{
	 	$table="forte.contacts";
	  	$a_fields = array( 'id','contact_name','monthly','vendor' );
	 	$a_data = $o_db->custom_query(" SELECT id,contact_name,monthly,vendor FROM forte.contacts  "); 
	 }
?>