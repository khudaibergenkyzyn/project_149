
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Редактировать блог</title>
	<?php include "views/head.php" ?>
</head>
<body>
<?php include "views/header.php" ?>
	<section class="container page">
		<div class="page-block">

			<div class="page-header">
				<h2>Редактировать блог</h2>
			</div>
			<?php
				$blog_id = $_GET["id"];
				$blog_query = mysqli_query($con , "SELECT * FROM blogs WHERE id='$blog_id'");
				$blog = mysqli_fetch_assoc($blog_query);
			?>

			<form class="form" action="api/blogs/edit.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" value="<?=$blog_id?>" name="blog_id">
				
				<fieldset class="fieldset">
					<input class="input" type="text" name="title" placeholder="Заголовок" value="<?=$blog["title"]?>">
				</fieldset>
				<fieldset class="fieldset">
				<select name="category_id" id="" class="input">
					<?php
						$categ_query = mysqli_query($con , "SELECT * FROM categories");
						while($categ = mysqli_fetch_assoc($categ_query)){
							if($categ["id"] == $blog["category_id"]){
					?>
								<option value="<?=$categ["id"]?>" selected><?=$categ["name"]?></option>
					<?php
							}else{
					?>
						<option value="<?=$categ["id"]?>"><?=$categ["name"]?></option>
					<?php
							}
						}
					?>
				</select>
			</fieldset class="fieldset">

				<fieldset class="fieldset">
					<button class="button button-yellow input-file">
						<input type="file" name="image">	
						Выберите картинку
					</button>
				</fieldset>
					
				<fieldset class="fieldset">
					<textarea class="input input-textarea" name="description" id="" cols="30" rows="10" placeholder="Описание"><?=$blog["description"]?></textarea>
				</fieldset>
				<fieldset class="fieldset">
					<button class="button" type="submit">Сохранить</button>
				</fieldset>
			</form>
				<!-- <p class="text-danger"> Заголовок и Описание не могут быть пустыми!</p> -->



		</div>

	</section>
	
	

	
	
</body>
</html>
