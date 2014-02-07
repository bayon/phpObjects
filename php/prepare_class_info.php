<?php 
$a_info = array(
array('class'=>'o_data extends o_db') ,
array( 'property_1'=>'xxx','property_2'=> 'xxx','property_3'=> 'xxx','property_4'=> 'xxx', ),
array('function_1'=>'setters and getters',
		'function_2'=>'xxx',
		'function_3'=>'xxx',
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
?>