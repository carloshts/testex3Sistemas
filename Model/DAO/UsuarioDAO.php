<?php
//Chamando classe Conexao
require_once 'Conexao.php';

class UsuarioDAO {
    //Metodo de incluir usuario
    public function incluirUsuario(UsuarioDTO $usuarioDTO){
        try {
            //Realizando conexão com o banco de dados pela classe Conexao
            $pdo = Conexao::getInstance();
            //Comando em sql
            $sql = "INSERT INTO usuario (nome,endereco,telefone,cep,login,senha,foto)VALUES(?,?,?,?,?,?,?)";
            
            //Preparando sql para receber os binds
            $stmt = $pdo->prepare($sql);
            
            //Binds que enviam os dados por parametro de ordem
            $stmt->bindValue(1, $usuarioDTO->getNome());
            $stmt->bindValue(2, $usuarioDTO->getEndereco());
            $stmt->bindValue(3, $usuarioDTO->getTelefone());
            $stmt->bindValue(4, $usuarioDTO->getCep());
            $stmt->bindValue(5, $usuarioDTO->getLogin());
            $stmt->bindValue(6, $usuarioDTO->getSenha());
            $stmt->bindValue(7, $usuarioDTO->getFoto());
            
            //Comando de execução do sql
            return $stmt->execute();
        } catch (PDOException $exc) {
            //Exibição de erro
            echo 'Erro mysql:'.$exc->getMessage();
        }
    }
    //Metodo de listar usuario
    public function listarUsuario(){
        //
        try {
            //Realizando conexão com o banco de dados pela classe Conexao    
            $pdo = Conexao::getInstance();
            //Comando em sql
            $sql = "SELECT * FROM usuario";
            //Preparando sql para execução
            $stmt = $pdo->prepare($sql);
            //Comando de execução do sql
            $stmt->execute();
            //Recebendo resultado da consulta e gravando em array na variável usuarios
            $usuarios =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retornando variável usuarios
            return $usuarios;
        } catch (PDOException $exc) {
            //Exibição de erro
            echo 'Erro mysql:'.$exc->getMessage();
        }
    }
    public function pesquisarUsuarioByLogin(UsuarioDTO $usuarioDTO){
        try {
            //Realizando conexão com o banco de dados pela classe Conexao   
            $pdo = Conexao::getInstance();
            //Comando em sql
            $sql = "SELECT * FROM usuario WHERE login=?";
            //Preparando sql para receber os binds
            $stmt = $pdo->prepare($sql);
            
            //Binds que enviam os dados por parametro de ordem
            $stmt->bindValue(1, $usuarioDTO->getLogin());
            //Comando de execução do sql
            $stmt->execute();
            //Recebendo resultado da consulta e gravando em array na variável usuario
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //Retornando variável usuario
            return $usuario;
        } catch (PDOException $exc) {
            //Exibição de erro
            echo 'Erro mysql:'.$exc->getMessage();
        }
    }
    //Metodo de alterar usuario no banco de dados
    public function alterarUsuario(UsuarioDTO $usuarioDTO){
        try {
            //Realizando conexão com o banco de dados pela classe Conexao   
            $pdo = Conexao::getInstance();
            //Comando em sql
            $sql = "UPDATE usuario SET nome=?,endereco=?,telefone=?,cep=?,senha=?,foto=? WHERE login=?";
            //Preparando sql para receber os binds
            $stmt = $pdo->prepare($sql);
            
            //Binds que enviam os dados por parametro de ordem
            $stmt->bindValue(1, $usuarioDTO->getNome());
            $stmt->bindValue(2, $usuarioDTO->getEndereco());
            $stmt->bindValue(3, $usuarioDTO->getTelefone());
            $stmt->bindValue(4, $usuarioDTO->getCep());
            
            $stmt->bindValue(5, $usuarioDTO->getSenha());
            $stmt->bindValue(6, $usuarioDTO->getFoto());
            $stmt->bindValue(7, $usuarioDTO->getLogin());
            //Comando de execução do sql
            return $stmt->execute();
            
        } catch (PDOException $exc) {
            //Exibição de erro
            echo 'Erro mysql:'.$exc->getMessage();
        }
    }
    //Metodo de excluir usuário no banco de dados
    public function excluirUsuario(UsuarioDTO $usuarioDTO){
        try {
            //Realizando conexão com o banco de dados pela classe Conexao   
            $pdo = Conexao::getInstance();
            //Comando em sql
            $sql = "DELETE FROM usuario WHERE login=?";
            //Preparando sql para receber os binds
            $stmt = $pdo->prepare($sql);
            
            //Binds que enviam os dados por parametro de ordem            
            $stmt->bindValue(1, $usuarioDTO->getLogin());
            //Comando de execução do sql
            return $stmt->execute();
        } catch (PDOException $exc) {
            //Exibição de erro
            echo 'Erro mysql:'.$exc->getMessage();
        }
    }
}
