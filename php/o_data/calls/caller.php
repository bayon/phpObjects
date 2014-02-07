<?php 
//include_once('config.php');
include_once('class_lib.php');

//------------------------------------------------------------------------

$o_data2 = new o_data();
echo($o_data2->info());

$o_data2->set_db('kb');
$o_data2->set_table('kb_articles');
//SELECT
$o_data2->set_a_fields(array( 'article_id','article_title'));
$o_data2->set_a_fields(" ");
//$o_data->set_a_values(array( 'SHAZAM','1.4'));
$o_data2->set_sql_type('SELECT');
$o_data2->set_sql_clause('WHERE article_id < 20  ');//WHERE id= 3 
$data2 = $o_data2->get_data();
//SELECT RESULT
 echo('<pre>');
print_r($data2);
echo('</pre>');
echo('<br>=====abc========================================================</br>');
/*
$html = "<table border='1' width='900'>";
$numRows = count($data2);
//need number of columns 
echo($numRows);
$count = count($data2);

foreach ($data2 as $c) {
		$html .= "<tr>";
        while (list($k, $v) = each ($c)) {
        		$val = substr($v,0,15);
                $html .= "<td>".$val."</td>";
        }
        $html .="</tr>";
}


$html .="</table>";

echo($html);
*/
echo('<br>=====123========================================================</br>');

$o_table = new o_tableBasic();
echo($o_table->get_table());

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
<script>
$('.td').click(function(){alert(this.id);});
</script>
<script> 
$(document).ready(function() 
		    { //REFERENCE: http://tablesorter.com/docs/index.html#Getting-Started
		        $("#table1").tablesorter( {sortList: [[0,0], [1,0]]} ); 
		    } 
		); 
</script>
