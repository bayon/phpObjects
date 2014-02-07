<?php 
//BRING OVER DEFINED VARIABLES
//include_once('config.php');
include_once('../../config.php');

class o_db{
	/* DEFAULT DATABASE SETTINGS from  config.php  */
	var $host = HOST;
	var $username = USERNAME;
	var $password = PASSWORD;
	
	function set_host($new_host){ $this->host = $new_host; }
	function get_host(){  return $this->host; }
	function set_username($new_username){ $this->username = $new_username; }
	function get_username(){  return $this->username; }
	function set_password($new_password){ $this->password = $new_password; }
	function get_password(){  return $this->password; }
	function set_db($new_db){ $this->db = $new_db; }
	function get_db(){  return $this->db; }
	function set_table($new_table){ $this->table = $new_table; }
	function get_table(){  return $this->table; }
	function set_pk($new_pk){ $this->pk = $new_pk; }
	function get_pk(){  return $this->pk; }
	function db_connect()
	{
		if(mysql_connect($this->host,$this->username,$this->password)){$result=1;}else{$result= 0;};		 
		return $result;
	}
	function basic_query($query){
		$sql = mysql_query($query );
			if(mysql_error()){
				$result = mysql_error();
				return $result;
			}else{
				$result=1;
			}
			return $result;
	}
	function arrayValuesToList($array){
		//SINGLE QUOTES
			$j=0;
			 $numRows = count($array);
			 while($j < $numRows)
			 {
			 	if($j == 0)
			 	{
			 		$list = " '".$array[$j]."' ";
			 	}else{
			 		$list .= ",'".$array[$j]."' ";
			 	}
			 	$j++;
			 }
			 return $list;
	}
	function arrayFieldsToList($array){
		//NO SINGLE QUOTES
			$j=0;
			 $numRows = count($array);
			 while($j < $numRows)
			 {
			 	if($j == 0)
			 	{
			 		$list = " ".$array[$j]." ";
			 	}else{
			 		$list .= ",".$array[$j]." ";
			 	}
			 	$j++;
			 }
			 return $list;
	}
	function view_array($array){
		 
		 // IN: array
		 // OUT: formatted array printout
		 
		echo('<pre>');
		print_r($array);
		echo('</pre>');
	}
	/*
	 * $exp = explode("_",$string);
		echo($exp[0]);
	 */
 	function postToArrayOfFields($postArray){
		 while (list($key, $val) = each($postArray)) {
		 	//Remove Non Fields From POST array
	 	   if($key != "function" && $key != "pk"  && $key != "actionSelected" && $key != "sortKey" && $key != "ID" && $key != "id"){
		    $a_fields[] = $key;
		   }
		}
		return $a_fields;
	 }
	function postToArrayOfValues($postArray){
		 while (list($key, $val) = each($postArray)) {
		 	if($key != "function" && $key != "pk"  && $key != "actionSelected" && $key != "sortKey" && $key != "ID" && $key != "id"){
		    $a_values[] = $val;
		   }
		}
		return $a_values;
	 }
	 function arraySELECTIONS($db,$table,$a_fields){
	 	while (list($key, $val) = each($a_fields)) {
		 	 
		    $a_selections[] = " ".$db.".".$table.".".$val." ";
		   
		}
		return $a_selections;
	 }
	 /*******************************************/
		function get_dbs(){
			$db_connect = mysql_connect($this->host,$this->username, $this->password);
			$res = mysql_query("SHOW DATABASES");
			
			while ($row = mysql_fetch_assoc($res)) {
			     
			    $a_dbs[] = $row['Database'];
			}
			return $a_dbs;
		}
	 
	 
		function get_tables_from_db( ){
			/*
			 * IN: host, username, password, database
			 * OUT: array of tables
			 */
			$db_connect = mysql_connect($this->host,$this->username, $this->password);
			$tables = mysql_list_tables($this->db); 
			while($row = mysql_fetch_assoc($tables)){
				foreach($row as $k=>$v){
		 			$a_tables[]=$v;
				}
			}
			return $a_tables;
		}
		
		 function get_fields_in_table( ){
		 	/*
			 * IN: database,table
			 * OUT: array of fields
			 */
				 $result = mysql_query("SHOW COLUMNS FROM ".$this->db.".".$this->table."");
				if (!$result) {
				    echo 'Could not run query: ' . mysql_error();
				    exit;
				}
				if (mysql_num_rows($result) > 0) {
				    while ($row = mysql_fetch_assoc($result)) {
				         
				        //$a_fields[]=$row;
				        $a_fields[]=$row['Field']." | ".$row['Type'];
				         
				    }
				}
				return $a_fields;
			 }
		/* BROUGHT OVER FROM o_table*/	
function get_fields(){
			 
			 // IN: database,table
			 //OUT: array of fields
			  
			$this->db_connect;
			$result = mysql_query("SHOW COLUMNS FROM ".$this->db.".".$this->table."" );
			//echo("SHOW COLUMNS FROM ".$this->db.".".$this->table."" );
			if (!$result) {
			    echo 'Could not run query: ' . mysql_error();
			    exit;
			}
			if (mysql_num_rows($result) > 0) {
			    while ($row = mysql_fetch_assoc($result)) {
			        $a_fields[]=$row['Field'];
			    }
			}
			return $a_fields;
	}
	function get_default_headers(){
			 
			$a_fields = $this->get_fields();
			
			$numFields = count($a_fields);
			$i=0;
			while($i < $numFields){
				$a_headers[]=$a_fields[$i];
				$i++;
			}
			
			
			
			return $a_headers;
	}
	 /*END BRING OVER FROM o_table*/
	 
	 /********************************************/
	 function custom_query($sql){
	 	$dbconnection = $this->db_connect();
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			//echo('<br>----------------------------------------------------'.$this->HOST.$this->USERNAME.$this->PASSWORD);
			// echo($sql);
			 $res = mysql_query($sql);
			 //echo($res); 
			 
			 	 
			    	while ($row = mysql_fetch_assoc($res)) 
			    	{
			        	$a_data[]=$row ;
			    	}
		    		$result= $a_data;	
				 
		}
		return $result;
	 }
	 
	 function search_AllFields($table,$a_fields, $keyword){
	 	$listOfFieldsToReturn= $this->arrayFieldsToList($a_fields);
	   	$sql_search = "SELECT ".$listOfFieldsToReturn." FROM ".$table." WHERE ";
		$i=0;
		foreach($a_fields as $v){
			if($i==0){
				$sql_search .="".$v." LIKE '".'%'.$keyword.'%'."'";
			}else{
				$sql_search .=" OR ".$v." LIKE '".'%'.$keyword.'%'."' ";
			}
			$i++;
		}
		 
		return $sql_search;
	}
	 
	 
	 
	function info(){
 		 $a_info = array(
 		 array('class'=>'o_db') ,
 		 array('property_1'=>'0' ),
 		 array('function_1'=>'db_connect()',
 		 'function_2'=>'basic_query(sql)',
 		 'function_3'=>'arrayValuesToList(array)',
 		 'function_4'=>'view_array()',
 		  'function_5'=>'postToArrayOfFields()',
 		  'function_6'=>'postToArrayOfValues()',
 		  'function_7'=>'info()'),
 		    
 		 array('call'=>'
 		 extended by other classes ' )
 		 
 		  );
 		 $result = $this->displayInfo($a_info);
		/*
		 * $result = "INFO{
		class: o_db | 
		properties: 0| 
		functions:db_connect() | basic_query(sql) | arrayValuesToList(array) | arrayFieldsToList(array) | view_array() | postToArrayOfFields | postToArrayOfValues |  info() }";
 		*/
		
 		
 		return $result;
 	}
 	
 	function displayInfo($a_info){
 		//print_r($a_info);
 		return $a_info;
 	}
}
/*----------------------------------------------------------------------------------------------------------------------*/

class o_table_info extends o_db{
	 
	var $db;
	var $table;
	
	function set_db($new_db){ $this->db = $new_db; }
	function get_db(){  return $this->db; }
	function set_table($new_table){ $this->table = $new_table; }
	function get_table(){  return $this->table; }
  
	function get_fields(){
		$dbconnection = $this->db_connect();
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			$sql = mysql_query("SHOW COLUMNS FROM ".$this->db.".".$this->table."");
			 	if (mysql_num_rows($sql) > 0) 
			 	{
			    	while ($row = mysql_fetch_assoc($sql)) 
			    	{
			        	$a_fields[]=$row['Field'];
			    	}
		    		$result= $a_fields;	
				}else{
					$result="NO DATA AVAILABLE";
				}
		}
		return $result;
	}
	
	 
	function info(){
		$result = "INFO{
		class: o_table | 
		properties: db, table | 
		functions:set_db(),get_db(),set_table(),get_table(), get_fields(),info()}";
		return $result;
	}
}

/*----------------------------------------------------------------------------------------------------------------------*/

class o_data extends o_db{
	
	var $db;
	var $table;
	var $a_fields;
	var $a_values;
	var $sql_type;
	var $sql_clause;
	//---LEFTJOIN WORK
	var $db2;
	var $table2;
	var $a_fields2;
	var $relation;
	var $relation2;
	
	var $lastQueryMade;
	
	 
	
	function set_db($new_db){ $this->db = $new_db; }
	function set_table($new_table){ $this->table = $new_table; }
	function set_a_fields($new_a_fields){ $this->a_fields = $new_a_fields; }
	function set_a_values($new_a_values){ $this->a_values = $new_a_values; }
	function set_sql_type($new_sql_type){ $this->sql_type = $new_sql_type; }
	function set_sql_clause($new_sql_clause){ $this->sql_clause = $new_sql_clause; }
	//---LEFTJOIN WORK
	function set_db2($new_db2){ $this->db2 = $new_db2; }
	function set_table2($new_table2){ $this->table2 = $new_table2; }
	function set_a_fields2($new_a_fields2){ $this->a_fields2 = $new_a_fields2; }
	function set_relation($new_relation){ $this->relation = $new_relation; }
	function set_relation2($new_relation2){ $this->relation2 = $new_relation2; }
	
	function get_data(){
		switch($this->sql_type){
			case "SELECT":
			$result = $this->sql_select();
			break;
			case "UPDATE":
			$result = array('sql_type','UPDATE');
			$result = $this->sql_update();
			break;
			case "INSERT":
			$result = array('sql_type','INSERT');
			$result = $this->sql_insert();
			break;
			case "DELETE":
			$result = array('sql_type','DELETE');
			$result = $this->sql_delete();
			break;
			case "LEFTJOIN":
			$result = array('sql_type','LEFTJOIN');
			$result = $this->sql_leftJoin();
			break;
			
			default;
			$result = array($this->db,$this->table,$this->a_fields,$this->values,$this->sql_type,$this->sql_clause);
		}
		return $result;
	}
	function sql_select(){
		$dbconnection = $this->db_connect();
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			//LIST OF FIELDS
			if($this->a_fields !=" "){
			$listOfFields = $this->arrayFieldsToList($this->a_fields);
			}else{
				$listOfFields = "*";
			}
 			$sql = mysql_query("SELECT ".$listOfFields." FROM ".$this->db.".".$this->table." ".$this->sql_clause."");
			 	// echo("</br>SELECT ".$listOfFields." FROM ".$this->db.".".$this->table." ".$this->sql_clause."");
 				$this->lastQueryMade="</br>SELECT ".$listOfFields." FROM ".$this->db.".".$this->table." ".$this->sql_clause."";
 			//echo($this->lastQueryMade);
 				if (mysql_num_rows($sql) > 0) 
			 	{
			    	while ($row = mysql_fetch_assoc($sql)) 
			    	{
			        	$a_data[]=$row ;
			    	}
		    		$result= $a_data;	
				}else{
					$result="NO DATA AVAILABLE";
				}
		}
		return $result;
	}
	function lastQueryMade(){
		echo($this->lastQueryMade);
	}
	function sql_update(){
		$dbconnection = $this->db_connect();
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			 $i=0;
			 $numRows = count($this->a_fields);
			 while($i < $numRows)
			 {
			 	if($i == 0)
			 	{
			 		$keyValuePairs = " ".$this->a_fields[$i]."='".$this->a_values[$i]."'";
			 	}else{
			 		$keyValuePairs .= ", ".$this->a_fields[$i]."='".$this->a_values[$i]."'";
			 	}
			 	$i++;
			 }
			 if( $this->sql_clause !=" " && $this->sql_clause !=""){
			 	$query_update = "UPDATE ".$this->db.".".$this->table." SET ".$keyValuePairs." ".$this->sql_clause."";
				  // echo('<br>'.$query_update);
				//$this->lastQueryMade =$query_update;
				//echo($this->lastQueryMade );
			 	$result = $this->basic_query($query_update);
			 }else{
			 	$result = "YOU MUST HAVE AN SQL_CLAUSE FOR UPDATE";
			 }
		}
		return $result;
	}
	
	function sql_insert(){
		$dbconnection = $this->db_connect();
		 
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			
			//LIST OF FIELDS
			$listOfFields = $this->arrayFieldsToList($this->a_fields);
			
			//LIST OF VALUES
			 $listOfValues = $this->arrayValuesToList($this->a_values);
			 
  			 $query_insert = "INSERT INTO ".$this->db.".".$this->table." (".$listOfFields.") VALUES (".$listOfValues.") ";
			// echo('<br>'.$query_insert);
			 $this->lastQueryMade=$query_insert;
  			 $result = $this->basic_query($query_insert);
			  
		}
		return $result;
	}
	function sql_delete(){
		$dbconnection = $this->db_connect();
		 
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			$query_delete = "DELETE FROM ".$this->db.".".$this->table." ".$this->sql_clause."";
			$this->lastQueryMade=$query_delete;
			$result = $this->basic_query($query_delete);
		}
		return $result;
	}
	function sql_leftJoin(){
		//SELECT db.tbl_1.fld_1,db.tbl_1.fld_2, db.tbl_2.fld_1  FROM db.tbl_1 LEFT JOIN db.tbl_2 ON db.tbl_1.fld_related = db.tbl_2.fld_related
		$dbconnection = $this->db_connect();
		if($dbconnection !=1)
		{
			$result="MySql Connection Error";
		}
		else
		{
			//LIST OF SELECTIONS
			//INSTEAD of a listOfFields I need a listOfSelections like "db.tbl_1.fld_1"
			// a_selections = array("db.tbl_1.fld_1","db.tbl_1.fld_2","db.tbl_2.fld_1");
			
			if($this->a_fields !=" "){
				$a_selections = $this->arraySELECTIONS($this->db,$this->table,$this->a_fields);
			}else{
				$a_selections = $this->db.".".$this->table." ";
			}
			
			if($this->a_fields2 !=" "){
				$a_selections2 = $this->arraySELECTIONS($this->db2,$this->table2,$this->a_fields2);
			}else{
				$a_selections2 = $this->db2.".".$this->table2." *";
			}
			
 			$listOfSelections = $this->arrayFieldsToList($a_selections);
			$listOfSelections2 = $this->arrayFieldsToList($a_selections2);
			
  			$sql = mysql_query("SELECT ".$listOfSelections.",".$listOfSelections2."   FROM  ".$this->db.".".$this->table." LEFT JOIN  ".$this->db2.".".$this->table2." ON ".$this->db.".".$this->table.".".$this->relation." = ".$this->db2.".".$this->table2.".".$this->relation2."");
			
 			 //echo("SELECT ".$listOfSelections.",".$listOfSelections2."   FROM  ".$this->db.".".$this->table." LEFT JOIN  ".$this->db2.".".$this->table2." ON ".$this->db.".".$this->table.".".$this->relation." = ".$this->db2.".".$this->table2.".".$this->relation2."");
  				if (mysql_num_rows($sql) > 0) 
			 	{
			    	while ($row = mysql_fetch_assoc($sql)) 
			    	{
			        	$a_data[]=$row ;
			    	}
		    		$result= $a_data;	
				}else{
					$result="NO DATA AVAILABLE";
				}
		}
		return $result;
	
	}
	function definePkAndPkValue($a_post){
	 		$pk = $a_post['pk'];
			while (list($key, $val) = each($a_post)) {
			     
			    if($key == $pk)
			    {
			    	$pk_value=$val;
			    }
			}
			$a_pk = array('pk'=>$pk,'pk_value'=>$pk_value);
			//$a_pk = array($pk,$pk_value);
			  
			return $a_pk;
	}
	
	function info(){
		$result_old = "</br>==============================================================
		</br>INFO{ <br>class: o_data extends o_db
		<br>properties: db, table, a_fields, a_values, sql_type, sql_clause  
		<br>functions: (set_x and get_x for all properties), get_data(), definePkAndPkValue() |  info() 
		<br>SQL TYPES: INSERT, UPDATE, SELECT, DELETE  
		<br>INSERT INTO db.table field1,field2 VALUES 'value1','value2' 
		<br>UPDATE db.table SET field1='value1',field2='value2' sql_clause 
	 	<br>SELECT field1,field2 FROM db.table sql_clause 
		<br>DELETE FROM db.table WHERE ID = X 
		<br>LEFT JOIN: SELECT db.tbl_1.fld_1,db.tbl_1.fld_2, db.tbl_2.fld_1  FROM db.tbl_1 LEFT JOIN db.tbl_2 ON db.tbl_1.fld_related = db.tbl_2.fld_related 
		<br>
		//-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o
		//CALL PREPARATION:   
	 	//PARENT CLASS: \$o_db = new o_db(); //echo(\$o_db->info()); 
		\$o_data = new o_data();//echo(\$o_data->info()); 
		\$o_data->set_db('kb');
		\$o_data->set_table('kb_articles');
		\$a_fields = \$o_data->postToArrayOfFields(\$_POST);
 		\$o_data->set_a_fields(\$a_fields); //ALL FIELDS=(' ') //EXPLICIT FIELDS=(\$a_fields)
 		\$a_values = \$o_data->postToArrayOfValues(\$_POST);
 		\$o_data->set_a_values(\$a_values);
		\$o_data->set_sql_type('SELECT'); // INSERT , UPDATE , SELECT , DELETE 
		\$a_post = \$_POST;
		\$a_pk = \$o_data->definePkAndPkValue(\$a_post);
		\$o_data->set_sql_clause('  WHERE '.\$a_pk['pk'].' ='.\$a_pk['pk_value'].'');
		// WHERE x = y LIMIT n ORDER BY z ASC //'  WHERE '.\$a_pk['pk'].' ='.\$a_pk['pk_value'].''
		\$a_data = \$o_data->get_data();
		// view_array(\$a_data);
	 	//-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o
		
	<br>}
	</br>==============================================================</br>
	";
		
		// get_data(), definePkAndPkValue() |  info() 
		$a_info = array(
 		 array('class'=>'o_data extends o_db') ,
 		 array( 'property_1'=>'db','property_2'=> 'table','property_3'=> 'a_fields','property_4'=> 'a_values','property_5'=> 'sql_type', 'property_6'=>'sql_clause' ),
 		 array('function_1'=>'setters and getters',
 		 'function_2'=>'get_data()',
 		 'function_3'=>'definePkAndPkValue()',
 		  'function_4'=>'info()'),
 		    
 		 array("call'=>'
 		</br>//CALL PREPARATION:   
	 	</br>//PARENT CLASS: \$o_db = new o_db(); //echo(\$o_db->info()); 
		</br>\$o_data = new o_data();//echo(\$o_data->info()); 
		</br>\$o_data->set_db('kb');
		</br>\$o_data->set_table('kb_articles');
		</br>\$a_fields = \$o_data->postToArrayOfFields(\$_POST);
 		</br>\$o_data->set_a_fields(\$a_fields); //ALL FIELDS=(' ') //EXPLICIT FIELDS=(\$a_fields)
 		</br>\$a_values = \$o_data->postToArrayOfValues(\$_POST);
 		</br>\$o_data->set_a_values(\$a_values);
		</br>\$o_data->set_sql_type('SELECT'); // INSERT , UPDATE , SELECT , DELETE 
		</br>\$a_post = \$_POST;
		</br>\$a_pk = \$o_data->definePkAndPkValue(\$a_post);
		</br>\$o_data->set_sql_clause('  WHERE '.\$a_pk['pk'].' ='.\$a_pk['pk_value'].'');
		</br>// WHERE x = y LIMIT n ORDER BY z ASC //'  WHERE '.\$a_pk['pk'].' ='.\$a_pk['pk_value'].''
		</br>\$a_data = \$o_data->get_data();
		</br>// view_array(\$a_data); " )
 		 
 		  );
 		 $result = $this->displayInfo($a_info);
		
		
		return $result;
		
	}
	
	 
	 
	 

}
 
 



?>


 
