
<?php
    include('../config.php');

    $sql = "SELECT * FROM sections ORDER BY id DESC";
    $result = $db->query($sql);
    // $sections = $result->fetch_all(MYSQLI_ASSOC);

    // for ($i = 0; $i < count($sections); $i++) {
    //     echo $sections[$i]['title'];
    // }
?>