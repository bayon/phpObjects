//CSV FILE TO MYSQL TABLE -------------------------------

$o_csv = new o_csv();
$o_csv->db_connect();
$o_csv->set_csvFileToConvert(BASE_PATH."/JPMC(1).CSV");
$o_csv->set_cleanedFilePathAndName(BASE_PATH."/00_csv_clean.txt");
$o_csv->set_target_table("forte.jointchecking");
$o_csv->set_max_line_length(1000);
$o_csv->csv_clean_chase();
$o_csv->csv_file_to_mysql_table();