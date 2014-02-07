<?php 
 //NEW Report ----------------------------------------------------
	$o_form_newReport = new o_form();
	$o_form_newReport->set_pk($pk_main);	
	$o_form_newReport->set_pk_value($_POST[id]);
	$o_form_newReport->set_controller('section3/report_controller.php');		
	$o_form_newReport->set_function('new_report');	
	$o_form_newReport->set_sectionTitle($a_pages[2]);		//CROSS REFERENCE -> navigation.php
	$o_form_newReport->set_ajax_id('ajaxContent');
	
	$html = $o_form_newReport->form_new_report();
	  
 	include_once(BASE_PATH.'/views/section3/new_report_view.php');



if ($_POST['function']=="new_report"){
	//GET DATA----------------------------------------------------------------------
	$db="forte";$table="bills_paid";
	$contact_id=$_POST['main_pk_value'];
	$_SESSION['page']=$a_pages[2];
	$sql = "SELECT due_date,amt FROM ".$db.".".$table." WHERE contact_id=".$contact_id."";
	$a_data = $o_db->custom_query($sql); 
	//-----PREPARE DATA for json encode 
   	$count = count($a_data);
	$i=0;
	while($i < $count){
		$dataset1[] = array((strtotime(  $a_data[$i]['due_date']) * 1000 ),  $a_data[$i]['amt']  );
		$i++;
	}
	//json encode
	$json_dataSet = json_encode($dataset1);
	//convert to a  javascript variable for the graph
	 echo("<script>var json_dataSet =".$json_dataSet.";</script>");  
	 // DO NOT INCLUDE HEADER
	 include_once(BASE_PATH.'/views/section3/new_report_graph_view.php');
	 //  DO NOT INCLUDE FOOTER
}
?>



<!-- VIEW: -->
<script type="text/javascript" src="<?=BASE_URL;?>library/js/jquery.js"></script>
<script type="text/javascript" src="<?=BASE_URL;?>library/js/jquery.flot.js"></script>

 <div style="position:relative;top:0px;left:0px;height:300px;width:300px; overflow:hidden;">
	<div id="section3_graph_view" style=" position:absolute;  left:300px;width:300px;height:300px;">
			<div class="group_container" style="margin-top:0px;">
				<div class="group"   >
					<div   class="dynamic_box_full" style="height:212px;"> 
					 
			  		<div class="row" ><?= $_SESSION['main_choice_name'];?></div>
						<div id="placeholder" class="row margin_left_10 margin_top_10" style=" width:270px;height:160px;background-color:#ffffff;"></div>
						<script id="source">
						$(function () {
				 			  var dataSet = json_dataSet;
						    $.plot($("#placeholder"), [dataSet], { xaxis: { mode: "time" ,timeformat: "%y/%m/%d"} });
						});
						</script>
					</div> 
				</div>
			</div>
		</div>
	</div> 
 <script>
$(document).ready(function() {
 	$("#section3_graph_view").animate({"left": "-=300px"}, "slow");
	});
</script>


 
