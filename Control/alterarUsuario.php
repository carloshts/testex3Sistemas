<?php

require_once '../Model/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';

//Alterar usuario

//Definindo zona de tempo utilizada no sistema
date_default_timezone_set('America/Sao_Paulo');

//Campos recebidos do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];
$login = $_POST['login'];

//Encriptação do campo senha
$senha = password_hash($senha['senha'],PASSWORD_DEFAULT);

//Instanciando objeto da classe UsuarioDTO
$usuarioDTO = new UsuarioDTO();

//Setando atributos da classe
$usuarioDTO->setNome($nome);
$usuarioDTO->setEndereco($endereco);
$usuarioDTO->setCep($cep);
$usuarioDTO->setTelefone($telefone);
$usuarioDTO->setLogin($login);
$usuarioDTO->setSenha($senha);

//Gravando tipo do arquivo enviado na variável tipoArquivo
$tipoArquivo = explode("/", $_FILES['foto']['type']);

//definindo formato da data dia-mês-ano_hora.minuto.segundo
$dataAtual = date('d-m-Y_h.i.s');

//definindo nome da foto a ser salva
$foto = 'foto_'.$dataAtual.'.'.$tipoArquivo[1];

//Setando nome da foto no atributo foto
$usuarioDTO->setFoto($foto);

//Definindo destino onde a foto será salva
$destino = '../fotos/'.$foto;

//Executando upload de foto
if(move_uploaded_file($_FILES['foto']['tmp_name'], $destino)){
    //Caso o upload ocorra com sucesso
    
    //Instanciando objeto da classe UsuarioDAO
    $usuarioDAO = new UsuarioDAO();
    
    //Executando metodo de alteração de usuario no banco de dados
    if($usuarioDAO->alterarUsuario($usuarioDTO)){
        //Caso a inclusão ocorra com sucesso
        header('Location: ../index.php');
    } else {
        //Caso a alteração não seja completada
        echo "Erro ao Alterar no banco de dados.";
        
    }
} else {
    //Caso o upload não seja completado
    echo "Erro ao enviar foto";
}

