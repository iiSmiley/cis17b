<?php

function update_scores($user_id, $time) {
    //To connenct to database
    require ('mysqli_connect.php');
    //Handling the form on the page:
    
            //Update the scores list
            $q = "INSERT INTO scores (user_id, time) VALUES ('$user_id','$time')";
            $r = mysqli_query($dbc, $q);
            //Show me errors, if any.
            if(!$r) {
                echo mysqli_error($dbc);
            }
        }
            
        
    
        mysqli_close($dbc);
?>