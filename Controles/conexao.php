<?php
class conexao{
    private $con;
    public function __construct() {
        $this->con = mysqli_connect("200.132.17.18", "dcastro", "Class.7ufo", "oficina");
    }
    public function getCon(){
        return $this->con;
    }
}
