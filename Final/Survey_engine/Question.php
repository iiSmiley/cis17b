<?php

class Question {
    private $cat;
    private $qstn;
    private $ans=[];
    
    public function set_cat($cat) {
        $this->cat = $cat;
    }
    
    public function set_qstn($qstn) {
        $this->qstn = $qstn;
    }
    
    public function add_ans($ans) {
        array_push($this->ans, $ans);
    }
    
    public function get_cat() {
        return $this->cat;
    }
    
    public function get_qstn() {
        return $this->qstn;
    }
    
    public function get_ans($number) {
        if($number>=0 && $number <= count($this->ans)) {
            return $this->ans[$number];
        }
        else {
            echo "This is not an answer!";
        }
    }
    
    public function display() {
        //echo "<p>Category: $this->cat<p></br>";
        echo "<p>$this->qstn</p></br>";
        foreach($this->ans as $ans){
            echo "<input type='radio' name='$this->cat' value='$ans'> $ans<br>";
        }
    }
    
    public function getDB() {
        require_once('mysqli_connect.php');
        return $dbc;
    }
    
    public function insert_qstn($dbc) {
        $q = "INSERT INTO enum_qstn (cat,qstn) VALUES ('$this->cat','$this->qstn')";
        $r = @mysqli_query($dbc, $q);
        $qstn_id = @mysqli_insert_id($dbc);
        //Check if it went to DB
        if($r) {
            echo "<p>The Survey has been successfully initiated in the data bases.</P>";
        }
        //ERROR!
        else{
            echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
        }
        return $qstn_id;
    }
    
     public function insert_into_survey($sur_id, $qstn_id, $ans, $dbc){
        $q_ans = "INSERT INTO enum_ans (answer) VALUES ('$ans')";
        $r1 = @mysqli_query($dbc, $q_ans1);
        $ans_id = @mysqli_insert_id($dbc);
        //Updating the survey table
        $q2 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans_id')";
        $r2 = @mysqli_query($dbc, $q2);  
        
    }

    public function insert_ans($ans, $dbc) {
        $q = "INSERT INTO enum_ans (answer) VALUES ('$ans')";
        $r = @mysqli_query($dbc, $q);
    }
    public function __construct($qstn, $cat) {
        $this->cat=$cat;
        $this->qstn=$qstn;
    }
}
