<?php 

class descricao{

private $id_descricao;
private $nome;
private $descricao;


public function __construct() {
    if (func_num_args() != 0) {
        $atributos = func_get_args()[0];
        foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

     public function getId_descricao(){
         return $this->id_descricao;
     }

     function setId_descricao($id_descricao){
          $this->id_descricao = $id_descricao;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getDescricao(){
         return $this->descricao;
     }

     function setDescricao($descricao){
          $this->descricao = $descricao;
     }

}