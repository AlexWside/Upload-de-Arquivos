<?php

require_once('controler/conexao.php');
class Arquivo{
    private $nome;
    private $diretorio;
    private $conn;
    public function __construct ($conn){
       $this ->conn = $conn;// passagem da conexão pelo parametro do contrutor 
   }// fim construtor 
   
   public function adicionar_imagem($nome,$diretorio){
       $this ->nome = $nome;
       $this ->diretorio = $diretorio;
       $result_usuario = "INSERT INTO arquivos (nome,diretorio) VALUES ('$nome','$diretorio')";
       mysqli_query($this->conn,$result_usuario);
   
      header('Location:galeria.php');
   }// fim funçõo adicionar registro
   public function buscar_imagem(){
       
       $result_usuario = "SELECT * FROM arquivos ";
       $result_bd = $this->conn->query($result_usuario);
       $lista = mysqli_fetch_all($result_bd);
       return $lista;
      //header('Location:novo_registro.php');
   }// fim funçõo Buscar Todos
   }//fim da classe

   $arquivo = new Arquivo($conn);

?>