<?php
$name = $_POST["name"];
$message = $_POST["message"];
$priority = filter_input(INPUT_POST, "priority", FILTER_VALIDATE_INT);
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if (!$terms) {
    die("checkbox must be checked");
}
;
// echo"<br>";

$host = "localhost";
$dataname = "info-db";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dataname);
if (mysqli_connect_errno()) {
    die("connection filed" . mysqli_connect_error());
} else {
    echo "we got it";
}

echo '<br>';
$sql = "INSERT INTO `person-dt`(`name`, `body`, `priority`, `type`) VALUES 
(?, ? ,? ,? )";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssii", $name, $message, $priority, $type);

mysqli_stmt_execute($stmt);

echo "recored was saved";