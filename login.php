<?php
require_once __DIR__ . '/boot.php';

if (check_auth()) {
  header('Location: /');
  die;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Авторизация</title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

  <div class="container">
    <div class="row py-5">
      <div class="col-lg-6">

        <h1 class="mb-3 text-center">Вход в аккаунт</h1>

        <?php error() ?>

        <form method="post" action="doLogin.php">
          <div class="mb-3">
            <label for="username" class="form-label">Логин</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Войти</button>
            <a class="btn btn-outline-primary" href="registration.php">Зарегистрироваться</a>
          </div>
        </form>

      </div>
    </div>
  </div>

</body>

</html>