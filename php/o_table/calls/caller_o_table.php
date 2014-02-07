<?php 
include_once('class_o_table.php');
include_once('../o_data/class_lib.php');
echo(__FILE__);
$o_data = new o_data();
//echo($o_data->info());
$o_data->set_db('kb');
$o_data->set_table('kb_articles');
//SELECT
//EXPLICIT FIELDS
$o_data->set_a_fields(array( 'article_id','article_title','article_short_desc'));
//ALL FIELDS
//$o_data->set_a_fields(" ");

$o_data->set_sql_type('SELECT');
$o_data->set_sql_clause('WHERE article_id < 20  LIMIT 5');//WHERE id= 3 
$a_data = $o_data->get_data();
//SELECT RESULT
 
//GET FIELD NAMES


$o_table = new o_table();
//echo($o_table->info());

$o_table->set_db("kb");
$o_table->set_table("kb_articles");
$o_table->set_table_id("table1");
$o_table->set_table_pk("article_id");
//HEADERS
//EXPLICIT
$a_headers = array('article_id','article_title','article_short_desc');
//ALL
//$a_headers = $o_table->get_default_headers();

$o_table->set_a_headers($a_headers);
$o_table->set_a_data($a_data);
//controller, function, ajaxId 

$o_table->set_controller('object_controller.php');
$o_table->set_function('tableRowSelected');
$o_table->set_ajaxId('ajaxContent');

$table = $o_table->get_table();

include('table_view.php');
//echo($table);

?>
 

 

