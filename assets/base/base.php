<?php
  require_once 'auth.php';
  checkAccess();

  if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
  }

  if (!isAuthorized()) {
    header("Location: login.php");
    exit;
  }

  // Попытка подключения к базе данных
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "choiceauto";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Проверка успешного подключения
  if ($conn->connect_error) {
    header("Location: assets/base/login.php");
    exit;
  }

  // Выборка данных из таблицы leads
  $sql = "SELECT name, phone, budget, country FROM leads";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $leads = array();
    while($row = $result->fetch_assoc()) {
      $leads[] = $row;
    }
  } else {
    $leads = array();
  }

  $conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Сотрудник компании</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="assets/images/logo.ico">
</head>
<body>
  <div class="container p-4">
    <h1 class="text-center mb-2">Список заявок от клиентов</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Имя</th>
          <th>Номер телефона</th>
          <th>Ориентировочный бюджет</th>
          <th>Страна</th>
          <th>Отметка</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($leads as $lead) { ?>
          <tr>
            <td><?php echo $lead["name"]; ?></td>
            <td><?php echo $lead["phone"]; ?></td>
            <td><?php echo $lead["budget"]; ?> руб.</td>
            <td>
              <?php
                switch ($lead["country"]) {
                  case 0:
                    echo "Не выбрано";
                    break;
                  case 1:
                    echo "Китай";
                    break;
                  case 2:
                    echo "Япония";
                    break;
                  case 3:
                    echo "Корея";
                    break;
                  default:
                    echo "Неизвестно";
                }
              ?>
            </td>
            <td><input type="checkbox" class="client-checkbox" data-client-id="<?php echo $lead["id"]; ?>"> </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <form method="post">
      <button type="submit" name="logout" class="btn btn-danger mt-3">Выход</button>
    </form>
  </div>

  <script>
    // Сохранение состояния отмеченных клиентов в локальном хранилище
    const checkboxes = document.querySelectorAll('.client-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const clientId = this.getAttribute('data-client-id');
        localStorage.setItem(`client_${clientId}`, this.checked);
      });

      // При загрузке страницы восстанавливается состояние чекбоксов из локального хранилища (компьютер сотрудника)
      const checked = localStorage.getItem(`client_${checkbox.getAttribute('data-client-id')}`) === 'true';
      checkbox.checked = checked;
    });
  </script>
</body>
</html>


