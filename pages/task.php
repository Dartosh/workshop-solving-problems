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
                        <div class="col-6 task-buttons-container">
                            <button class="task-button" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <i class="icon-angle-circled-left"></i>
                            </button>
                        </div>
                        <div class="col-6 task-buttons-container">
                            <button class="task-button" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <i class="icon-angle-circled-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div id="carouselExample" data-bs-interval="false" class="carousel slide">
                                <div class="carousel-inner task-contaner w-100">
                                    <?php
                                        error_reporting(E_ALL);
                                        ini_set('display_errors', 1);

                                        require_once __DIR__ . '/../config.php';

                                        $chapter_id = $_GET["chapter_id"];
                                        $selected_task_id = $_GET["selected_task_id"];

                                        $stmt = $db->prepare("SELECT * FROM tasks WHERE chapter_id = ? ORDER BY id ASC");
                                        $stmt->bind_param("i", $chapter_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $tasks = $result->fetch_all(MYSQLI_ASSOC);

                                        for ($i = 0; $i < count($tasks); $i++) {
                                            $markdown = "";

                                            if ($tasks[$i]['id'] == intval($selected_task_id)) {
                                                $markdown = $markdown . '<div class="carousel-item active">';
                                            } else {
                                                $markdown = $markdown . '<div class="carousel-item">';
                                            }

                                            $markdown = $markdown . '
                                                    <div class="task">
                                                        <div class="task-left-column">
                                                            <div class="task-medium-block p-1">
                                                                <div class="task-content p-2">
                                                                    <b>Задача ' . $tasks[$i]['id'] . '. </b>
                                                                    ' . $tasks[$i]['content'] . '
                                                                </div>
                                                            </div>';

                                            if (isset($tasks[$i]['file_name'])) {
                                                $markdown = $markdown . '<div class="task-medium-block p-1">
                                                    <div class="task-content p-2">
                                                        <img src="../public/' . $tasks[$i]['file_name'] . '" class="img-fluid rounded mx-auto d-block profile-photo" style="max-height: 100%;" alt="photo-1">
                                                    </div>
                                                </div>';
                                            }
                                                            
                                            $markdown = $markdown . '</div>
                                                        <div class="task-large-block p-1">
                                                            <div class="task-content">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';

                                            echo $markdown;
                                        }
                                    ?>
                                </div>
                            </div>
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