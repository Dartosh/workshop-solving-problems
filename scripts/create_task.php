
<?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once __DIR__ . '/../config.php';

    $chapter_id = $_POST['chapter_id'];
    $task_content = $_POST['task_content'];

    echo $_FILES['task_file']['name'];

    echo __DIR__;

    if (isset($_FILES['task_file'])) {
        $target_dir = __DIR__ . "/../public/";
        $new_file_name = generateRandomString();
        $file_ext = strtolower(pathinfo($_FILES['task_file']['name'], PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($new_file_name . '.' . $file_ext);
        echo $target_file;

        if (move_uploaded_file($_FILES['task_file']['tmp_name'], $target_file)) {
            $db->execute_query("INSERT INTO tasks (content, file_name, chapter_id) VALUES (?, ?, ?)", [$task_content, $new_file_name . '.' . $file_ext, $chapter_id]);
        } else {
            $db->execute_query("INSERT INTO tasks (content, chapter_id) VALUES (?, ?)", [$task_content, $chapter_id]);
        }
    } else {
        $db->execute_query("INSERT INTO tasks (content, chapter_id) VALUES (?, ?)", [$task_content, $chapter_id]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontello.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Зеленская Ангелина - Проект</title>
</head>
<body>
    <div class="wrapper main_page_wrapper">
        <?php
        include('../components/header.php');
        ?>

        <main class="main_page_main">
            <section class="main_section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-5 mb-5">
                            <h2 class="text-center main-h2">Задача успешно создана!</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="../pages/create.php">
                                <button class="p-3 section-tile-content px-5">
                                    <span class="text-center">Вернуться</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>