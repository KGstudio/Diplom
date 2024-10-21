<?php
  require_once 'auth.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "Marketolog" && $password == "admin") {
      $_SESSION['authorized'] = true;
      header("Location: base.php");
      exit;
    } else {
      $error_message = "Неверный логин или пароль.";
    }
  }
?>

<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="assets/images/logo.ico">
  <style>
    body {
      background-color: #f5f5f5;
    }
    .container {
      max-width: 500px;
      margin: 40px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <h1 class="text-center m-5 p-3">ООО «Выбор Авто»</h1>
  <div class="container">
    <h1 class="text-center mb-4">Авторизация</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="form-group">
        <label for="username">Логин:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-block" id="submit-btn" style="background-color: #6c757d; color: #fff;">Войти</button>
    </form>
    <a href="/index.php" class="btn btn-block" id="home-btn" style="background-color: #dc3545; color: #fff;">Вернуться на главную</a>
    <?php if(isset($error_message)) { ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php echo $error_message; ?>
      </div>
    <?php } ?>
  </div>

  <script>
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const submitBtn = document.getElementById('submit-btn');
    const homeBtn = document.getElementById('home-btn');

    usernameInput.addEventListener('input', () => {
      if (usernameInput.value.length > 0 && passwordInput.value.length > 0) {
        submitBtn.style.backgroundColor = '#3498db';
        homeBtn.style.backgroundColor = '#e74c3c';
      } else {
        submitBtn.style.backgroundColor = '#e74c3c';
        homeBtn.style.backgroundColor = '#3498db';
      }
    });

    passwordInput.addEventListener('input', () => {
      if (usernameInput.value.length > 0 && passwordInput.value.length > 0) {
        submitBtn.style.backgroundColor = '#3498db';
        homeBtn.style.backgroundColor = '#e74c3c';
      } else {
        submitBtn.style.backgroundColor = '#e74c3c';
        homeBtn.style.backgroundColor = '#3498db';
      }
    });
  </script>
</body>
</html>