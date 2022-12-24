<?php
require_once __DIR__ . '/boot.php';
$user = null;

if (check_auth()) {
	$stmt = pdo()->prepare("SELECT * FROM `user` WHERE `id` = :id");
	$stmt->execute(['id' => $_SESSION['user_id']]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
}

$sth = pdo()->prepare("SELECT * FROM `user` WHERE `id` = :id");
$sth->execute(['id' => $_SESSION['user_id']]);
$user = $sth->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" href="">
	<link rel="stylesheet" href="style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<title>Заметки</title>
</head>

<body>
	<div id="app">
		<!--<AppHeader -->
		<div id="header">

			<div id="header-createNote" class="header-button accent" onclick="openEditor()">
				<p class="text">Новая заметка</p>
			</div>
			<?php if ($user) { ?>
			<div class="user-hello">
				<p class="text">Здравствуйте, <?= htmlspecialchars($user['username']) ?></p>
			</div>
			<form action="doLogout.php" class="mgl">
				<form method="post" action="doLogout.php">
					<button type="submit" class="header-button normal mgl">Выйти</button>
				</form>
				<?php } ?>
			</form>

			<?php if (!$user) {
	            header('Location: login.php');
	            exit();
            } ?>
			</form>
		</div>
		<!--/>-->

		<!--<Editor> -->
		<div id="editor" style="display: none;">
			<form class="editor" method="post" action="addNote.php">
				<div class="editor-header">
					<input class="editor-title" type="text" id="title" name="title" placeholder="Новая заметка">
					<div class="editor-close" onclick="closeEditor()">X</div>
				</div>
				<div class="editor-content">
					<textarea class="editor-text" type="text" id="text" name="text"
						placeholder="Введите текст заметки"></textarea>
				</div>
				<div class="editor-footer">
					<button type="submit" class="editor-save">Сохранить</button>
				</div>
			</form>
		</div>
		<!--/>-->

		<!--<EditNote> -->
		<div id="editnote" style="display: none;">
			<form class="editnote" method="post" action="updateNote.php">
				<input class="id_note" type='hidden' name='id_note' value="" />
				<div class="editnote-header">
					<input class="editnote-title" type="text" id="title" name="title" value="">
					<div class="editnote-close" onclick="closeEditnote()">X</div>
				</div>
				<div class="editnote-content">
					<textarea class="editnote-text" type="text" id="text" name="text" value=""></textarea>
				</div>
				<div class="editnote-footer">
					<button type="submit" class="editnote-save">Сохранить</button>
				</div>
			</form>
		</div>
		<!--/>-->

		<!--<UPDATE NOTE> -->
		<!-- !!!!!!!!!!!!!!!!! -->
		<!-- !!!!!!!!!!!!!!!!! -->
		<!-- !!!!!!!!!!!!!!!!! -->
		<!-- !!!!!!!!!!!!!!!!! -->
		<!--/>-->

		<?php
        require('noteInformation.php');
        if ($user) { ?>
		<ul class="content">
			<?php
	        $rowsCount = $sth->rowCount();
	        foreach ($sth as $row) { ?>
			<li class="note" onclick="openEditnote()">
				<input class="idNote" type='hidden' name='id_note' value="<?= $row["id_note"] ?>" />
				<div class="note-header">
					<p class="note-title"><?php print_r($row["title"]) ?></p>
					<form action="deleteNote.php" method="post">
						<input type='hidden' name='id_note' value="<?= $row["id_note"] ?>" />
						<button type='submit' class="note-delete">Х</button>
					</form>
				</div>
				<p class="note-preview"><?php print_r($row["text"]) ?></p>
				<div class="note-footer">
					<div class="note-date"><?php print_r($row["date_note"]) ?></div>
				</div>
			</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
	<script src="script/functions.js"></script>
</body>

</html>