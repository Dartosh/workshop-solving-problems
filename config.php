<?php
    $host         = "127.0.0.1";
    $user         = "workshop_admin";
    $password     = "12344321";
    $port         = 3306;
    $dbname       = "workshop_solving_problems";
    $tbl_users    = "users";
    $tbl_sections = "sections";
    $tbl_chapters = "chapters";
    $tbl_tasks    = "tasks";
    $charset      = 'utf8mb4';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli($host, $user, $password, $dbname, $port);
    $db->set_charset($charset);
    $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
?>