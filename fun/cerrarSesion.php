<?php
session_start();
header('Location: ../index.php?successful_message=Usted ha cerrado sesion!');
session_destroy();
?>