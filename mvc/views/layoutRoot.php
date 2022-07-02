<?php require_once "./mvc/views/components/user/header.php" ?>

<body class="goto-here">
	<?php require_once "components/user/navbar.php" ?>

	<div id="main" class="main-content">
		<?php require_once "./mvc/views/pages/user/" . $data["Page"] . ".php" ?>
	</div>

	<?php require_once "./mvc/views/components/user/footer.php" ?>


</body>

</html>