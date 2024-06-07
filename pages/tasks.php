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
                            <h2 class="text-center main-h2">
                                Задачи на тему "<?php echo $_GET["chapter_name"]; ?>"
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div id="display-content" class="w-100">
                                <?php
                                
                                error_reporting(E_ALL);
                                ini_set('display_errors', 1);
                                require_once __DIR__ . '/../config.php';
                                
                                $chapter_id = $_GET["chapter_id"];

                                $stmt = $db->prepare("SELECT * FROM chapters WHERE id = ? ORDER BY id ASC");

                                $stmt->bind_param("i", $chapter_id);
                                $stmt->execute();
                                $chapter_result = $stmt->get_result();
                                $chapter = $chapter_result->fetch_all(MYSQLI_ASSOC);


                                echo $chapter[0]['content']
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 mt-2">
                        <div class="col text-center">
                            <?php echo '<a href="../create_pptx.php?chapter_id=' . $_GET["chapter_id"] . '">' ?>
                                <button class="main-button p-2">
                                    <span>Скачать задачи</span><i class="icon-download"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            require_once __DIR__ . '/../config.php';

                            // $chapter_id = $_GET["chapter_id"];
                            $chapter_name = $_GET["chapter_name"];

                            $stmt = $db->prepare("SELECT * FROM tasks WHERE chapter_id = ? ORDER BY id ASC");
                            $stmt->bind_param("i", $chapter_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $tasks = $result->fetch_all(MYSQLI_ASSOC);
                        
                            for ($i = 0; $i < count($tasks); $i++) {
                                echo '<div class="col-xl-4 col-md-6 col-sm-12 section-tile my-5">
                                <a href="task.php?selected_task_id=' . $tasks[$i]['id'] . '&chapter_id=' . $chapter_id . '">
                                <button class="p-3 section-tile-content px-5">
                                <span class="text-center">Задача ' . $tasks[$i]['id'] . '</span>
                                </button>
                                </a>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <!-- <?php
        include('../components/footer.php');
        ?> -->
    </div>

    <!-- Подключение скрипта Bootstrap -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Подключение скрипта Quill -->
    <script src="../js/quill.min.js"></script>
    <!-- Подключение скрипта KaTeX -->
    <script src="../js/katex.min.js"></script>
</body>
</html>