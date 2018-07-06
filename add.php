<?php 
	require 'app/init.php';

	if (!empty($_POST)) {
		if (isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {
			$title = $_POST['title'];
			$body = $_POST['body'];
			$keywords = explode(',',$_POST['keywords']);

			$indexed = $client->index([
				'index' => 'articles',
				'type' => 'article',
				'body' => [
					'title' => $title,
					'body' => $body,
					'keywords' => $keywords
				]
			]);

			if ($indexed) {
				// print_r($indexed);
				echo "add";
			}
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add | ES</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<form class="form-signin" action="add.php" method="post" autocomplete="off">
						<div class="form-label-group mb-4">
						<label>
							Title </label>
							<input class="form-control" type="text" name="title">
						
						</div>
						<div class="form-label-group mb-4">
						<label>
							Body </label>
							<textarea class="form-control" name="body" rows="8"></textarea>
						
						</div>
						<div class="form-label-group mb-4">
						<label>
							Keywords</label>
							<input class="form-control" type="text" name="keywords" placeholder="comma, separated">
						
						</div>
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Add">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>