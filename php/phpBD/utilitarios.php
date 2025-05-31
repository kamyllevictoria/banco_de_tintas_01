<?php
    function gravarImagem($imagem) {
        $pasta = "../img-bd/";
        $nomeImagem = $imagem['name'];
        $novoNome = uniqid();
        $extensao = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));

        move_uploaded_file($imagem['tmp_name'], $pasta . $novoNome . "." . $extensao);

        $caminho = "img-bd/" . $novoNome . "." . $extensao;
        return $caminho;
    }

    function removerImagem($imagem) {
        unlink("../".$imagem);
    }
?>