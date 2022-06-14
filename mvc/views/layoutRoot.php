<?php require "components/header.php" ?>

<body class="goto-here">
	<?php require "components/navbar.php" ?>
	<?php require "components/slider.php" ?>

	<?php require "components/categories.php" ?>

	<div id="main" class="main-content">
		<?php require "./mvc/views/pages/" . $data["Page"] . ".php" ?>
	</div>

	<?php require_once "components/categories.php" ?>

	<?php require_once "components/footer.php" ?>


</body>

</html>