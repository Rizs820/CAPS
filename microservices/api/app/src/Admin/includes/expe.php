<?php
date_default_timezone_set('Asia/Kolkata');


include 'includes/db_connect.php';

//include_once 'includes/functions.php';
//include_once 'includes/fetch.php';


$table="form_data"; // this is the tablename that you want to export to csv from mysql.
 
exportMysqlToCsv($table,'export.csv',$mysqli);
 
?>


<?php
 
function exportMysqlToCsv($table,$filename,$mysqli)
{
	$csv_terminated = "\n";
	$csv_separator = ",";
	$csv_enclosed = '"';
	$csv_escaped = "\\";
	$sql_query = "SELECT prn AS 'PRN',
	pname AS 'Name',
	pemail AS 'Email',
	pc_no AS 'Personal Contact No.',
	psc_no AS 'Parents Contact No.', 
	pgender AS 'Gender',
	sgpa AS 'SGPA',
	pclass AS 'Class',
	category AS 'Category',
	date AS 'Date of Application',
	ph AS 'PH',
	jk AS 'J&K',
	def AS 'Defence',
	sumf AS 'Total Back',
	s1_sgpa AS 'SEM-1 CGPA',
	s2_sgpa AS 'SEM-2 CGPA',
	s3_sgpa AS 'SEM-3 CGPA',
	s4_sgpa AS 'SEM-4 CGPA',
	s5_sgpa AS 'SEM-5 CGPA',
	s1_back AS 'SEM-1 BACK',
	s2_back AS 'SEM-2 BACK',
	s3_back AS 'SEM-3 BACK',
	s4_back AS 'SEM-4 BACK',
	s5_back AS 'SEM-5 BACK',
	f_version AS 'Latest Form Version'
	FROM $table";
 
	// Gets the data from the database
	$result = mysqli_query($mysqli,$sql_query) or die(mysqli_error($mysqli));
	$fields_cnt = mysqli_num_fields($result);
 
 
	$schema_insert = '';
 $fields = mysqli_fetch_fields($result); 
	foreach($fields as $fi => $f)
	{
		$l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
			stripslashes($f->name)) . $csv_enclosed;
		$schema_insert .= $l;
		$schema_insert .= $csv_separator;
	} // end for
 
	$out = trim(substr($schema_insert, 0, -1));
	$out .= $csv_terminated;
 
	// Format the data
	while ($row = mysqli_fetch_array($result))
	{
		$schema_insert = '';
		for ($j = 0; $j < $fields_cnt; $j++)
		{
			if ($row[$j] == '0' || $row[$j] != '')
			{
 
				if ($csv_enclosed == '')
				{
					$schema_insert .= $row[$j];
				} else
				{
					$schema_insert .= $csv_enclosed .
					str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
				}
			} else
			{
				$schema_insert .= '';
			}
 
			if ($j < $fields_cnt - 1)
			{
				$schema_insert .= $csv_separator;
			}
		} // end for
 
		$out .= $schema_insert;
		$out .= $csv_terminated;
	} // end while
 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Length: " . strlen($out));
	// Output to browser with appropriate mime type, you choose ;)
	//header("Content-type: text/x-csv");
	//header("Content-type: text/csv");
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filename");
	echo $out;
	exit;
 
}
 
?>
 
