<?php
class conexao{
    private $con;
    public function __construct() {
        $this->con = mysqli_connect("localhost", "root", "", "oficina");
    }
    public function getCon(){
        return $this->con;
    }
}
