<?php
class Order {
    private $prod_id;
    private $qnty;
    
    public function set_prod($prod_id) {
        $this->prod_id=$prod_id;
    }
    
    public function set_qnty($qnty) {
        $this->qnty = $qnty;
    }
    
    public function get_prod() {
        return $this->prod_id;
    }
    
    public function functionName() {
        return $this->qnty;
    }
    
    public function view_orders($dbc) {
        
    }
    
    public function confirm_order($dbc) {
        
    }
    
    public function __construct($prod_id, $qnty) {
        $this->prod_id=$prod_id;
        $this->qnty = $qnty;
    }
    
    public function getDB() {
        require_once ('../../mysqli_connect.php');
        return $dbc;
    }
}
