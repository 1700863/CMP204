<!DOCTYPE html>
<html>
<?php 
	include 'components/head.php';
?>

<body>
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
				<p>Register and vote below for your favourite tracks. This lets you decide what our opening track will be at each event!</p>
				<?php
					include 'components/login.php';
					include 'components/register.php';
				?>
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
	</main>

</body>
</html>