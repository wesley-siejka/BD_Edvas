<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c";
$username = "root";
$password = "";

$conexao = mysqli_connect(
    $servername, $username, 
    $password,$database
);

if (!$conexao){
    die("Falha na conexão".mysqli_connect_error());
}
// echo "conectado com sucesso";
    $id = $_POST["ID"];
    $nome = $_POST["nome"];
    $CPF = $_POST["CPF"];
    $botao = $_POST["botao"];

// echo $id." ".$nome." ".$CPF." ".$botao;

$aql = "INSERT INTO funcionarios (id,nome,cpf) VALUES ('', '$nome', $CPF)";

if($botao == "Cadastrar"){
    if(mysql_query($conexao, $sql)){
        echo "Cadastrado com sucesso"
    }else{
        echo 'Falhas ao cadastrar'
    }
}
 ?>
    <html>
    <body>
        <form name ="func" method = "POST">
            <label>ID</label><input type = "text"name ="ID"/><br />
            <label>Nome</label><input type = "text"name = "nome"/><br />
            <label>CPF</label><input type = "text" name = "CPF"/><br />
            <input type = "submit" name = "botao" value = "Cadastrar" />
            <input type = "reset" name = "botao" value = "cancelar" />
        </form>
    </body>


    </html>