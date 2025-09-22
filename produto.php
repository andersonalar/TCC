<?php
session_start();

include_once 'produtos.php';
include_once 'Carrinho.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div id="vitrine">

        <?php
        foreach ($produtos as $key => $value) {
        ?>

            <div class="box">
                <div class="img"><img src="img/<?= $value['img'] ?>" alt="" width="100%"></div>
                <br><br>
                <div><?= $value['prod'] ?></div>
                <div><?= $value['valor'] ?></div>
                <div><a href="?id=<?= $key ?>">Comprar</a></div>
            </div>

        <?php
        }
        ?>

    </div>

    <hr>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    $carrinho = new Carrinho($produtos[$id]['prod'], $produtos[$id]['valor'], $id);
    $carrinho->getCarrinho();

    // unset($_SESSION['carrinho']);   
    ?>

   <center> <a href="index.html">pagina inicial</a></center>

</body>

</html>