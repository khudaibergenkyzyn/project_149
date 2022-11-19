<?php
	include "config/db.php";
	$sql = "SELECT b.* , u.nickname , c.name FROM blogs b INNER JOIN users u ON b.author_id = u.id INNER JOIN categories c 
	ON b.category_id = c.id";
	$limit = 5;
	$sql_count = "SELECT CEIL(COUNT(*) / $limit) as total FROM blogs b INNER JOIN users u ON b.author_id = u.id INNER JOIN 
	categories c ON b.category_id = c.id";
	if(isset($_GET["categ"]) && intval($_GET["categ"])){
		$categ = $_GET["categ"];
		$sql .= " WHERE c.id = '$categ'";
		$sql_count .= " WHERE c.id = '$categ'";
	}
	if(isset($_GET["search"]) && strlen($_GET["search"]) > 0){
		$search = $_GET["search"];
		$sql.= " WHERE b.title LIKE '%$search%' OR b.description LIKE '%$search%'";
		$sql_count.= " WHERE b.title LIKE '%$search%' OR b.description LIKE '%$search%'";
	}
	if(isset($_GET["page"]) && intval($_GET["page"])){
		$page = $_GET["page"];
		$count = ($page - 1) * $limit;
		$sql.= " LIMIT  $count , $limit";
	}else{
		$sql.= " LIMIT $limit";
	}
	$blogs_query = mysqli_query($con , $sql);
	$page_query = mysqli_query($con , $sql_count);
	$page_count = mysqli_fetch_assoc($page_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Главная</title>
    <?php include "views/head.php" ?>
</head>
<body>
<?php include "views/header.php" ?>


<section class="container page">
	<div class="page-content">
			<h2 class="page-title">Блоги по программированию</h2>
			<p class="page-desc">Популярные и лучшие публикации по программированию для начинающих
 и профессиональных программистов и IT-специалистов.</p>

		<div class="blogs">
			<?php
				if(mysqli_num_rows($blogs_query) > 0){
					while($blog = mysqli_fetch_assoc($blogs_query)){
			?>
					<div class="blog-item">
						<img class="blog-item--img" src="<?=$blog["image"]?>" alt="">
						<div class="blog-header">
							<h3><?=$blog["title"]?></h3>
						</div>
						<p class="blog-desc">
							<?=$blog["title"]?>
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
							<a class="link" href="<?=$BASE_URL?>/profile.php?nickname=<?=$blog["nickname"]?>">
								<img src="images/person.svg" alt="">
								<?=$blog["nickname"]?>
							</a>
						</div>
					</div>
			<?php
					}
				}else{
			?>
					<h3>0 blogs</h3>
			<?php
				}
			?>

			
		</div>
	</div>
	<div class="page-info">
		<div class="page-header">
			<h2>Категории</h2>
		</div>
		<?php
			$categ_query = mysqli_query($con , "SELECT * FROM categories");
			while($categ = mysqli_fetch_assoc($categ_query)){
		?>
			<a href="<?=$BASE_URL?>/?categ=<?=$categ["id"]?>" class="list-item"><?=$categ["name"]?></a>
		<?php
			}
		?>
	</div>
	<div>
		<?php
			for($i = 1; $i <= $page_count["total"]; $i++){
		?>
			<a href="<?=$BASE_URL?>/?page=<?=$i?>"><?=$i?></a>
		<?php
			}
		?>
	</div>
</section>	
</body>
</html>