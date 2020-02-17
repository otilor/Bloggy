<?php 
	include("auth/server.php"); 
	$errors = array("email" => "", "post_title"=> "", "post_content" => "",);
	if(isset($_POST["post_btn"])){
		//What happens when button is clicked

		if(empty(($_POST["email"]))){
			$errors["email"] = "Enter an Email address";
		}
		else{
			$email = $_POST["email"];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors["email"] = "Enter a valid email";
			}
		}

		if(empty($_POST["post_title"])){
			$errors["post_title"] = "Title can't be empty!";
		}
		else{
			$post_title = $_POST["post_title"];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$post_title)){
				$errors["post_title"]= "Title must be spaces and letters only";
			}
		}

		if(empty($_POST["post_content"])){
			$errors["post_content"] = "Content can't be empty!";
		}
		else{
			$post_content = $_POST["post_content"];
			
		}

		if(array_filter($errors)){

		}
		else{
			$email = mysqli_real_escape_string($conn, $_POST["email"]);
			$post_title = mysqli_real_escape_string($conn, $_POST["post_title"]);
			$post_content = mysqli_real_escape_string($conn, $_POST["post_content"]);
			$sql = "INSERT INTO post(post_title, post_content) VALUES($post_title', '$post_content')";

			if(mysqli_query($conn, $sql)){
				header("Location: index.php");
			}
			else{
				echo "Query error: ". mysqli_connect_error($conn);
			}
		}

	}




?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>Submit Post</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">

<style>
	.red-text{
		color: red;
	}
</style>


</head>
<body>

<div class="super_container">

	<!-- Header -->
	<?php include("templates/post-header.php") ?>
	
	
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/regular.jpg" data-speed="0.8"></div>
		<div class="home_content">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<!-- Post Comment -->
						<div class="post_comment">
							<div class="contact_form_container">
								
								<form action="submit-post.php" method = "post">
									<!--<input type="text" class="contact_input contact_input_name" placeholder="Your Name" required="required">-->
									

									<input type="text" class="contact_input contact_input_email" placeholder="Post Title" name = "post_title">
									<div class="red-text"><?php echo $errors["post_title"];?></div>
									
									<!-- User content-->
									<textarea class="contact_text" placeholder="Your Post" name = "post_content"></textarea>
									<div class= "red-text"><?php echo $errors["post_content"];?></div>
									<button type="submit" class="contact_button" name = "post_btn">Post</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>

	<!-- Footer -->

	<?php include("templates/footer.php") ?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/contact.js"></script>
</body>
</html>