<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontello.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Подключение стилей Quill -->
    <link href="../css/quill.snow.css" rel="stylesheet">
    <!-- Подключение стилей Katex -->
    <link href="../css/katex.min.css" rel="stylesheet">
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
                        <div class="col-6 mt-3 my-5">
                            <a href="create.php">
                                <button class="section-tile-content w-100">
                                    <span class="text-center">Создать</span>
                                </button>
                            </a>
                        </div>
                        <div class="col-6 mt-3 my-5">
                            <a href="update_sections.php">
                                <button class="section-tile-content w-100">
                                    <span class="text-center">Редактировать</span>
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

    <!-- Подключение скрипта Quill -->
    <script src="../js/quill.min.js"></script>
    <!-- Подключение скрипта KaTeX -->
    <script src="../js/katex.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    formula: true,
                    toolbar: [
                        [{ 'font': [] }, { 'size': [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ]
                }
            });

            document.getElementById('chapter-form').onsubmit = function() {
                var content = document.querySelector('input[name=content]');
                content.value = quill.root.innerHTML;
            };
        });
    </script>
</body>
</html>