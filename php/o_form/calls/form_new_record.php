<?php 
  //FORM NEW RECORD ----------------------------------------------------
	$o_form_newRecord = new o_form();
	$o_form_newRecord->set_controller('section1/new_record_controller.php');		
	$o_form_newRecord->set_function('new_record');	
	$o_form_newRecord->set_sectionTitle($a_pages[0]);		//CROSS REFERENCE -> navigation.php
	$newRecordButton=$o_form_newRecord->form_newRecord();





if ($_POST['function']=="new_record"){
	  	  
	 $o_db->custom_query("
	 INSERT INTO forte.contacts (
	id ,user_id ,contact_no ,contact_name ,balance ,contact_web ,contact_email ,address ,city ,state ,cntry ,zip ,phone ,monthly ,vendor ,due_date)
VALUES
 	( NULL , '0', '', '', '0.00', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00');");
	  
	  // GET LAST RECORD CREATED ID
 	 $newRecordID = mysql_insert_id();
	 
	$a_recordData = $o_db->custom_query(" SELECT id,contact_name,monthly,vendor FROM forte.contacts WHERE id = ".$newRecordID." "); 
	
 	//LABELS---------------------------------------------------------------------
	$a_labels = array(  'id','contact_name','monthly','vendor' ); 
		 
	$o_form_new_record = new o_form();
	$o_form_new_record->set_a_data($a_recordData);
	$o_form_new_record->set_a_labels($a_labels);
	$o_form_new_record->set_pk($pk_main );
	//FORM TITLE:----------------------------------------------------------
	$o_form_new_record->set_title("Form");
	$o_form_new_record->set_controller('section1/formHandler_controller.php');
	$o_form_new_record->set_function('data_submission_01');
	$a_actions = array( 'INSERT' );
	$o_form_new_record->set_a_actions($a_actions);
	$html_new_record_form = $o_form_new_record->form_newRecord_submit();
	
	 require(BASE_PATH.'/views/header.php');
	include_once(BASE_PATH.'/views/section1/new_record_form_view.php');
	require(BASE_PATH.'/views/footer.php');
	
	
	
	
}



?>