<?php 
$o_file = new o_file();
$o_file->set_form_id('UNIQUE_ID');
$o_file->set_page('CSV');
$o_file->set_target_path("library/uploads/");
$html_uploader=  $o_file->upload();

require(BASE_PATH.'/views/header.php');
require(BASE_PATH.'/views/sectionX/sectionX_view.php');
require(BASE_PATH.'/views/footer.php');
?>