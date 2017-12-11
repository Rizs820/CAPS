<?php

    $p_ayear=$_POST['ayear'];
    $p_ses_cat=$_POST['ses_cat'];
    if(file_exists(stream_resolve_include_path($p_ses_cat.".inc.php")))
    	include($p_ses_cat.".inc.php");
    else
    	echo '<h1>Error Occurred</h1><h3>Invalid Operation - ERRCODE - RM0301IN</h3><h3>Reason</h3><ul><li>Either you have refreshed page or clicked back button.</li></ul><br><a href="../" size="5">Click here to go back</a>';
?>
