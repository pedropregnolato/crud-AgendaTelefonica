<?php
require_once('validar_cpf.php');
$nome = filter_input(INPUT_GET, "nome");
$documento = filter_input(INPUT_GET, "documento");
$telefone = filter_input(INPUT_GET, "telefone");

$nome = strtoupper($nome);
$documento = preg_replace("/[^0-9]/", "", $documento);
$telefone = preg_replace("/[^0-9]/", "", $telefone);

$link = mysqli_connect("localhost", "root", "", "agenda_telefonica");

if (!empty($nome) && !empty($documento) && !empty($telefone)) { //assim se tirar o required do html ainda será seguro nao inserindo o dado no banco
    if (strlen($telefone) == 11 && strlen($documento) == 11) {
        if (validaCPF($documento)) {
            $verifica_cpf = mysqli_query($link, "select * from contato where documento = '$documento'");
            if (mysqli_num_rows($verifica_cpf) < 1) {
                $query = mysqli_query($link, "insert into contato values ('', '$nome', '$documento', '$telefone')");
                if ($query) {
                    header("Location: index.php");
                } else {
                    die("Erro: " . mysqli_error($link));
                }
            } else {
                echo "CPF ja cadastrado!";
                die();
            }
        } else {
            echo "digite um cpf valido!";
        }
    }
} else {
    echo ("Por favor insira nome, documento e telefone.");
    die();
}
