<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once __DIR__ . '/../config.php';

    $chapter_id = $_GET["chapter_id"];
    $chapter_name = $_GET["chapter_name"];

    $chapter_stmt = $db->prepare("SELECT * FROM chapters WHERE id = ?");

    $chapter_stmt->bind_param("i", $chapter_id);
    $chapter_stmt->execute();
    $chapter_result = $chapter_stmt->get_result();
    $chapter = $chapter_result->fetch_all(MYSQLI_ASSOC);

    $tasks_stmt = $db->prepare("SELECT * FROM tasks WHERE chapter_id = ? ORDER BY id ASC");
    $tasks_stmt->bind_param("i", $chapter_id);
    $tasks_stmt->execute();
    $tasks_result = $tasks_stmt->get_result();
    $tasks = $tasks_result->fetch_all(MYSQLI_ASSOC);
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
    <!-- Подключение стилей Quill -->
    <link href="../css/quill.snow.css" rel="stylesheet">
    <!-- Подключение стилей Katex -->
    <link href="../css/katex.min.css" rel="stylesheet">
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
                            <h2 class="text-center main-h2">Измените название темы</h2>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-6 mt-5 w-100">
                            <?php
                                echo '<form method="post" class="editable_title_form" action="../scripts/update_chapter_title.php">
                                    <input type="hidden" name="chapter_id" value="' . $chapter_id . '">
                                    <input value="' . $chapter[0]['title'] . '" name="title" type="text" class="editable_title_form_input form-control m-2" id="exampleFormControlInput1" placeholder="' . $chapter[0]['title'] . '">
                                    <button type="submit" class="main-button m-2">Изменить</button>
                                </form>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h2 class="text-center">Измените текст теоретического материала темы</h2>
                        </div>
                    </div>
                    <div class="row">
                        <form id="chapter-form" method="post" action="../scripts/update_chapter_content.php">
                            <div class="form-group" style="display: flex; justify-conent: center; flex-wrap: wrap;">
                                <div id="editor-container"></div>
                                <input type="hidden" name="content" id="editor-content">
                                <?php echo '<input type="hidden" name="chapter_id" value="' . $chapter[0]['id'] . '">'  ?>
                                <?php echo '<input type="hidden" name="title" value="' . $chapter[0]['title'] . '">'  ?>
                            </div>
                            <div style="width: 100%; display: flex; justify-conent: center; flex-wrap: wrap;">
                                <button type="submit" class="main-button" style="margin: 1rem auto;">Изменить</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h2 class="text-center">Выберите задачу для редактирования или удаления</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            for ($i = 0; $i < count($tasks); $i++) {
                                echo '<div class="col-xl-4 col-md-6 col-sm-12 section-tile my-5">
                                <a href="task.php?selected_task_id=' . $tasks[$i]['id'] . '&chapter_id=' . $chapter_id . '">
                                <button class="p-3 section-tile-content px-5">
                                <span class="text-center">Задача ' . $tasks[$i]['id'] . '</span>
                                </button>
                                </a>
                                <button class="p-1 px-1 delete-button" onclick="openModalWindow(\'../scripts/delete_task.php?task_id=' . $tasks[$i]['id'] . '\')">
                                <span class="text-center">Удалить</span>
                                </button>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <div id="hidden-content" style="display: none;">
            <?php echo $chapter[0]['content'] ?>
        </div>

        <?php
            include('../components/modal.php');
        ?>
    </div>

    <!-- Подключение скрипта Bootstrap -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Подключение скрипта Quill -->
    <script src="../js/quill.min.js"></script>
    <!-- Подключение скрипта KaTeX -->
    <script src="../js/katex.min.js"></script>
    <script src="../js/modal.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    formula: true,
                    toolbar: [
                        [],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [],
                        [],
                        [],
                        ['link', 'formula'],
                        ['clean']
                    ]
                }
            });

            const savedContent = document.getElementById('hidden-content');

            quill.root.innerHTML = savedContent.innerHTML;

            document.getElementById('chapter-form').onsubmit = function() {
                var content = document.querySelector('input[name=content]');
                content.value = quill.root.innerHTML;
            };
        });
    </script>
</body>
</html>