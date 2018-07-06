<?php 
	require 'app/init.php';

	if (isset($_GET['q'])) {
		$q = $_GET['q'];

		$query = $client->search([
			'body' => [
				'query' => [
					'bool' => [
						'should' => [
							'match' => ['title' => $q],
							'match' => ['body' => $q],
							'match' => ['keywords' => $q]
						]
					]
				]
			]
		]);

		// echo '<pre>', print_r($query), '</pre>';

		// die();

		if ($query['hits']['total'] >=1) {
			$results = $query['hits']['hits'];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Searcy | ES</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<form class="form-signin" action="index.php" method="get" autocomplete="off">
						<div class="form-label-group mb-4">
							<label for="">search for something</label>
					        <input class="form-control" placeholder="search..." type="text" name="q">
					        
					        <!-- <br> -->
					     </div>
						
						<input class="btn btn-lg btn-primary btn-block" type="submit" value="Search">
						
					</form>

					<?php 
					if (isset($results)) {
						foreach ($results as $r) {
							?>

							<div class="result">
								<a href="#<?php echo $r['_id'] ?>"><?php echo $r['_source']['title']; ?></a>
								<div class="result-keywords"><?php echo implode(',', $r['_source']['keywords']); ?></div>
							</div>

							<?php
						}
					}
					 ?>
				</div>
			</div>
		</div>
	</body>
</html>