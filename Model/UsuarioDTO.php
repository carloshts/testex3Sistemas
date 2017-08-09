<?php

class UsuarioDTO {
    //Atributos da classe UsuarioDTO nome, endereco, telefone ,cep, login e senha, com upload de foto
    private $nome;
    private $endereco;
    private $telefone;
    private $cep;
    private $login;
    private $senha;
    private $foto;
    
    //Metodos getters e setters da classe
    function getNome() {
        return $this->nome;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCep() {
        return $this->cep;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getFoto() {
        return $this->foto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }



}
