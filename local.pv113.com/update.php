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

    <h1 class="text-center">Оновити новину</h1>

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/connection_database.php"; ?>

    <?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Retrieve the news item to be updated
        $stmt = $dbh->prepare('SELECT * FROM news WHERE id = ?');
        $stmt->execute([$id]);
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        // If news item exists
        if($news) {
            $name = $news['name'];
            $datepublish = $news['datepublish'];
            $description = $news['description'];
        } else {
            // Redirect or handle error if news item doesn't exist
            header("Location: index.php");
            exit();
        }
    } else {
        // Redirect or handle error if news ID is not provided
        header("Location: index.php");
        exit();
    }


    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        </div>
        <div class="form-group">
            <label for="datepublish">Дата публікації:</label>
            <input type="date" class="form-control" id="datepublish" name="datepublish" value="<?php echo htmlspecialchars($datepublish); ?>">
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control" id="description" name="description" rows="5"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Оновити</button>
    </form>

    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $name = $_POST['name'];
        $datepublish = $_POST['datepublish'];
        $description = $_POST['description'];

        // Modify the SQL query to update the record
        $stmt = $dbh->prepare('UPDATE news SET name, datepublish, description WHERE id VALUES (?, ?, ?, ?)') ;
        $stmt->execute([$name, $datepublish, $description, $id]);

        //$stmt = $dbh->prepare('INSERT INTO news (name, datepublish, description) VALUES (?, ?, ?)');
        //$stmt->execute([$name, $datepublish, $description]);

        header("Location: index.php");
        exit();
    }
    ?>

</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>