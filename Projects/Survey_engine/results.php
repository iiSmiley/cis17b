<?php include ('includes/admin_sk_header.html'); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add A Question</title>
</head>
<body>
    <form action="view_survey_results.php" method="post" >
        <p><b>Pick a Survey</b></br> <select name="survey"><option>Select Survey</option>
            <?php 
                require ('mysqli_connect.php');
                
                // Retrieve all the surveys and add to the pull-down menu.
                $q = "SELECT survey_id, survey_title FROM enum_survey ORDER BY survey_title ASC";		
                $r = mysqli_query ($dbc, $q);
                if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
			echo "<option value=\"$row[0]\"";
			// Check for stickyness:
			if (isset($_POST['survey']) && ($_POST['survey'] == $row[0]) ) echo ' selected="selected"';
			echo ">$row[1]</option>\n";
		}
                } else {
                        echo '<option>No Surveys Available!</option>';
                }
                mysqli_close($dbc); // Close the database connection.
            
                
                ?></select>
        </br>       
            <div align="left"><input type="submit" name="submit" value="Submit" /></div>
    </form>
</body>
</html>
<?php 
include ('includes/sk_footer.html');
?>