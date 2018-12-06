<?php 
include_once './../config.php';
// Initialize the session
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="description" content="The website belonging to Pendulum">
	<meta name="keywords" content="Pendulum, music, artist, drum, bass">
	<title>Admin</title>
	<link rel="stylesheet" href="./../content/css/jquery-ui.css">
	<link rel="stylesheet" href="./../content/css/bootstrap.css">
	<link rel="stylesheet" href="./../content/css/style.css">

	<script src="./../content/js/vendor/jquery.min.js"></script>
	<script src="./../content/js/vendor/jquery-ui.min.js"></script>
	<script src="./../content/js/vendor/popper.min.js"></script>
	<script src="./../content/js/vendor/bootstrap.js"></script>
	<script src="./../content/js/main.js"></script>
</head>

<body>
	<main class='main'>
		<section id='userAdmin'>
			<div class="container">
				<h1>User admin</h1>
				<table class="table">
					<thead>
						<td>Id</td>
						<td>Username</td>
						<td>Email</td>
						<td>Created</td>
					</thead>

					<?php
						$sql = "SELECT * FROM users";
						
						if($stmt = $pdo->prepare($sql)){
							if($stmt->execute()){
								$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
								// print_r($results);

								foreach ($results as $result) {
									echo '<tr>';
									echo '<td>'. $result['id'] .'</td>';
									echo '<td>'. $result['username'] .'</td>';
									echo '<td>'. $result['email'] .'</td>';
									echo '<td>'. $result['created_at'] .'</td>';
									echo '</tr>';
								}


							}
						}
						
						// Close statement
						unset($stmt);
						//
					?>

				</table>
			</div>
		</section>

		<section id='voteAdmin'>
			<div class="container">
				<h1>Vote admin</h1>
				<table class="table">
					<thead>
						<td>Id</td>
						<td>Username</td>
						<td>Email</td>
						<td>Created</td>
						<td>Actions</td>
					</thead>

					<?php
						// $sql = "SELECT * FROM trackvote";
						
						// if($stmt = $pdo->prepare($sql)){
						// 	if($stmt->execute()){
						// 		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						// 		// print_r($results);

						// 		foreach ($results as $result) {
						// 			echo '<tr>';
						// 			echo '<td>'. $result['username'] .'</td>';
						// 			echo '<td>'. $result['track'] .'</td>';
						// 			echo '<td>'. $result['weight'] .'</td>';
						// 			echo '<td>'. $result['created_at'] .'</td>';
						// 			echo '';
						// 			echo '</tr>';
						// 		}


						// 	}
						// }
						
						// // Close statement
						// unset($stmt);
						// //
					?>

				</table>
			</div>

		</section>
		

		<footer class='footer'>
			<div class='container'>
				<p>
				&copy; PENDULUM 2018
				</p>
			</div>
		</footer>
	</main>

</body>
</html>