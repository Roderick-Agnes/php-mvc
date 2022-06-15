<?php require_once "components/header.php" ?>

<body class="goto-here">
	<?php require_once "components/navbar.php" ?>
	<?php require_once "components/slider.php" ?>

	<?php require_once "components/category.php" ?>

	<div id="main" class="main-content">
		<?php require_once "./mvc/views/pages/" . $data["Page"] . ".php" ?>
	</div>

	<?php require_once "components/footer.php" ?>


</body>

</html>