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
                    <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        require_once __DIR__ . '/../config.php';

                        $section_title = $_POST['section_title'];

                        $db->execute_query("INSERT INTO sections (title) VALUES (?)", [$section_title]);
                    ?>
                    <div class="row">
                        <div class="col-12 mt-5 mb-5">
                            <h2 class="text-center main-h2">Раздел успешно создан!</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="admin.php">
                                <button class="p-3 section-tile-content px-5">
                                    <span class="text-center">Вернуться</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- <?php
        include('../components/footer.php');
        ?> -->
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>