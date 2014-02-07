<?php 

include_once('../o_data/class_o_data.php');

class o_table  extends o_db{
	var $table_id;
	var $table_pk;
	var $a_headers;
	var $a_data;
	var $db;
	var $table;
	
	var $controller;
	var $function;
	var $ajaxId;
	//table_id, a_headers , data
	function set_db($new_db){ $this->db = $new_db; }
	function set_table($new_table){ $this->table = $new_table; }
	
	function set_table_id($new_table_id){ $this->table_id = $new_table_id; }
	function set_table_pk($new_table_pk){ $this->table_pk = $new_table_pk; }
	function set_a_headers($new_a_headers){ $this->a_headers = $new_a_headers; }
	function set_a_data($new_a_data){ $this->a_data = $new_a_data; }
	
	function set_controller($new_controller){ $this->controller = $new_controller; }
	function set_function($new_function){ $this->function = $new_function; }
	function set_ajaxId($new_ajaxId){ $this->ajaxId = $new_ajaxId; }
	
	function get_table( ){
		$table_open = "<div class='tableClass'><table id='".$this->table_id."'  cellpadding=0 cellspacing=0   width='100%' >";
		$thead_open ="<thead><tr>";
 		 $numHeaders = count($this->a_headers);
		 $i=0;
		 while($i < $numHeaders){
			$thead_th .="<th class='link headerSortable'>".$this->a_headers[$i]."</th>";
			$i++;
		 }
		$thead_close ="</tr></thead>";
			$tbody_open="<tbody>";
				 
			 
				foreach ($this->a_data as $c) {
						$tbody .= "<tr id='".$c[$this->table_pk]."' class='tr'>";
				        while (list($k, $v) = each ($c)) {
				        		if($k == $this->table_pk){
				        			/* KEEP pk VALUES HIDDEN */
				        		}else{
				        			$val = substr($v,0,15);
				            		$tbody .= "<td  class='td'>".$val."</td>";
				        		}
				                
				        }
				        $tbody .="</tr>";
				}
				
				 
			$tbody_close="</tbody>";
		$table_close="</table></div>";
 		$table_jQuery =  "<script language='javascript' type='text/javascript' src='".BASE_URL."library/js/jquery.tablesorter.min.js'></script>";
		$table_javascript ="
						  
						<script>
						$('.tr').click(function()
						{
						//alert(this.id);
						//$('.tr').css('background-color','white');
						 
						//$(this).css('background-color','lightgreen');
						var TYPE='POST';
						var URL ='".BASE_URL."controllers/".$this->controller."';
						var DATA='function=".$this->function."&id='+this.id +'&ajaxId=".$this->ajaxId."' ;
						//alert('URL: '+URL+'  DATA: '+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{
								//alert('success');
								// alert(returnData);
								$('#".$this->ajaxId."').html(returnData);
								},
								error:function(){alert('AJAX ERROR: class_o_table.php' + '     URL: '+URL+'  DATA: '+DATA);}
							});
						});
						</script>
						<script>
						$('.headerSortable').click(function()
						{
							alert('sort!');
							 
						});
						</script>
						
						<script> 
						$(document).ready(function() 
								    { //REFERENCE: http://tablesorter.com/docs/index.html#Getting-Started
								       // $('#".$this->table_id."').tablesorter( {sortList: [[0,0], [1,0]]} ); 
								    } 
								); 
						</script>
						";
		
		$result = $table_open.$thead_open.$thead_th.$thead_close.$tbody_open.$tbody.$tbody_close.$table_close.$table_jQuery.$table_javascript;
		return $result;
	}
	/**/
	/*
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
	 */
	function info(){
 		$result_OLD = "</br>INFO
 		</br>{
		</br>class: o_table  
		</br>properties: table_id, table_pk, a_headers, a_data, db ,table , controller, function, ajaxId
		</br>functions: get_table() | get_fields() | get_default_headers() | (set_x and get_x for all properties)
		</br>}";
 		
 		$a_info = array(
		array('class'=>'o_table extends o_db') ,
		array( 'property_1'=>'table_id','property_2'=> 'table_pk','property_3'=> 'a_headers','property_4'=> 'a_data','property_5'=> 'db',
		'property_6'=> 'table','property_7'=> 'controller','property_8'=> 'function','property_9'=> 'ajaxId', ),
		array('function_1'=>'setters and getters',
				'function_2'=>'xxx',
				'function_3'=>'xxx',
				'function_4'=>'info()'),
		array("call"=>" 
		//CALL PREPARATION:
		\$o_table = new o_table();
		//echo(\$o_table->info());
		\$o_table->set_db('kb');
		\$o_table->set_table('kb_articles');
		\$o_table->set_table_id('table1');
		\$o_table->set_table_pk('article_id');
		//HEADERS
		\$a_headers = array('article_id','article_title','article_short_desc');//EXPLICIT
		//\$a_headers = \$o_table->get_default_headers();//ALL
		\$o_table->set_a_headers(\$a_headers);
		\$o_table->set_a_data(\$a_data);
		\$o_table->set_controller('object_controller.php');
		\$o_table->set_function('tableRowSelected');
		\$o_table->set_ajaxId('ajaxContent');
		
		\$table = \$o_table->get_table();
				
		") );
		$result = $this->displayInfo($a_info);
 		 
 		return $result;
 	}
	
}
?>