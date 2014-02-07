<?php 
//BRING OVER DEFINED VARIABLES
//include_once('config.php');
include_once('../../config.php');

class o_file{
	/* DEFAULT DATABASE SETTINGS from  config.php  */
	var $form_id ;
	var $page ;// used to be "?"
	var $target_path;// used to be "uploads/"
	
	var $file; // used for CSV 
	
	/* */
	function set_form_id($new_form_id){ $this->form_id = $new_form_id; }
	function get_form_id(){  return $this->form_id; }
	function set_page($new_page){ $this->page = $new_page; }
	function get_page(){  return $this->page; }
	function set_target_path($new_target_path){ $this->target_path = $new_target_path; }
	function get_target_path(){  return $this->target_path; }
	
	function set_file($new_file){ $this->file = $new_file; }
	function get_file(){  return $this->file; }
	
	 
	function upload(){
		 //$html = "<form id='".$this->form_id."' enctype='multipart/form-data' action='".$this->form_action."' method='POST'>
		
		
		$html = "<form id='".$this->form_id."' enctype='multipart/form-data' action='".BASE_URL."' method='POST'>
		 <input type='hidden' name='page' value='".$this->page."'  />
		 <input type='hidden' name='function' value='upload' />
		 <input type='hidden' name='MAX_FILE_SIZE' value='100000' />
		<input name='uploadedfile' type='file' /> 
		<input type='submit' value='upload' />
		</form>";
		
		$target_path = $this->target_path;
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		    $html .= "<span style='font-size:9px;'>SUCCESS: ".  basename( $_FILES['uploadedfile']['name'])." uploaded.</span>";
		} else{
		    $html .=  " ";
		}
		/**/
		  
		return $html;
	}
	 function csv_to_table(){
			 	 
		 
			$html = "<table border='1'>";
			$row = 0;
			$handle = fopen(BASE_URL."library/uploads/".$this->file."", "r");
        // $thing=BASE_URL."library/uploads/".$this->file;
        // $html .="<tr><td>".$thing."</td></tr>";
         /*  */
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				if ($row == 0) {
					// this is the first line of the csv file
					// it usually contains titles of columns
					$num = count($data);
						
					$html .= "<thead><tr>";
					$row++;
					for ($c=0; $c < $num; $c++) {
						$html .= "<th style='font-size:9px;'>" . $data[$c] . "</th>";
					}
					$html .= "</tr></thead>";
						
				} else {
					// this handles the rest of the lines of the csv file
					$num = count($data);
					$html .= "<tr>";
					$row++;
					for ($c=0; $c < $num; $c++) {
						$html .= "<td  style='font-size:9px;'>" . $data[$c] . "</td>";
					}
					$html .= "</tr>";
				}
			}
        
         
			fclose($handle);
		
			$html .= "</table>";
		 
 			return $html;
	 	
	 }
	  
 	 
}
/*----------------------------------------------------------------------------------------------------------------------*/
 
	 
 
 



?>


 
