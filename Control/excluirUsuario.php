<?php

require_once '../Model/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';

//Excluir usuario

//Login vindo da url
$login = $_GET['login'];

//Instanciando metodo da classe UsuarioDTO
$usuarioDTO = new UsuarioDTO();

//Setando atributo login da classe UsuarioDTO
$usuarioDTO->setLogin($login);

//Instanciando metodo da classe UsuarioDAO
$usuarioDAO = new UsuarioDAO();

//Executando metodo de Excluir usuário do banco de dados
if($usuarioDAO->excluirUsuario($usuarioDTO)){
    //Caso a exclusão ocorra com sucesso
    header('Location: ../index.php');
} else {
    //Caso a exclusão não seja completada
    echo "Erro ao Excluir do banco de dados.";
}
