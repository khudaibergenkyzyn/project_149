<?php 
	include "config/baseurl.php";
	include "config/db.php";
	session_start();
?>
<header class="header container">
	<div class="header-logo">
	    <a href="<?=$BASE_URL?>">Decode Blog</a>	
	</div>
	<form class="header-search" action="" method="GET">
		<input type="text" class="input-search" placeholder="Поиск по блогам" name="search">
		<button class="button button-search" type="submit">
			<img src="images/search.svg" alt="">	
			Найти
		</button>
	</form>
	<div>
		<?php
			if(isset($_SESSION["id"])){
				$nickname = $_SESSION["nickname"]
		?>
			<a href="<?=$BASE_URL?>/profile.php?nickname=<?=$nickname?>">
				<img class="avatar" src="images/avatar.png" alt="Avatar">
			</a>
		<?php
			}else{
		?>
			<div class="button-group">
				<a href="<?= $BASE_URL ?>/register.php" class="button">Регистрация</a>
				<a href="<?= $BASE_URL ?>/login.php" class="button">Вход</a>
			</div>	
		<?php
			}
		?>
	</div>
</header>