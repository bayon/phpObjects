 <?php 
class o_form extends o_db{
	var $a_data;
	var $pk;
	var $pk_value;
	var $a_actions;
	var $controller;
	var $function;
	var $a_labels;
	var $title;
	var $sectionTitle;
	var $ajax_id;
	var $form_id;
	
	function set_form_id($new_form_id){ $this->form_id = $new_form_id; }
	function set_a_data($new_a_data){ $this->a_data = $new_a_data; }
	function set_pk($new_pk){ $this->pk = $new_pk; }
	function set_pk_value($new_pk_value){ $this->pk_value = $new_pk_value; }
	function set_a_actions($new_a_actions){ $this->a_actions = $new_a_actions; }
	function set_controller($new_controller){ $this->controller = $new_controller; }
	function set_function($new_function){ $this->function = $new_function; }
	
	function set_a_labels($new_a_labels){ $this->a_labels = $new_a_labels; }
	function set_title($new_title){ $this->title = $new_title; }
	function set_sectionTitle($new_sectionTitle){ $this->sectionTitle = $new_sectionTitle; }
	
function set_ajax_id($new_ajax_id){ $this->ajax_id = $new_ajax_id; }


	
	function formInputs (){
		if($this->pk != '' &&  $this->pk != ' '){
			$html =" 
			 
			<div id='GENERIC_FORM1' class='row formClass'  >
			<div class='row  '>
			<div class='item' style='display:none;'><button id='' class='formReturn' name='' value=''>".$this->title."</button></div>
			<div class='item' style='float:right;'><button id='' class='formDetails' name='' value=''>Details</button></div>
			</div>
			";
			$html .="<input type='hidden' id='pkId' name='pk' value='".$this->pk."' class='inputData' />";
			 
			$i=0;
			foreach ($this->a_data as $c) {
				$html .= "<div class='row'>";
		        while (list($k, $v) = each ($c)) {
		        		//LIMIT TEXT SIZE: $val = substr($v,0,15);
		        		$val = $v;
 		                $html.="<div class='row form_row'>
				                	<div class='item  form_label'>
										 ".$this->a_labels[$i]."
									</div>
									<div class='item  '>
										<input type='text' style='width:190px;' class='form_input inputData' name='".$k."' value='".$val."'  />
									</div>
								</div>";
		                $i++;
		        }
		        
		        
		        $html .="
					</div>";
			}
			 
			
			
			$html .="
				<div class='row'  >
					<div class='row formActionContainer'>
						<div class='item  form_label'>
							  &nbsp;
						</div>";
				$html .="<div class='item formSelectorContainer'><select class='selectData formSelector' id='' name='actionSelected' >";		
					$i=0;
					$numActions = count($this->a_actions);
					while($i<$numActions){
					$html .="	<div class='item'>
							<option    value='".$this->a_actions[$i]."' name='dataAction_".$i."'    >".$this->a_actions[$i]."</option>
						</div>";
					$i++;
					}
					$html .="</select></div>";
					$html .="<input id='data_submit' type='submit'  value='submit' name='submit'  class='formButton '  style='' />";
				$html .="	</div>
				</div>
			</div>
			<!--  end Component -->
			";
			
			$javascript .="
			<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
			<script>
			$('#GENERIC_FORM1 #data_submit').click(function()
					{
				        var data_post='function=".$this->function."';
				      $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      
				      
				     	 //alert(data_post);
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						 // alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								 //alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					$('.formDetails').click(function()
					{
					 	var data_post='function=drillDown1';
					 	 $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						// alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								// alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								$('#form_view').html(returnData);
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					
			</script>";
			 $result = $html.$javascript;
			}else{
				$result = "<br>o_form: NO PK";
			}
		return $result;
	}

	function formInputsDetails(){
		if($this->pk != '' &&  $this->pk != ' '){
			$html =" 
			 
			<div id='GENERIC_FORM2' class='row formClass'  >
			<div class='row  '>
			<div class='item' style='display:none;'><button id='' class='formReturn' name='' value=''>".$this->title."</button></div>
			<div class='item' style='float:right;'><button id='' class='formDetails' name='' value=''>Details</button></div>
			</div>
			";
			$html .="<input type='hidden' id='pkId' name='pk' value='".$this->pk."' class='inputData' />";
			 
			$i=0;
			foreach ($this->a_data as $c) {
				$html .= "<div class='row'>";
		        while (list($k, $v) = each ($c)) {
		        		//LIMIT TEXT SIZE: $val = substr($v,0,15);
		        		$val = $v;
 		                $html.="<div class='row form_row'>
				                	<div class='item  form_label'>
										 ".$this->a_labels[$i]."
									</div>
									<div class='item'>
										<input type='text' style='width:190px;' class='form_input inputData' name='".$k."' value='".$val."'  />
									</div>
								</div>";
		                $i++;
		        }
		        
		        
		        $html .="
					</div>";
			}
			 
			
			
			$html .="
				<div class='row'  >
					<div class='row formActionContainer'>
						<div class='item  form_label'>
							  &nbsp;
						</div>";
				$html .="<div class='item formSelectorContainer'><select class='selectData formSelector' id='' name='actionSelected' >";		
					$i=0;
					$numActions = count($this->a_actions);
					while($i<$numActions){
					$html .="	<div class='item'>
							<option    value='".$this->a_actions[$i]."' name='dataAction_".$i."'    >".$this->a_actions[$i]."</option>
						</div>";
					$i++;
					}
					$html .="</select></div>";
					$html .="<input id='data_submit' type='submit'  value='submit' name='submit'  class='formButton '  style='' />";
				$html .="	</div>
				</div>
			</div>
			<!--  end Component -->
			";
			
			$javascript .="
			<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
			<script>
			$('#GENERIC_FORM2 #data_submit').click(function()
					{
				        var data_post='function=".$this->function."';
				      $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      
				      
				     	 //alert(data_post);
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						 // alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								 //alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					$('.formDetails').click(function()
					{
					 	var data_post='function=drillDown1';
					 	 $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						// alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								 //alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								$('#form_view').html(returnData);
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					
			</script>";
			 $result = $html.$javascript;
			}else{
				$result = "<br>o_form: NO PK";
			}
		return $result;
	}
	
	
	function form_sortByAjax(){ 
 		$result =" 
			 
			<div id='GENERIC_FORM1' class='row formClass'  >
			<div class='row formTitle'>Sorter:</div>
			";
 		 $result .="<div class='row form_row'>
				                	<div class='item  form_label'>
										 sort by:
									</div>
									<div class='item'>
										<input type='text' class='form_input inputData' name='sortKey'    />
									</div>
								</div>";
 		 
 		 $result .="<input id='data_submit' type='submit'  value='submit' name='submit'  class='formButton  '/></div>";
 		 $javascript .="
			<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
			<script>
			$('#GENERIC_FORM1 #data_submit').click(function()
					{
				        var data_post='function=".$this->function."';
				      $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      
				      
				     	 //alert(data_post);
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						//alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								 //alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
			</script>";
			 $result = $result.$javascript;
 		 
		return $result;
	}
	function form_sortByPost(){ 
 		$result =" 
 			<div id='".$this->form_id."' class='row formClass ' style='width:150px;'  >
			 <form method='post' action='".BASE_URL."/index.php'>
			<input type='hidden' name='page' value='".$this->sectionTitle."'/>
			<input type='hidden' name='function' value='sortBy_submission'/>
			 
			";
 		 $result .="<div class='row form_row'  >
									<div class='item' style='height:35px; '>
										<input type='text' class='form_input inputData' name='sortKey' style='width:100px;'   />
									
										<input id='data_submit' type='submit'  value='filter' name='submit'  class='formButton  ' style=''/>
									</div>
								</div>";
 		 
 		 //$result .="<input id='data_submit' type='submit'  value='submit' name='submit'  class='formButton'   /></div>";
 		 $result .="</div></form>";
			 $result = $result;
 		 
		return $result;
	}
	
	function form_newRecord(){ 
 		$result =" 
 			<div id='GENERIC_FORM1' class='row formClass ' style='width:150px;'  >
			 <form method='post' action='".BASE_URL."/index.php'>
			<input type='hidden' name='page' value='".$this->sectionTitle."'/>
			<input type='hidden' name='function' value='new_record'/>
			 
			";
 		 $result .="<div class='row form_row'  >
									  
									<div class='item margin_left_5' style='height:35px;'>
										<input id='data_submit' type='submit'  value='new_record' name='submit'  class='formButton  ' style=''/>
									</div>
								</div>";
 		 
  		 $result .="</div></form>";
			 $result = $result;
 		 
		return $result;
	}

	function form_newRecord_submit (){
		if($this->pk != '' &&  $this->pk != ' '){
			$html =" 
			 
			<div id='GENERIC_FORM1' class='row formClass'  >
			<div class='row  '>
			<div class='item' style='display:none;'><button id='' class='formReturn' name='' value=''>".$this->title."</button></div>
			 
			</div>
			";
			$html .="<input type='hidden' id='pkId' name='pk' value='".$this->pk."' class='inputData' />";
			 
			$i=0;
			foreach ($this->a_data as $c) {
				$html .= "<div class='row'>";
		        while (list($k, $v) = each ($c)) {
		        		//LIMIT TEXT SIZE: $val = substr($v,0,15);
		        		$val = $v;
 		                $html.="<div class='row form_row'>
				                	<div class='item  form_label'>
										 ".$this->a_labels[$i]."
									</div>
									<div class='item  '>
										<input type='text' style='width:190px;' class='form_input inputData' name='".$k."' value='".$val."'  />
									</div>
								</div>";
		                $i++;
		        }
		        
		        
		        $html .="
					</div>";
			}
			 
			
			
			$html .="
				<div class='row'  >
					<div class='row formActionContainer'>
						<div class='item  form_label'>
							  &nbsp;
						</div>";
				$html .="<div class='item formSelectorContainer'><select class='selectData formSelector' id='' name='actionSelected' >";		
					$i=0;
					$numActions = count($this->a_actions);
					while($i<$numActions){
					$html .="	<div class='item'>
							<option    value='".$this->a_actions[$i]."' name='dataAction_".$i."'    >".$this->a_actions[$i]."</option>
						</div>";
					$i++;
					}
					$html .="</select></div>";
					$html .="<input id='data_submit' type='submit'  value='submit' name='submit'  class='formButton '  style='' />";
				$html .="	</div>
				</div>
			</div>
			<!--  end Component -->
			";
			
			$javascript .="
			<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
			<script>
			$('#GENERIC_FORM1 #data_submit').click(function()
					{
				        var data_post='function=".$this->function."';
				      $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      
				      
				     	 //alert(data_post);
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						 // alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								 //alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					$('.formDetails').click(function()
					{
					 	var data_post='function=drillDown1';
					 	 $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						// alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								// alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								$('#form_view').html(returnData);
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
					
			</script>";
			 $result = $html.$javascript;
			}else{
				$result = "<br>o_form: YOU NEED TO DEFINE THE PRIMARY KEY";
			}
		return $result;
	}
	
	
	function info(){
		$result = "</br>INFO:
		{ class: o_form |
		 properties: a_data , pk , a_actions , controller , function 
		  functions: formInputs()   ,info()
		}
		</br>o-o-o- o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o
		</br>//CALL PREPARATION
		</br>\$o_formInputs = new o_form();
		</br>echo('<br>'.\$o_formInputs->info().'</br>');
		</br>\$o_formInputs->set_a_data(\$a_detailData);
		</br>\$o_formInputs->set_pk('article_id');
		</br>\$o_formInputs->set_controller('o_form_controller.php');
		</br>\$o_formInputs->set_function('data_submission_01');
		</br>\$a_actions = array('SELECT','UPDATE','INSERT','DELETE');
		</br>//view_array(\$a_actions); 
		</br>\$o_formInputs->set_a_actions(\$a_actions);
		</br>\$html = \$o_formInputs->formInputs();
		</br>echo(\$html);
		</br>o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o
			";
		//a_data , pk , a_actions , controller , function 
		$a_info = array(
		array('class'=>'o_form extends o_db') ,
		array( 'property_1'=>'a_data','property_2'=> 'pk','property_3'=> 'a_actions','property_4'=> 'controller','property_5'=> 'function','property_6'=> 'a_labels', ),
		array('function_1'=>'formInputs()',
				'function_2'=>'info()'),
		array("call'=>'
		</br>//CALL PREPARATION
		</br>\$o_formInputs = new o_form();
		</br>echo('<br>'.\$o_formInputs->info().'</br>');
		</br>\$o_formInputs->set_a_data(\$a_detailData);
		</br>\$o_formInputs->set_pk('article_id');
		</br>\$o_formInputs->set_controller('o_form_controller.php');
		</br>\$o_formInputs->set_function('data_submission_01');
		</br>\$a_actions = array('SELECT','UPDATE','INSERT','DELETE');
		</br>//view_array(\$a_actions); 
		</br>\$o_formInputs->set_a_actions(\$a_actions);
		</br>\$html = \$o_formInputs->formInputs();
		</br>echo(\$html);
		</br> " )
		);
		$result = $this->displayInfo($a_info);
		
		return $result;
		
	}

function form_new_report (){
		 
			/*	*/
			$html =" 
 			<div id='Form_New_Report' class='row formClass ' style='width:150px;'  >
			";
 		 $html .="<div class='row form_row'  >
						<div class='item margin_left_5' style='height:35px;'>
							<input type='hidden' name='main_pk' value='".$this->pk."' class='inputData' />
							<input type='hidden' name='main_pk_value' value='".$this->pk_value."'  class='inputData' />
							<input id='data_submit' type='submit'  value='Overview' name='submit'  class='formButton  ' style=''/>
						</div>
					</div>";
  		 $html .="</div> ";
  		 $javascript .="
			<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
			<script>
			$('#Form_New_Report #data_submit').click(function()
					{
				        var data_post='function=".$this->function."';
				      $('.inputData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      $('.selectData').each(function(){
				        var value = $(this).attr('value');
				        var key = $(this).attr('name');
				        data_post +='&'+key+'='+value;
				      });
				      
				      
				     	 //alert(data_post);
				     	var TYPE='POST';
						var URL = '".BASE_URL."controllers/".$this->controller."';
						var DATA=data_post;
						  //alert('-----'+URL+'-----'+DATA);
						$.ajax({
								type:TYPE,
								url:URL,
								data:DATA,
								success:function(returnData)
								{ 
								//alert(returnData); 
								//alert('SUCCESS: class_o_form.php ');
								$('#ajaxContent').html(returnData);
								},
								error:function(){ alert('ajax error: class_o_form'); }
							});
					});
			</script>";
			 $result .= $html.$javascript;
  		  
		return $result;
		
	 
		 
	}
	
	
}
 
?>

 