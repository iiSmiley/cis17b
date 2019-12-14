<?php
class Inventory {
    //put your code here
    private $products=[];
    private $depts=[];
    
    public function push_prod($param) {
        array_push($this->products, $param);
    }
    
    public function push_dept($param) {
        array_push($this->depts, $param);
    }
    
    public function get_prod($param) {
        return $this->products[$param];
    }
    
    public function get_dept($param) {
        return $this->depts[$param];
    }
    
    public function display_prod() {
        foreach($this->products as $prod) {
            echo "<p>$prod<p></br>";
        }
    }
    
    public function add_product($dbc) {
        
        
    }
    
    public function add_dept($dept, $dbc) {
        $q = "INSERT INTO entity_dept (dept_name) VALUES ('$dept')";
            $r = mysqli_query($dbc, $q);
            if ($r) { // If it ran OK.
			// Print a message:
			echo '<h1>You have succefully added a new department to your store.</h1>';
            } 
            else {  // If it did not run OK.
			
                    // Public message:
                    echo '<h1>System Error</h1>
                    <p class="error">You could not add a department due to a system error. Contact your trusty technical support.</p>'; 
                    // Debugging message:
                    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
            } // End of if ($r) IF.
    }
    
    public function add_prod($dept, $pn, $p, $d, $i, $temp, $dbc) {
        // Add the produc to the database:
        $q = "INSERT INTO entity_prod (dept_id, prod_name, price, description, img_name) VALUES ('$dept', '$pn', '$p', '$d', '$i')";
	$r = @mysqli_query($dbc, $q);
	// Check the results...
        if ($r) {

            // Print a message:
            echo '<p>The product has been added.</p>';
	
            // Rename the image:
            $id = mysqli_insert_id($dbc); // Get the print ID.
            rename ($temp, "../../uploads/$id");                     
	
	} 
        else { // Error!
			echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
	}
    }
    
    public function admin_browse($dbc) {
        
    }
    
    public function user_browse($dbc) {
        
    }
    
    public function __construct() {
        $this->products = array();
        $this->depts = array();
    }
    
    public function getDB() {
        require_once('../../mysqli_connect.php');
        return $dbc;
    }
}
