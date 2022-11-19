<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
	<?php include "views/head.php" ?>
</head>
<body>

<?php include "views/header.php" ?>
<section class="container page">
	<?php
		$nickname = $_GET["nickname"];
		$user_query = mysqli_query($con , "SELECT * FROM users WHERE nickname='$nickname'");
		$user = mysqli_fetch_assoc($user_query);
		$user_id = $user["id"];
	?>
	<div class="page-content">
		<div class="page-header">
			<?php
				if($nickname == $_SESSION["nickname"]){
			?>
				<h2>Мои блоги</h2>
				<a class="button" href="<?=$BASE_URL?>/newblog.php">Новый блог</a>
			<?php
				}else{
			?>
				<h2>Блоги пользователя</h2>
			<?php
				}
			?>
		</div>

		<div class="blogs">
			<?php
				$blogs_query = mysqli_query($con , "SELECT b.* , u.nickname , c.name FROM blogs b 
				INNER JOIN users u ON b.author_id = u.id INNER JOIN categories c ON b.category_id = c.id WHERE author_id = $user_id");
				if(mysqli_num_rows($blogs_query) > 0){
					while($blog = mysqli_fetch_assoc($blogs_query)){
			?>

					<div class="blog-item">
						<img class="blog-item--img" src="<?=$blog["image"]?>" alt="">
						<div class="blog-header">
							<h3><?=$blog["title"]?></h3>
							<?php
								if($nickname == $_SESSION["nickname"]){
							?>
								<span class="link">
									<img src="images/dots.svg" alt="">
									Еще

									<ul class="dropdown">
										<li> <a href="<?=$BASE_URL?>/editblog.php?id=<?=$blog["id"]?>">Редактировать</a> </li>
										<li><a href="api/blogs/delete.php?id=<?=$blog["id"]?>" class="danger">Удалить</a></li>
									</ul>
								</span>
							<?php
								}
							?>

						</div>
						<p class="blog-desc">
							<?=$blog["description"]?>
						</p>

						<div class="blog-info">
							<span class="link">
								<img src="images/date.svg" alt="">
								22.12.21
							</span>
							<span class="link">
								<img src="images/visibility.svg" alt="">
								21
							</span>
							<a class="link">
								<img src="images/message.svg" alt="">
								4
							</a>
							<span class="link">
								<img src="images/forums.svg" alt="">
								<?=$blog["name"]?>
							</span>
							<a class="link">
								<img src="images/person.svg" alt="">
								<?=$blog["nickname"]?>
							</a>
						</div>
					</div>
					
			<?php
					}
				}else{
			?>
				<h1>0 blogs</h1>
			<?php
				}
			?>


		</div>
	</div>
	<div class="page-info">
		<div class="user-profile">
			<img class="user-profile--ava" src="images/avatar.png" alt="">

			<h1><?=$user["full_name"]?></h1>
			<h2><?=$user["email"]?></h2>
			<p>285 постов за все время</p>
			<?php
				if($nickname == $_SESSION["nickname"]){
			?>
				<a href="" class="button">Редактировать</a>
				<a href="api/users/signout.php" class="button button-danger"> Выход</a>
			<?php
				}
			?>
		</div>
	</div>
</section>	
</body>
</html>