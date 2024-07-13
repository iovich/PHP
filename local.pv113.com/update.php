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

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/constants.php");
    include_once $_SERVER["DOCUMENT_ROOT"] . "/connection_database.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $dbh->prepare("SELECT * FROM news WHERE id=?");
        $stmt->execute([$id]);
        $news = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $datepublish = $_POST['datepublish'];
        $description = $_POST['description'];
        $image = $_FILES["image"];
        $folderName = $_SERVER['DOCUMENT_ROOT'].'/'. UPLOADING;

        $image_save = "";
        if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $image_save = uniqid() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $path_save = $folderName.'/'.$image_save;
            move_uploaded_file($_FILES['image']['tmp_name'], $path_save);
        }

        $stmt = $dbh->prepare("UPDATE news SET name=?, datepublish=?, description=?, image=? WHERE id=?");
        $stmt->execute([$name, $datepublish, $description, $image_save, $id]);
        header("Location: /?id=".$id);
        exit();
    }
    if(empty($news)) {
        echo "Новину не знайдено!";
        exit();
    }
    ?>

    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $news['name']; ?>">
        </div>

        <div class="mb-3">
            <label for="datepublish" class="form-label">Дата публікації</label>
            <input type="datetime-local" class="form-control" id="datepublish" name="datepublish" value="<?php echo $news['datepublish']; ?>">
        </div>

        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Вкажіть опис тут" name="description" id="description" style="height: 100px"><?php echo $news['description']; ?></textarea>
                <label for="description">Опис</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Оберіть фото</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Оновити</button>
        </div>
    </form>



</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>