<?php 
include_once './config.php';
// Initialize the session
session_start();

$bool_authenticated = false;
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $bool_authenticated = true;
}
?>

<!DOCTYPE html>
<html class="<?php echo $bool_authenticated ? " authenticated":"" ?>">
<?php 
	include 'components/head.php';
?>

<body class="eupopup eupopup-bottom">
	<header class='header'>
		<?php
			include_once 'components/navbar.php'; 
		?>
	</header>

	<main class='main'>
		<section id='landing'>
			<?php
				include 'components/carousel.php'
			?>
		</section>

		<section id='info'>
			<div class='container'>
			<h2>About Our Tour</h2>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia est quis quo eaque consequuntur obcaecati repellendus illum dolorum sapiente laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum totam rerum doloremque eius laboriosam! Accusamus architecto magnam iste repudiandae numquam, obcaecati iure nulla corrupti delectus beatae cum possimus, dicta in.</p>
			<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae illum excepturi minus nostrum vitae repellendus alias nihil rerum distinctio reiciendis placeat at, modi accusamus quaerat? Vero ex sapiente quisquam! Qui?</p>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus nam praesentium cum amet esse consectetur incidunt, cupiditate velit dicta animi expedita pariatur magni provident explicabo aperiam eligendi nobis quisquam enim? Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, quo iusto vel ducimus nesciunt, eos a earum unde laboriosam quibusdam qui veritatis ipsam facere deleniti optio saepe exercitationem! Cum, quam.</p>
			</div>
		</section>
		<section id='dates'>
			<div class='container'>
				<h2>Tour Dates</h2>
				<?php
					include 'components/events.php'
				?>
			</div>
		</section>
		<section id='vote'>
			<div class='container'>
				<h2>We Need Your Help!</h2>
				<p>We've made a lot of good songs together over the years and when it comes to chosing which is our favourite we just can't choose!</p>
				<p>Take your pick of the the top 5 songs on currently on Spotify that you want us to open with.</p>
				
				<?php

					$sql = "SELECT track,COUNT(*) as votes FROM trackvote GROUP BY track ORDER BY votes DESC";
							// SELECT track,COUNT(*) as votes FROM trackvote GROUP BY track ORDER BY votes DESC
											
					if($stmt = $pdo->prepare($sql)){
						if($stmt->execute()){
							if($stmt->rowCount() >= 1){
								$results = $stmt->fetch(PDO::FETCH_ASSOC);
								// print_r($results);
								echo '<p>So far you&apos;ve all made the most noise for:</p>';
								echo '<iframe src="https://open.spotify.com/embed/track/'. $results['track'] .'" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';

								// foreach ($results as $result) {
								// 	echo '<tr>';
								// 	echo '<td>'. $result['id'] .'</td>';
								// 	echo '<td>'. $result['username'] .'</td>';
								// 	echo '<td>'. $result['email'] .'</td>';
								// 	echo '<td>'. $result['created_at'] .'</td>';
								// 	echo '</tr>';
								// }

							}


						}
					}

					// Close statement
					unset($stmt);
					if($bool_authenticated){
						if (!isset($_SESSION["voted"])) {
							echo '<p>Make yourself heard, tell us what you want!</p>';
							include 'components/vote.php';
						}
					} else {
						echo '<p>Make yourself heard, tell us what you want!</p>';
						echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#authModal">
							Register
						</button>';
						// include 'components/login.php';
						// include 'components/register.php';
					}
				?>
				<!-- <form > -->
			</div>
		</section>
		<section id='bio'>
			<div class='container'>
				<h2>Biography</h2>
				<p>Pendulum formed in their home-town of Perth (Western Australia) in 2002, when producers Rob Swire and Gareth McGrillen teamed up with acclaimed local DJ Paul 'Elhornet' Harding. While their individual formative roots ranged from producing drum & bass, breakbeat and hardcore, to playing in metal and punk bands, their comparable talents proved an unstoppable force when they managed to single-handedly conquer the world of drum & bass in their first 12 months together.</p>
				<p>"We want our music to be an escape. While technology continues to constantly advance production techniques and (arguably) sound quality, something has been lost in the process - that original sense of self-escape, the idea of leaving yourself open to experience something you don't necessarily find in every-day life. That was the energy we picked up on and liked about electronic music when we first got into it. It felt like the same energy found with bands like Led Zeppelin and even The Beatles, and still occasionally today with bands like Tool, The Mars Volta, Queens Of The Stone Age and others.</p>
				<p>To us, it made perfect sense to combine the best of both worlds, but it had to be done in a way that didn't make it sound obvious. In the last 10 years you've had all these bands that tried to cross the bridge by recruiting a turntablist / using a synthesizer on their new single, or electronic artists who just threw an obvious guitar sample into a tune...but eventually it just came across as a gimmick or a bit cheesy. We thought we'd try and do it properly, because to us it still hasn't been done right and theres a lot of room for exploration.</p>
				<p>If you turn on the radio today you'll hear 20 tracks in a row describing someone's every-day life, or songs with a one-line catchphrase chorus about shaking your ass in the club - the production is usually great but when you look deeper, there's nothing behind it...it doesn't offer you anything past its face value. We want to hear something different and exciting, but the material we want to hear isn't getting made. Thats why we spend nearly every waking moment trying to create music that takes you out of this universe - for ourselves and anyone else who wants to listen."</p>
			</div>
		</section>

		<footer class='footer'>
			<div class='container'>
				<p>
				&copy; PENDULUM 2018
				</p>
			</div>
		</footer>

		
		<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Login & Register</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="col-sm-12 col-md-6">
									<?php include 'components/login.php'; ?>
								</div>
								<div class="col-sm-12 col-md-6">
									<?php include 'components/register.php'; ?>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div> -->
				</div>
			</div>
		</div>
	</main>

</body>
</html>