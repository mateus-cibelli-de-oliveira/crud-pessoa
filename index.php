<?php

require_once 'classe-pessoa.php';
$p = new Pessoa("crudpdo","localhost","root","");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutura</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<?php
  if(isset($_POST['nome']))
  {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    if (!empty($nome) && !empty($telefone) && !empty($email))
       if (!$p->cadastrarPessoa($nome,$telefone,$email))
       {
         echo '<div class="echo">E-mail já está casdastrado!</div>';
       }
  }
    else 
    {
       echo '<div class="echo">Preencha todos os campos</div>';
    }


?>

    <section id="esquerda">
       <form method="POST">
       <h1>CADASTRAR PESSOA</h1>
       <label for="nome">Nome:</label>
       <input type="text" name="nome" id="nome"></input>
       <label for="telefone">Telefone:</label>
       <input type="text" name="telefone" id="telefone"></input>
       <label for="email">E-mail:</label>
       <input type="email" name="email" id="email"></input>
       <input type="submit" value="Cadastrar">
       </form>
    </section>

    <section id="direita">
 <table>
 <tr id="titulo">
   <td>NOME</td>
   <td>TELEFONE</td>
   <td colspan="2">E-MAIL</td>
 </tr>
<?php
$dados = $p->buscarDados();
if (count($dados) > 0)
{
for ($i=0; $i < count($dados); $i++) 
{
  echo "<tr>";
    foreach ($dados[$i] as $k => $v) 
    {
       if ($k != "id")
       {
         echo "<td>".$v."</td>";
       }
    }
    ?>
    <td>
    <a href="">Editar</a>
    <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
    </td>
    <?php
  echo "<tr>";
  }
}
else {
  echo '<div class="echo">Ainda não há pessoas Cadastradas!</div>';
}
?>
    </table>
    </section>
</body>
</html>

<?php
  if(isset($_GET['id']))
  {
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header("location: index.php");
  }
?>