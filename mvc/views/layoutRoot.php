<?php require_once "./mvc/views/components/header.php" ?>

<body class="goto-here">
	<?php require_once "components/navbar.php" ?>

	<div id="main" class="main-content">
		<?php require_once "./mvc/views/pages/" . $data["Page"] . ".php" ?>
	</div>

	<?php require_once "./mvc/views/components/footer.php" ?>


</body>

</html>