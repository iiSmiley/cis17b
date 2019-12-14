<?php
class Product {
    //put your code here
    private $prod_id;
    private $dept_id;
    private $prod_name;
    private $price;
    private $img_name;
    
    public function set_prod_id($param) {
        $this->prod_id=$param;
    }
    
    public function set_dept_id($param) {
        $this->dept_id=$param;
    }
    
    public function set_prod_name($param) {
        $this->prod_name=$param;
    }
    
    public function set_price($param) {
        $this->price=$param;
    }
    
    public function set_img_name($param) {
        $this->img_name=$param;
    }
    
    public function get_prod_id() {
        return $this->prod_id;
    }
    
    public function get_dept_id() {
        return $this->dept_id;
    }
    
    public function get_prod_name() {
        return $this->prod_name;
    }
    
    public function get_price() {
        return $this->price;
    }
    
    public function get_img_name() {
        return $this->img_name;
    }
    
    public function __construct($prod_id) {
        $this->prod_id=$prod_id;
        $this->dept_id="";
        $this->prod_name="";
        $this->price="";
        $this->img_name="";
        }
}
