<?php
    class conexaoPDO {
               
        public function getConexao(){
         
           $con = new PDO('mysql:host=localhost;dbname=oficina','root','');
            return $con;
          
        }
    }