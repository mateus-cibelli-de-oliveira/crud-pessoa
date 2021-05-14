<?php

Class pessoa
{ 

    private $pdo;
    public function __construct($dbname, $host, $user, $senha)
    { try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (PDOException $e) {
           echo "Errinho no Banco de Dados: ".$e->getMessage();
           exit();
        }
        catch (Exception $e) {
            echo "Erro genérico de farmácia Popular: ".$e->getMessage();
            exit();
        }
    }
//Para Buscar e Jogar no Canto Direito. A sua Direita!

       public function buscarDados()
       {   
           $res = array();
           $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
           $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
           return $res;
       }
       public function cadastrarPessoa($nome,$telefone,$email)
       {
          $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email=:e");
          $cmd->bindValue(":e",$email);
          $cmd->execute();
          if($cmd->rowCount() > 0)
          {
              return false;
          } 
          else 
          {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:n, :t, :e)");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":t",$telefone);
            $cmd->bindValue(":e",$email);
            $cmd->execute();
          }
       }

       public function excluirPessoa($id)
       {
         $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
         $cmd->bindValue(":id",$id);
         $cmd->execute();
       }
}




?>