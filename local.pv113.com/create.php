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

    <h1 class="text-center">Додати новину</h1>


    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/connection_database.php"; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="datepublish">Дата публікації:</label>
            <input type="date" class="form-control" id="datepublish" name="datepublish">
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Готово</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $name = $_POST['name'];
        $datepublish = $_POST['datepublish'];
        $description = $_POST['description'];

        $stmt = $dbh->prepare('INSERT INTO news (name, datepublish, description) VALUES (?, ?, ?)');
        $stmt->execute([$name, $datepublish, $description]);

        header("Location: index.php");
        exit();
    } ?>


</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>