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
                            <h2 class="text-center main-h2">Выберите раздел для редактирования или удаления</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            require_once __DIR__ . '/../config.php';

                            $sql = "SELECT * FROM sections ORDER BY id DESC";
                            $result = $db->query($sql);
                            $sections = $result->fetch_all(MYSQLI_ASSOC);

                            for ($i = 0; $i < count($sections); $i++) {
                                echo
                                    '<div class="col-xl-4 col-md-6 col-sm-12 section-tile my-5">
                                    <a href="update_section.php?section_id=' . $sections[$i]['id'] . '">
                                    <button class="px-5 section-tile-content">
                                    <span class="text-center">' . $sections[$i]['title'] . '</span>
                                    </button>
                                    </a>
                                    <button class="p-1 px-1 delete-button" onclick="openModalWindow(\'../scripts/delete_section.php?section_id=' . $sections[$i]['id'] . '\')">
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