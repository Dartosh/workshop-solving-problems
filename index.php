<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
</head>
<body>
    <div class="wrapper main_page_wrapper">
      <?php
        include('components/header.php');
      ?>

      <main class="main_page_main">
        <div class="container main_page_container">
          <div class="row">
            <div class="col-12">
              <h1 class="text-center main_page_h1">
                Электронный практикум решения физических задач
              </h1>
            </div>
          </div>
          <div class="row mt-3 mb-3">
            <div class="col-12 text-center">
              <a href="pages/sections.php">
                <button type="button" class="main-button">
                  <b>Поехали!</b>
                </button>
              </a>
            </div>
          </div>
        </div>
      </main>

      <!-- <?php
        include('components/footer.php');
      ?> -->
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
