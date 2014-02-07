<?php 

// Object: o_file File Uploader
$o_file = new o_file();
$o_file->set_form_id('bayon_upload');
$o_file->set_page('CSV');
$o_file->set_target_path("library/uploads/");
$html_uploader=  $o_file->upload();

?>