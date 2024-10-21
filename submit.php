<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "choiceauto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$budget = $_POST['budget'];

$sql = "INSERT INTO leads (name, phone, country, budget) VALUES ('$name', '$phone', '$country', '$budget')";

if ($conn->query($sql) === TRUE) {
  echo "Данные успешно отправлены в базу.";
} else {
  echo "Ошибка при сохранении данных: " . $conn->error;
}

$conn->close();
?>
