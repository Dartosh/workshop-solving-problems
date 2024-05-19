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
                            <h2 class="text-center main-h2">Темы</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            require_once __DIR__ . '/../config.php';

                            $section_id = $_GET["section_id"];

                            $stmt = $db->prepare("SELECT * FROM chapters WHERE section_id = ? ORDER BY id DESC");
                            $stmt->bind_param("i", $section_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $chapters = $result->fetch_all(MYSQLI_ASSOC);
                        
                            for ($i = 0; $i < count($chapters); $i++) {
                                echo '<div class="col-xl-4 col-md-6 col-sm-12 section-tile my-5">
                                <a href="tasks.php?chapter_name=' . $chapters[$i]['title'] . '&chapter_id=' . $chapters[$i]['id'] . '">
                                <button class="p-3 section-tile-content px-5">
                                <span class="text-center">' . $chapters[$i]['title'] . '</span>
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
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>