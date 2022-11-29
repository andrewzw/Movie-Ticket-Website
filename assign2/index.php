<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="description" content="GOI Cinemas - Home" />
	<meta name="keywords" content="HTML,CSS,Javascript" />
	<meta name="author" content="Gang of Islands" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">

	<!-- Preload background images to prevent flickering -->
	<link rel="preload" href="./styles/images/preview_1.jpg" as="image">
	<link rel="preload" href="./styles/images/preview_2.jpg" as="image">
	<link rel="preload" href="./styles/images/preview_3.jpg" as="image">

	<title>GOI Cinemas</title>
</head>

<body>
	<?php include_once 'includes/menu.php'; ?>

	<section class="titleContainer">
		<h1 class="title" id="floatingTitleText">A new way to experience Cinema</h1>
		<h2 class="title" id="fadeInText">At GOI Cinema</h2>
	</section>

	<div id='moreInfo'>
		<div class="seperator">
			<hr />
		</div>

		<section class='moreInfoCard'>
			<p class="moreInfoText">
				Enjoy your favourite movies with state of the art sound.
				<br>
				The way the creators intended the audio to be with <u>Dolby Atmos</u>.
				<br>
				A spatial sound experience that draws you in deeper, so you hear more and feel more.
			</p>

			<img src="./images/preview/Dolby.png" alt="Logo">
		</section>

		<div class="seperator">
			<hr />
		</div>

		<section class='moreInfoCard'>
			<p class="moreInfoText">
				Designed in collaboration <u>Herman Miller</u>. Designed for people. Designed for you.
				<br>
				Sink into experience with our excellent theatre seating options.
			</p>

			<img src="./images/preview/Seating.jpg" alt="Seating image">
		</section>
	</div>
	
    <?php include_once 'includes/footer.php'; ?>  
</body>

</html>