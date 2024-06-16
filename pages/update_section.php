<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once __DIR__ . '/../config.php';

    $section_id = $_GET["section_id"];

    $section_stmt = $db->prepare("SELECT title FROM sections WHERE id = ?");
    $section_stmt->bind_param("i", $section_id);
    $section_stmt->execute();
    $section_result = $section_stmt->get_result();
    $section = $section_result->fetch_all(MYSQLI_ASSOC);

    $stmt = $db->prepare("SELECT * FROM chapters WHERE section_id = ? ORDER BY id DESC");
    $stmt->bind_param("i", $section_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $chapters = $result->fetch_all(MYSQLI_ASSOC);

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
                        <div class="col-12 mt-5">
                            <h2 class="text-center main-h2">Измените название раздела</h2>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-6 mt-5 w-100">
                            <?php
                                echo '<form method="post" class="editable_title_form" action="../scripts/update_section_title.php">
                                    <input type="hidden" name="section_id" value="' . $section_id . '">
                                    <input value="' . $section[0]['title'] . '" name="title" type="text" class="editable_title_form_input form-control m-2" id="exampleFormControlInput1" placeholder="' . $section[0]['title'] . '">
                                    <button type="submit" class="main-button m-2">Изменить</button>
                                </form>'
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h2 class="text-center main-h2">Выберите тему для редактирования или удаления</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            for ($i = 0; $i < count($chapters); $i++) {
                                echo '<div class="col-xl-4 col-md-6 col-sm-12 section-tile my-5">
                                <a href="update_chapter.php?chapter_name=' . $chapters[$i]['title'] . '&chapter_id=' . $chapters[$i]['id'] . '">
                                <button class="p-3 section-tile-content px-5">
                                <span class="text-center">' . $chapters[$i]['title'] . '</span>
                                </button>
                                </a>
                                <button class="p-1 px-1 delete-button" onclick="openModalWindow(\'../scripts/delete_chapter.php?chapter_id=' . $chapters[$i]['id'] . '\')">
                                <span class="text-center">Удалить</span>
                                </button>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <?php
            include('../components/modal.php');
        ?>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/modal.js"></script>
</body>
</html>