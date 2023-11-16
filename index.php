<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c"; //func2c ou func2d
$username = "root";
$password = "";

$conexao = mysqli_connect(
    $servername, $username, 
    $password,$database
);

if (!$conexao){
    die("Falha na conexão".mysqli_connect_error());
}
//echo "conectado com sucesso";

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$botao = $_POST["botao"];
$pesquisa = $_POST["pesquisa"];

if(empty($botao)){

}else if($botao == "Cadastrar"){
    $sql = "INSERT INTO funcionarios 
    (id, nome, cpf) VALUES('','$nome', '$cpf')";
}else if($botao == "Excluir"){
    $sql = "DELETE FROM funcionarios WHERE id = '$id'";
}else if($botao == "Pesquisar"){
    $sql_mostra_cad = "SELECT * FROM funcionarios WHERE nome like '%$pesquisa%'";
}else if($botao == "Alterar"){
    $sql = "UPDATE funcionarios SET nome = '$nome', cpf = '$cpf' WHERE id = '$id'";
}

if(!empty($sql)){
    if(mysqli_query($conexao, $sql)){
        echo "Operação realizada com sucesso";
    }else{
        echo "Ocorreu um erro na operação"; 
        echo mysqli_error($conexao);
    }
}

$selecionado = $_GET["id"];

if(!empty($selecionado)){
    $sql_selecionado = "SELECT * FROM funcionarios WHERE id = $selecionado";

    $resultado = mysqli_query($conexao, $sql_selecionado);

    while($linha = mysqli_fetch_assoc($resultado)){
        $id = $linha["id"];
        $nome = $linha["nome"];
        $cpf = $linha["cpf"];
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width">
        <title>Jorges Armazenamento</title>
        
		<link rel="stylesheet" href="style.css">
    </head>
    <body>
    <form name = "func" method = "post" >
        <label>ID</label>
        <input type ="text" name = "idi" value="<?php echo $id;?>"disabled/><br />
        <input type ="hidden" name = "id" value="<?php echo $id;?>"/>
        <label>Nome</label>
        <input type ="text" name = "nome" value="<?php echo $nome;?>"/><br />
        <label>CPF</label>
        <input type ="text" name = "cpf" value="<?php echo $cpf;?>"/><br />
        <input class="botao" type ="submit" name = "botao" value = "Cadastrar" />
        <input class="botao" type ="submit" name = "botao" value = "Excluir" />
        <br/>
        <input type ="text" name = "pesquisa" />
        <input class="botao" type ="submit" name ="botao" value = "Pesquisar" />
        <input class="botao" type ="submit" name ="botao" value = "Alterar" />
    </form>

    <table>
        <tr>
            <td>-</td>
            <td>ID</td>
            <td>Nome</td>
            <td>CPF</td>
        </tr>

        <?php
        if(empty($pesquisa)){
            $sql_mostra_cad = "SELECT * FROM funcionarios ORDER BY id desc limit 0,10";
        }

        $resultado = mysqli_query($conexao, $sql_mostra_cad);

        while($linha = mysqli_fetch_assoc($resultado)){
            echo " 
            <tr class = 'tab-selecionar'>
                <td><a class = 'selecionar' href='?id=".$linha["id"]."'>Selecionar</a></td>
                <td>".$linha["id"]."</td>
                <td>".$linha["nome"]."</td>
                <td>".$linha["cpf"]."</td>
            </tr>";
        }

 

        ?>

    </table>

    </body>
</html>