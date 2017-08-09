<!DOCTYPE html>
<!--
Formulário de teste para X3 sistemas
@Autor: Carlos Henrique
@E-mail: henriquecarlos9@hotmail.com
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste X3 sistemas</title>
        <!--Tag meta para que o navegador saiba que esta página é otimizada para dispositivos moveis-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Importando Materialize css e Material icons do google -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" rel="stylesheet" media="screen">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" media="screen">
    </head>
    <body class="grey">
        <!--Div container do materialize, usada para conteudos com margem-->
        <div class="container white">
            <!--Div row do materialize, define que esta será uma linha no sistema de grids do Materialize-->
            <div class="row">
                <!--Div col do materialize, define que esta será uma coluna de maior tamanho dentro da linha
                em resolução de small devices(col s1 a s12) no sistema de grids do Materialize-->
                <div class="col s12 center">
                    <!--Link com as class btn waves-effect waves-light blue que definem a cor eo estilo do link como
                    um botão do materialize-->
                    <a href="index.php?p=listar" class="btn waves-effect waves-light blue">Listar</a>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <a href="index.php?p=incluir" class="btn waves-effect waves-light teal">Incluir</a>
                </div>
            </div>
            
                <?php
                //Chamando as classes UsuarioDAO e UsuarioDTO
                require_once 'Model/DAO/UsuarioDAO.php';
                require_once 'Model/UsuarioDTO.php';
                
                //Verificando se na url foi solicitado o recurso de listar
                if(isset($_GET['p']) && $_GET['p']=='listar'){
                    //Cso sim instancia um objeto da classe UsuarioDAO
                    $usuarioDAO = new UsuarioDAO();
                    //Executa o metodo de listar usuario e grava o array na variável usuarios
                    $usuarios = $usuarioDAO->listarUsuario();
                    //Laço que passa pelo array
                    foreach ($usuarios as $usuario){
                        ?>
            <div class="row">
                <!--Div com a class offset-m3 que define afastamento de três colunas na div-->
                <div class="col s12 m6 offset-m3">
                    <!--Tag img com a classe responsive-img define que a imagem se adequará a resolução do disposítivo-->
                    <img src="fotos/<?php echo $usuario['foto']; ?>" class="responsive-img"/>
                </div>
            </div>
            <div class="row">
                <!--Div com a class m6 define que quando a resolução do disposítivo for média essa div terá tamanho de 6 colunas
                diferente da resolução s12 que define em resoluções small o tamanho 12-->
                <div class="col s12 m6">
                    Nome: <?php echo $usuario['nome']; ?>
                </div>
                <div class="col s12 m6">
                    Endereço: <?php echo $usuario['endereco']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    Cep: <?php echo $usuario['cep']; ?>
                </div>
                <div class="col s12 m6">
                    Telefone: <?php echo $usuario['telefone']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    login: <?php echo $usuario['login']; ?>
                </div>
                <div class="col s12 m6">
                    Senha: <?php echo $usuario['senha']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <a href="index.php?p=alterar&l=<?php echo $usuario['login']; ?>" class="btn waves-effect waves-light yellow">Alterar</a>
                </div>
                <div class="col s6">
                    <a href="Control/ExcluirUsuario.php?login=<?php echo $usuario['login']; ?>" class="btn waves-effect waves-light red">Excluir</a>
                </div>
            </div>
                <?php
                    }
                }
                ?>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <?php
                    //Variável usuario sendo iniciada com um array de chaves com valor vazio
                    $usuario = array('nome'=>'','endereco'=>'','cep'=>'','telefone'=>'','login'=>'','senha'=>'');
                    //Variável action que define o caminho do form sendo iniciada com IncluirUsuario
                    $action = 'IncluirUsuario';
                    //Verificando se a url contem a pagina desejada
                    if(isset($_GET['p'])){
                        //Caso sim verifica as paginas possíveis
                        switch ($_GET['p']){
                            //Caso seja incluir troca o valor da action
                            case 'incluir':
                                $action = 'IncluirUsuario';
                                break;
                            //Caso seja alterar
                            case 'alterar':
                                //Variável action recebe o valor AlterarUsuario
                                $action = 'AlterarUsuario';
                                //Instanciando objeto da classe UsuarioDAO
                                $usuarioDAO = new UsuarioDAO();
                                //Verificando se a url possui o recurso de login
                                if(isset($_GET['l'])){
                                    //Caso sim instancia objeto da classe UsuarioDTO
                                    $usuarioDTO = new UsuarioDTO();
                                    //Setando atributo login da classe com o login recebido pela url
                                    $usuarioDTO->setLogin($_GET['l']);
                                    //Variável usuario recebe o array com o resultado da busca por login
                                    $usuario = $usuarioDAO->pesquisarUsuarioByLogin($usuarioDTO);
                                }
                                break;
                            //Caso nenhum dos anteriores aconteça
                            default :
                                
                                $action = 'IncluirUsuario';
                                break;
                        }
                    }
                    ?>
                    <!--Formulário com atributo enctype="multipart/form-data" que define para o envio do formulário ser em muitas partes possibilitando
                    assim um volume de dados maior como o de uma foto-->
                    <form action="Control/<?php echo $action; ?>.php" method="post" enctype="multipart/form-data">
                        <!--Div com a class input-field que define a personalização do materialize as labels,
                        inputs e buttons dentro dessa div-->
                        <div class="input-field">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required id="nome"/>
                        </div>
                        <div class="input-field">
                            <label for="end">Endereco</label>
                            <input type="text" name="endereco" value="<?php echo $usuario['endereco']; ?>" required id="end"/>
                        </div>
                        <div class="input-field">
                            <label for="cep">Cep</label>
                            <input type="number" name="cep" value="<?php echo $usuario['cep']; ?>" required id="cep"/>
                        </div>
                        <div class="input-field">
                            <label for="telefone">Telefone</label>
                            <input type="number" name="telefone" value="<?php echo $usuario['telefone']; ?>" required id="Telefone"/>
                        </div>
                        <div class="input-field">
                            <label for="login">Login</label>
                            <input type="text" name="login" value="<?php echo $usuario['login']; ?>" required id="login"/>
                        </div>
                        <div class="input-field">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" required id="senha"/>
                        </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Foto</span>
                                <input type="file" required name="foto">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class="input-field">
                            <button type="submit" class="btn waves-effect waves-light orange"><?php echo $action; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Importando jQuery e materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    </body>
</html>
