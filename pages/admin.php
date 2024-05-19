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
                        <div class="col-12 mt-1">
                            <h2 class="text-center main-h2">Создание раздела</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form method="post" action="create_section.php">
                                <div class="form-group" style="display: flex; justify-conent: center; flex-wrap: wrap;">
                                    <label for="exampleFormControlInput1">Введите название раздела</label>
                                    <input name="section_title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название раздела">
                                </div>
                                <div style="width: 100%; display: flex; justify-conent: center; flex-wrap: wrap;">
                                    <button type="submit" class="main-button" style="margin: 1rem auto;">Создать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h2 class="text-center main-h2">Создание темы раздела</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form method="post" action="create_chapter.php">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Выберите название раздела</label>
                                    <select name="section_id" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                        error_reporting(E_ALL);
                                        ini_set('display_errors', 1);

                                        require_once __DIR__ . '/../config.php';

                                        $sql = "SELECT * FROM sections ORDER BY id DESC";
                                        $result = $db->query($sql);
                                        $sections = $result->fetch_all(MYSQLI_ASSOC);

                                        for ($i = 0; $i < count($sections); $i++) {
                                            echo
                                                '<option value="' . $sections[$i]['id'] . '">' . $sections[$i]['title'] . '</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group" style="display: flex; justify-conent: center; flex-wrap: wrap;">
                                    <label for="exampleFormControlInput1">Введите название темы</label>
                                    <input name="chapter_title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название раздела">
                                </div>
                                <div style="width: 100%; display: flex; justify-conent: center; flex-wrap: wrap;">
                                    <button type="submit" class="main-button" style="margin: 1rem auto;">Создать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <h2 class="text-center main-h2">Создание задачи для темы</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form method="post" action="create_task.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Выберите название темы</label>
                                    <select name="chapter_id" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                        error_reporting(E_ALL);
                                        ini_set('display_errors', 1);

                                        require_once __DIR__ . '/../config.php';

                                        $stmt = $db->prepare("SELECT * FROM chapters ORDER BY id DESC");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $chapters = $result->fetch_all(MYSQLI_ASSOC);
                                    
                                        for ($i = 0; $i < count($chapters); $i++) {
                                            echo '<option value="' . $chapters[$i]['id'] . '">' . $chapters[$i]['title'] . '</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Введите текст задачи</label>
                                    <textarea name="task_content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label for="exampleFormControlFile1">Выберите изображение для задачи (необязательно)</label>
                                    <br>
                                    <input type="file" name="task_file" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                                <div style="width: 100%; display: flex; justify-conent: center; flex-wrap: wrap;">
                                    <button type="submit" class="main-button" style="margin: 1rem auto;">Создать</button>
                                </div>
                            </form>
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