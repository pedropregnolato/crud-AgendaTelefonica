<?php

    $id = filter_input(INPUT_GET, 'id');

    $link = mysqli_connect("localhost", "root", "", "agenda_telefonica");


        if($link) {
            $query = mysqli_query($link, "delete from contato where id='$id';");
                if($query){
                    header("Location: index.php");
                }else{
                    die("Erro: ". mysqli_error($link));
                }
        }else{
            die();
        }
