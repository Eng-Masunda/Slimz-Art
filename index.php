<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//send email when submit button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try {

		//Collecting user input from form
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$message = trim($_POST['message']);
		$sent = false;

		//Authenticating email
		if (!isset($error_message) and !$mail->validateAddress($email)) {
			$error_message = "Please specify a valid email address";
		}

		if (!isset($error_message)) {
			//to prevent email injection attack
			foreach ($_POST as $value) {
				if (stripos($value, 'Content-Type:') !== FALSE) {
					$error_message = "There was a problem with the information you entered.";
				}
			}
		}

		//to prevent spam attack use honeypot method(add invisible field)
		if (!isset($error_message) and ($_POST['address'] != "")) {
			$error_message = "Your form submission has an error.";
		}

		if (!isset($error_message)) {
			//Server settings
			$mail->SMTPDebug  = SMTP::DEBUG_OFF;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = "smtp.gmail.com";                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'user-email@gmail.com';                     // SMTP username
			$mail->Password   = 'user-email-password';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			//Recipients
			$mail->setFrom($email, $name); // sender
			$mail->addAddress('iengineerwebsolutions@gmail.com');     // Add a recipient

			// Content
			$email_message = '';
			$email_message = $email_message . 'Name: ' . $name . '<br><br>';
			$email_message = $email_message . 'Email: ' . $email . '<br><br>';
			$email_message = $email_message . 'Message' . $message . '<br>';
			$body = $email_message; //content for email body
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Client Mail from website';
			$mail->Body    = $body;
			$mail->AltBody = strip_tags($body);

			//Attachment
			//$mail->addAttachment("img/nakamura.jpg");

			$mail->send();
			$sent = true;
			//if sent successfully redirect to Thank You Page
			header("Location:index.php?status=thanks");
			exit;
		} else {
			echo "<div class='error'>
					<p>Could not send your message, please check your submission information and try again...</p>
					<a href='#contact' class='btn btn-secondary btn-lg'>Close</a>
				</div>";
		}
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--SEO meta tags-->
	<meta name="description" content="Graphic designer, Digital illustrator, Logo Designer and Artist operating in Harare Zimbabwe. I specialize in Designer projects, branding, painting, sketching, drawing and cartoon sketching. ">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<!--FontAwesome cdn-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<!--FontAwesome Kit-->
	<script src="https://kit.fontawesome.com/54f3cec14a.js" crossorigin="anonymous"></script>
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/style.css" />

	<!--CK editor-->
	<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>

	<!--Google font-->
	<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">

	<title>Thulani Sean Jagada | Graphics Designer & Digital illustrator</title>
</head>

<body>
	<!--Bootstrap container to hold all our html-->
	<div class="container-fluid">
		<?php if (isset($_GET['status']) && $_GET['status'] == 'thanks') { ?>
			<div class="thank-u-msg">
				<h1 class="display-2">Thank You!</h1>
				<a href="index.php">
					<div class="btn btn-secondary btn-lg">Continue</div>
				</a>
			</div>
		<?php } else { ?>
			<!--Page Loading-->
			<div class="loader">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<p>Just a moment, your page is loading...</p>
			</div>
			<!--Header section will contain the nav-bar, logo and social media links-->
			<header id="top">
				<!--Nav bar-->
				<nav class="navbar navbar-expand-lg navbar-light nav-styles">
					<!--Logo-->
					<nav class="navbar navbar-light ">
						<a class="navbar-brand" href="#contact">
							<img src="gallery/logo.jpg" alt="Logo" loading="lazy" class="logo-styles" />
						</a>
					</nav>
					<!--Hamburger menu-->
					<button class="navbar-toggler hamburger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<!--Nav links-->
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
								<a class="nav-link" href="#about">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#work">Work</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#contact">Contact</a>
							</li>
						</ul>
					</div>


					<!--Social media icons-->
					<div class="social-links">
						<ul>
							<li>
								<a href="https://www.facebook.com/Slimz-Art-101281915064013/" target="_blank"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="https://www.instagram.com/slimzart1/" target="_blank"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="https://www.linkedin.com/in/thulani-jagada-1680031b1/" target="_blank"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
							</li>
						</ul>
					</div>
				</nav>
				<!--Jumbotron-->
				<div class="jumbotron jumbotron-fluid bg-transparent hero">
					<div class="container hero-txt-container">
						<h1 class="display-4 hero-headline">I am Thulani Sean Jagada</h1>
						<p class="hero-txt lead">Welcome to my World</p>
					</div>
				</div>

				<!--Mouse to prompt user to scroll down-->
				<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-mouse mouse-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3zm4 8V5a4 4 0 0 0-8 0v6a4 4 0 0 0 8 0zM8 0a5 5 0 0 0-5 5v6a5 5 0 0 0 10 0V5a5 5 0 0 0-5-5z" />
				</svg>
			</header>
			<hr>
			<!--Main Section-->
			<section>
				<div class="container">
					<div class="row">
						<!--Column will contain Main content-->
						<main class="col-md-9 large-column" id="about">
							<!--Content text for Sketch Artist-->
							<div class="sketch-artist">
								<h2 class="sketch-artist-heading">I am a Sketch Artist</h2>
								<p class="sketch-artist-content">
									Naturally gifted in the art of pencil sketching, I can draw simple cartoon pencil sketches to more complex art pieces such as face portraits and landscape drawings.
								</p>
							</div>
							<!--image for sketch artist-->
							<div class="container img-container ">
								<img class="sketch-img1" src="img/sketch.jpg" alt="sketch artist image" class="img-fluid" />
								<img class="sketch-img2" src="img/sketch2.jpg" alt="sketch artist image" />
							</div>

							<!--Content text for Cartoonist-->
							<div class="cartoonist">
								<h2 class="cartoon-header">I am a Cartoonist</h2>
								<p class="cartoon-content">
									From the early ages of kindergarten and primary schooling, I discovered my passion for cartoons and decided to make it my life's work.
								</p>
							</div>
							<!--image for cartoonist-->
							<div class="container cartoon-img-container">
								<img class="cartoon-img" src="img/cartoonist.jpg" alt="cartoonist image" />
							</div>

							<!--Content text for Painter-->
							<div class="painter">
								<h2 class="painter-header">I am a Painter</h2>
								<p class="painter-content">
									My talents extend well beyond cartoon sketching and pencil drawing. Painting comes naturally as do all my other artistic talents.
								</p>
							</div>
							<!--image for Painter-->
							<div class="container img-container">
								<img class="painter-img1" src="img/painter.jpg" alt="painter image" />
								<img class="painter-img2" src="img/painter2.jpg" alt="painter image" />
							</div>

							<!--Content text for digital illustrator-->
							<div class="digital-illustrator">
								<h2 class="digital-header">I am a Digital illustrator</h2>
								<p class="digital-content">
									We are living in the digital age, as with most technologies we are witnessing a shift towards digitization of media. As a result of the trend, I have also acquired the necessary skills to produce digital art works using different software tools.
								</p>
							</div>
							<!--image for Digital illustrator-->
							<div class="container digital-img-container">
								<img class="digital-img" src="img/digital_illustrator.jpg" alt="digital illustrator image" />
							</div>

							<!--Content text for Graphics Designer-->
							<div class="graphics-designer">
								<h2 class="designer-header">I am a Graphics Designer</h2>
								<p class="designer-content">
									If you need a logo, t-shirt brand or any type of graphic then I'm the guy you need to see.
								</p>
							</div>
							<!--image for Graphics Designer-->
							<div class="container img-container">
								<img class="designer-img1" src="img/graphics_designer.jpg" alt="graphics designer image" />
								<img class="designer-img2" src="img/graphics_designer2.jpg" alt="graphics designer image" />
							</div>

							<!--Content text for Artist-->
							<div class="artist">
								<h2 class="artist-header">I am an Artist</h2>
								<p class="artist-content">
									The sum of my talents. If you need any art piece done for you, please do not hesitate to reach out to me.
								</p>
							</div>
							<!--image for Artist-->
							<div class="container artist-img-container">
								<img class="artist-img" src="img/artist.jpg" alt="artist image" />
							</div>
							<hr>
							<!--About Section-->
							<section class="container about">
								<div class="about-img-div">
									<img class="about-img" src="img/slimz.jpeg" alt="Image of Thulani Jagada" />
								</div>
								<p class="about-txt">
									Hi, I'm sure we know each other by now. I'm your artist, now let me show you some of my works.
								</p>
							</section>
							<hr>
							<!--Work section-->
							<section>
								<div class="container">
									<h2 id="work">My Work...</h2>
									<!--Gallery list-->
									<div class="gallery">
										<div data-toggle="modal" data-target="#img1"><img class="img-fluid img-thumbnail rounded" src="gallery/1.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img2"><img class="img-fluid img-thumbnail rounded" src="gallery/2.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img3"><img class="img-fluid img-thumbnail rounded" src="gallery/3.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img4"><img class="img-fluid img-thumbnail rounded" src="gallery/4.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img5"><img class="img-fluid img-thumbnail rounded" src="gallery/5.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img6"><img class="img-fluid img-thumbnail rounded" src="gallery/6.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img7"><img class="img-fluid img-thumbnail rounded" src="gallery/7.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img8"><img class="img-fluid img-thumbnail rounded" src="gallery/8.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img9"><img class="img-fluid img-thumbnail rounded" src="gallery/9.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img10"><img class="img-fluid img-thumbnail rounded" src="gallery/10.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img11"><img class="img-fluid img-thumbnail rounded" src="gallery/11.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img12"><img class="img-fluid img-thumbnail rounded" src="gallery/12.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img13"><img class="img-fluid img-thumbnail rounded" src="gallery/13.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img14"><img class="img-fluid img-thumbnail rounded" src="gallery/14.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img15"><img class="img-fluid img-thumbnail rounded" src="gallery/15.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img16"><img class="img-fluid img-thumbnail rounded" src="gallery/16.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img17"><img class="img-fluid img-thumbnail rounded" src="gallery/17.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img18"><img class="img-fluid img-thumbnail rounded" src="gallery/18.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img19"><img class="img-fluid img-thumbnail rounded" src="gallery/19.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img20"><img class="img-fluid img-thumbnail rounded" src="gallery/20.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img21"><img class="img-fluid img-thumbnail rounded" src="gallery/21.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img22"><img class="img-fluid img-thumbnail rounded" src="gallery/22.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img23"><img class="img-fluid img-thumbnail rounded" src="gallery/23.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img24"><img class="img-fluid img-thumbnail rounded" src="gallery/24.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img25"><img class="img-fluid img-thumbnail rounded" src="gallery/25.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img26"><img class="img-fluid img-thumbnail rounded" src="gallery/26.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img27"><img class="img-fluid img-thumbnail rounded" src="gallery/27.png" alt="..."></div>

										<div data-toggle="modal" data-target="#img28"><img class="img-fluid img-thumbnail rounded" src="gallery/28.jpg" alt="..."></div>

										<div data-toggle="modal" data-target="#img29"><img class="img-fluid img-thumbnail rounded" src="gallery/29.jpg" alt="..."></div>

									</div>

									<!--Gallery image modals-->

									<!-- Modal img1 -->
									<div class="modal fade" id="img1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/1.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img2 -->
									<div class="modal fade" id="img2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/2.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img3 -->
									<div class="modal fade" id="img3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/3.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img4 -->
									<div class="modal fade" id="img4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/4.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img5 -->
									<div class="modal fade" id="img5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/5.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img6 -->
									<div class="modal fade" id="img6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/6.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img7 -->
									<div class="modal fade" id="img7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/7.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img8 -->
									<div class="modal fade" id="img8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/8.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img9 -->
									<div class="modal fade" id="img9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/9.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img10 -->
									<div class="modal fade" id="img10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/10.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img11 -->
									<div class="modal fade" id="img11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/11.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img12 -->
									<div class="modal fade" id="img12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/12.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img13 -->
									<div class="modal fade" id="img13" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/13.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img14 -->
									<div class="modal fade" id="img14" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/14.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img15 -->
									<div class="modal fade" id="img15" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/15.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img16 -->
									<div class="modal fade" id="img16" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/16.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img17 -->
									<div class="modal fade" id="img17" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/17.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img18 -->
									<div class="modal fade" id="img18" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/18.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img19 -->
									<div class="modal fade" id="img19" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/19.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img20 -->
									<div class="modal fade" id="img20" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/20.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img21 -->
									<div class="modal fade" id="img21" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/21.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img22 -->
									<div class="modal fade" id="img22" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/22.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img23 -->
									<div class="modal fade" id="img23" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/23.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img24 -->
									<div class="modal fade" id="img24" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/24.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img25 -->
									<div class="modal fade" id="img25" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/25.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img26 -->
									<div class="modal fade" id="img26" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/26.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img27 -->
									<div class="modal fade" id="img27" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/27.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img27 -->
									<div class="modal fade" id="img27" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/27.png" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img28 -->
									<div class="modal fade" id="img28" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/28.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<!-- Modal img29 -->
									<div class="modal fade" id="img29" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<img src="gallery/29.jpg" alt="...">
												</div>
											</div>
										</div>
									</div>

									<hr>
									<!--Contact section-->
									<section id="contact">
										<h2>Contact me...</h2>
										<p>Please feel free to call, text or message me on the following number and email address.</p>
										<div class="contact-tabs-container">
											<!--Phone-->
											<div class="contact-tabs">
												<a href="tel:+263774507921"><i class="fas fa-phone-alt fa-3x"></i></a>
												<p>+263774507921</p>
											</div>
											<!--WhatsApp number-->
											<div class="contact-tabs">
												<a href="https://api.whatsapp.com/send?phone=263774507921" target="_blank"><i class="fab fa-whatsapp fa-3x"></i></a>
												<p>+263774507921</p>
											</div>
											<!--Email address-->
											<div class="contact-tabs">
												<a href="mailto:slimzart@gmail.com"><i class="far fa-envelope fa-3x"></i></a>
												<p>slimzart@gmail.com</p>
											</div>
										</div>

										<!-- Button trigger modal -->
										<button type="button" class="btn cta-btn" data-toggle="modal" data-target="#exampleModal">
											Let's work together
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-bar-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
											</svg>
										</button>

										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content modal-styles">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Send me a message</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<!--Form-->

														<form class="msg-form" action="index.php" method="POST">
															<div class="form-group">

																<label for="name">Name</label>
																<input type="text" class="form-control" id="name" name="name" required value="<?php if (isset($name) && $sent === false) {
																																					echo htmlspecialchars($name);
																																				} else {
																																					echo "";
																																				} ?>
																<label for=" exampleInputEmail1">Email address</label>
																<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required value="<?php if (isset($email) && $sent === false) {
																																													echo htmlspecialchars($email);
																																												} else {
																																													echo "";
																																												} ?>">

																<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

																<label style="display: none;" for="contactAddress">Address</label>
																<input type="text" name="address" id="contactAddress" style="display: none;">

															</div>
															<div class="form-group">
																<label for="exampleFormControlTextarea1">Message</label>
																<textarea class="form-control" id="editor" rows="3" name="message"><?php if (isset($message) && $sent === false) {
																																		echo htmlspecialchars($message);
																																	} else {
																																		echo "";
																																	} ?></textarea>
															</div>
															<button type="submit" class="btn send-btn" value="send">Submit</button>
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</section>
						</main>
						<!--Column will contain Social media content-->
						<div class="container col-md-3 small-column">
							<div class="follow-me">
								<h2>Follow Me...</h2>
								<p>Please like, share and follow me on Facebook, Instagram and LinkedIn. I post most of my recent work on social media so make sure to click on any of the links below so you don't miss out... </p>
								<!--Social media icons-->
								<div>
									<div class="follow-fabs">
										<div>
											<a href="https://www.facebook.com/Slimz-Art-101281915064013/" target="_blank"><i class=" fa fa-facebook fa-2x" aria-hidden="true"></i></a>
										</div>
										<div>
											<a href="https://www.instagram.com/slimzart1/" target="_blank"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
										</div>
										<div>
											<a href="https://www.linkedin.com/in/thulani-jagada-1680031b1/" target="_blank"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
										</div>
										<div>
											<a href="#top">
												<svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-up-square to-top-arrow" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
													<path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
												</svg>
											</a>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
			</section>





			<!--Footer section-->
			<footer>
				<p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> SlimzArt 2020</p>
				<p>Website powered by <a href="https://www.i-engineerwebsolutions.co.zw/" target="blank">i-Engineer</a></p>
			</footer>
		<?php }; ?>
	</div>

	<!--CK editor JavaScript-->
	<script>
		ClassicEditor
			.create(document.querySelector('#editor'))
			.catch(error => {
				console.error(error);
			});
	</script>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!--Custom JS-->
	<script src="js/app.js"></script>
</body>

</html>
