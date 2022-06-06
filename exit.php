<?php
session_start();
if (!isset($_SESSION['nam'])) {
    header("location: ./../index.php");
} else {
    session_destroy();
    header("location: ./../enter.php");
}
