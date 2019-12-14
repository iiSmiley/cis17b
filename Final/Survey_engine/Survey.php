<?php
session_start();

class Survey {
    private $title;
    private $desc;
    private $qstns=[];
    
    public function set_title($title) {
        $this->title = $title;
    }
    
    public function set_desc($desc) {
        $this->desc = $desc;
    }
    
    public function add_qstn($qstn) {
        array_push($this->qstns, $qstns);
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function get_desc() {
        return $this->desc;
    }
    
    public function get_qstn($number) {
        if($number>=0 && $number <= count($this->qstns)) {
            return $this->qstns[$number];
        }
        else {
            echo "This is not a question!";
        }
    }
    
    public function display() {
        //echo "<p>Category: $this->cat<p></br>";
        //echo "<p>$this->qstn</p></br>";
        foreach($this->qstns as $qstn){
            $q = new Question ($qstn);
            $q->display();
           }
    }
    public function create_survey($dbc) {
        $q = "INSERT INTO enum_survey (survey_title, survey_desc) VALUES ('$this->title','$this->desc')";
        $r = @mysqli_query($dbc, $q);
        //Check if it went to DB
        if($r) {
            echo "<p>The Survey has been successfully initiated in the data bases.</P>";
        }
        //ERROR!
        else{
            echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
        }
        
    
        mysqli_close($dbc);
    }
    
    public function take_survey($dbc, $sur_id) {
         $q = "SELECT `survey`.`record_id`, `enum_survey`.`survey_title`, `enum_qstn`.`qstn`, `enum_ans`.`ans_id`, `enum_ans`.`answer` "
           . "FROM `survey_engine`.`survey` AS `survey`, `survey_engine`.`enum_qstn` AS `enum_qstn`, `survey_engine`.`enum_survey` AS `enum_survey`, `survey_engine`.`enum_ans` AS `enum_ans` "
           . "WHERE `survey`.`qstn_id` = `enum_qstn`.`qstn_id` AND `survey`.`survey_id` = `enum_survey`.`survey_id` AND `survey`.`ans_id` = `enum_ans`.`ans_id` AND enum_survey.survey_id =$sur_id";
        $r = mysqli_query($dbc, $q);
        if (!$r) {
            //If there is an error, display the error string (Life Line!)
            echo mysqli_error($dbc);
            exit();
        }
        //If there is a query of at least on record 
        if(mysqli_num_rows($r)>0) {
            
            $temp_title = $temp_qstn ="";   //To avoid displaying the title ans the same question multiple times
            $temp_first_qstn=true;          //To properly set the fields and the legends
            $temp_iter=0;                   //To be used to update the number of responses
            while($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                //echo "<p>$row[0] $row[1] $row[2] $row[3] $row[4]</p>";
                if($temp_title != $row[1]) {
                    $temp_title = $row[1];
                    echo "<h1>$temp_title</h1></br>";
                    echo "<form action='update_response.php' method='post'>";
                    
                }
                if($temp_qstn != $row[2]) {
                    $temp_qstn = $row[2];
                    if($temp_first_qstn) {
                        echo "<fieldset>";
                        echo "<legend>$temp_qstn</legend>";
                        $temp_first_qstn = false;
                        $temp_iter++;
                    }
                    else {
                        //Close previus field
                        echo "</fieldset>";
                        //Open new field
                        echo "<fieldset>";
                        //Display Qstn
                        echo "<legend>$temp_qstn</legend>";
                        $temp_iter++;
                    }    
                }
                //Display Radio buttons for different answers with their unique values
                echo "<input type='radio' name='response$temp_iter' value='$row[3]'/> $row[4] </br>";
                $_SESSION["iter"] = $temp_iter;
            }
            //Close the last form
            echo "</fieldset> </br>";
            echo "<div align='left'><input type='submit' name='submit' value='Submit' /></div>";
            echo "</form>";
        }
    }
    
    public function update_results($ans_id, $dbc) {
        //Obtain Reposne iterartion
    
            //Obtain current value of responses
            $q = "SELECT response FROM enum_ans WHERE ans_id=$ans_id";
            $r = mysqli_query($dbc, $q);
            if (mysqli_num_rows($r) > 0) {
                while($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                    //Update current value of response by adding 1 to the chosen answer.
                    $update= $row[0]+1;
                    $q2 = "UPDATE enum_ans SET response='$update' WHERE ans_id=$ans_id";
                    $r2 = mysqli_query($dbc, $q2);
                }
            }
            //Show me errors, if any.
            if(!$r) {
                echo mysqli_error($dbc);
            }
            
    }
        
    public function show_results($sur_id, $dbc) {
        //Get the damn query
        $q = "SELECT `survey`.`record_id`, `enum_survey`.`survey_title`, `enum_qstn`.`qstn`, `enum_ans`.`ans_id`, `enum_ans`.`answer`, `enum_ans`.`response` "
                . "FROM `survey_engine`.`survey` AS `survey`, `survey_engine`.`enum_qstn` AS `enum_qstn`, `survey_engine`.`enum_survey` AS `enum_survey`, `survey_engine`.`enum_ans` AS `enum_ans` "
                . "WHERE `survey`.`qstn_id` = `enum_qstn`.`qstn_id` AND `survey`.`survey_id` = `enum_survey`.`survey_id` AND `survey`.`ans_id` = `enum_ans`.`ans_id`"
                . "AND enum_survey.survey_id =$sur_id";
        $r = mysqli_query($dbc, $q);
        if (!$r) {
            //If there is an error, display the error string (Life Line!)
            echo mysqli_error($dbc);
            exit();
        }
        //If there is a query of at least on record 
        if(mysqli_num_rows($r)>0) {
            
            $temp_title = $temp_qstn ="";   //To avoid displaying the title ans the same question multiple times
            $temp_first_qstn=true;          //To properly set the fields and the legends
            $temp_iter=0;                   //To be used to update the number of responses
            while($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                //echo "<p>$row[0] $row[1] $row[2] $row[3] $row[4]</p>";
                if($temp_title != $row[1]) {
                    $temp_title = $row[1];
                    echo "<h1>$temp_title</h1></br>";
                }
                if($temp_qstn != $row[2]) {
                    $temp_qstn = $row[2];
                    if($temp_first_qstn) {
                        echo "<fieldset>";
                        echo "<legend>$temp_qstn</legend>";
                        $temp_first_qstn = false;
                        $temp_iter++;
                    }
                    else {
                        //Close previus field
                        echo "</fieldset>";
                        //Open new field
                        echo "<fieldset>";
                        //Display Qstn
                        echo "<legend>$temp_qstn</legend>";
                    }    
                }
                //Display Radio buttons for different answers with their unique values
                echo "$row[4] ($row[5] Entries)</br>";
                $_SESSION["iter"] = $temp_iter; //iter to traverse through survey
            }
            //Close the last form
            echo "</fieldset> </br>";
        }
    }
    public function getDB() {
        require('mysqli_connect.php');
        return $dbc;
    }
    
    public function __construct($title, $desc) {
        $this->title=$title;
        $this->desc=$desc;
    }
}
