<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("model/arquivo_dao.php");
    $Lista = $arquivo->buscar_imagem();
    foreach($Lista as $item){
        ?>
    <img src="<?=$item[2]?>" alt="img">
<?php
    }
    ?>
</body>
</html>