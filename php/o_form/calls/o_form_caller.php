<?php echo('<br>'. __FILE__ .'');?>
<?php  $development_info .="<br>FILE:".__FILE__; ?>
<?php 
include('class_o_form.php');

$o_formInputs = new o_form();
echo('<br>'.$o_formInputs->info().'</br>');
$o_formInputs->set_a_data($a_detailData);
$o_formInputs->set_pk('article_id');
$o_formInputs->set_controller('o_form_controller.php');
$o_formInputs->set_function('data_submission_01');
$a_actions = array('SELECT','UPDATE','INSERT','DELETE');
//view_array($a_actions); 
$o_formInputs->set_a_actions($a_actions);
$html = $o_formInputs->formInputs();
echo($html);

?>