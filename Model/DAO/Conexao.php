<?php
//Classe abastrata de conexão com o banco de dados
abstract class Conexao{
    function __construct() {
        
    }
    //Metodo que instancia a conexão com o banco de dados
    static function getInstance(){
        try {
            //Instanciando biblioteca PDO para conexão com o banco de dados
            $pdo = new PDO("mysql:host=localhost;dbname=x3Sistemas", "root", "");
            return $pdo;
        } catch (PDOException $exc) {
            echo 'Connection failed: ' . $exc->getMessage();          
            die;
        }
    }
}