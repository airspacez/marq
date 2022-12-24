<?php
require_once __DIR__ . '/boot.php';

$user = null;

if (check_auth()) {
  $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
  $stmt->execute(['id' => $_SESSION['user_id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Регистрация</title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

  <div class="container">
    <div class="row py-5">
      <div class="col-lg-6">

        <?php if ($user) { ?>

        <h1>Welcome back, <?= htmlspecialchars($user['username']) ?>!</h1>

        <form class="mt-5" method="post" action="doLogout.php">
          <button type="submit" class="btn btn-primary">Logout</button>
        </form>

        <?php } else { ?>

        <h1 class="mb-5">Регистрация аккаунта</h1>

        <?php error(); ?>

        <form method="post" action="doRegister.php">
          <div class="mb-3">
            <label for="username" class="form-label">Логин</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <?php
          if (isset($_POST['username'])) {
            $username = $_POST['username'];
            if (preg_match('/^([0-9a-zA-Z-_.])$/', $username)) {
              echo $username;
            } else {
              echo ("Для логина можно использовать только английские буквы и/или цифры: " . $username);
            }
            if ($username == '') {
              unset($username);
            }
          }
          ?>

          <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
          </div>
        </form>

        <?php } ?>

      </div>
    </div>
  </div>

</body>

</html>