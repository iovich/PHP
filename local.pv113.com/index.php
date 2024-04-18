<?php global $dbh; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сенонд хенд</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>
<body>
<div class="container py-3">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/_header.php"; ?>

    <h1 class="text-center">Актуальні новини</h1>

    <a href="/create.php" class="btn btn-success">Додати новину</a>
    <a href="/read.php" class="btn btn-success">Оновити</a>



    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/connection_database.php"; ?>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Назва</th>
            <th scope="col">Дата</th>
            <th scope="col">Опис</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $btn = "btn btn-success";
        $stm = $dbh->query('SELECT * FROM news');
        $rows = $stm->fetchAll();
        foreach ($rows as $row) {
            $id = $row["id"];
            $name = $row["name"];
            $datepublish = $row["datepublish"];
            $description = $row["description"];
            $hrefUpdate = "/update.php?id=$id";
            $hrefDelete = "/delete.php?id=$id";
            echo "
        <tr>
            <th scope='row'>$id</th>
            <td>$name</td>
            <td>$datepublish</td>
            <td>$description</td>
            <td><a href='$hrefUpdate' class='$btn'>Змінити</a></td>
            <td><a href='$hrefDelete' class='$btn'>Видалити</a></td>
        </tr>
            ";
        }
        ?>


        </tbody>
    </table>

</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
