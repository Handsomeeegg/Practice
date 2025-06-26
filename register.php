<?php include_once __DIR__ . '/includes/head/head-3.php'; ?>

<body>
	<div id="colorlib-page">
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" role="navigation">
				<?php include_once __DIR__ . '/init/init.php'; 
				echo $initMenu->htmlMenu($menuArray); ?>
			</nav>
		</aside>
		<div id="colorlib-main">
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Регистрация</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
					
							<form action="register.php" method="post" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" class="form-control <?= $user->name_error ? "is-invalid" : "" ?>" placeholder="Your Name" name="name" value="<?= $user->name; ?>">
									<div class="invalid-feedback">
										<?= $user->name_error; ?>
									</div>

								</div>
								<div class="form-group">
									<input type="text" class="form-control <?=$user->surname_error ? "is-invalid" : "" ?>" placeholder="Your Surnameame" name="surname" value="<?= $user->surname; ?>">
									<div class="invalid-feedback">
										<?= $user->surname_error; ?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control <?=$user->patronymic_error ? "is-invalid" : "" ?>" placeholder="Your Patronymic" name="patronymic" value="<?= $user->patronymic; ?>">
									<div class="invalid-feedback">
										<?= $user->patronymic_error; ?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control <?=$user->login_error ? "is-invalid" : "" ?>" placeholder="Your Login" name="login" value="<?= $user->login; ?>">
									<div class="invalid-feedback">
										<?= $user->login_error; ?>
									</div>
								</div>
								<div class="form-group">
									<input type="email" class="form-control <?= $user->email_error ? "is-invalid" : "" ?>" placeholder="Your Email" name="email" value="<?= $user->email; ?>">
									<div class="invalid-feedback">
										<?= $user->email_error; ?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" class="form-control <?= $user->password_error ? "is-invalid" : "" ?>" placeholder="Password" name="password" value="<?= $user->password; ?>">
									<div class="invalid-feedback">
										<?= $user->password_error; ?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" class="form-control <?=($user->password_repeat_error) ? "is-invalid" : "" ?>" placeholder="Password repeat"
										name="password_repeat" value="<?= $user->password_repeat; ?>">
									<div class="invalid-feedback">
										<?= $user->password_repeat_error ?>
									</div>
								</div>



								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input is-invalid" type="checkbox" value="" id="rules"
											aria-describedby="invalidCheck3Feedback" required>
										<label class="form-check-label" for="rules">
											Rules
										</label>
										<div id="rulesFeedback" class="invalid-feedback">
											Необходимо согласиться с правилами регистрации.
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Регистрация" class="btn btn-primary py-3 px-5">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->
	<?php include_once __DIR__ . '/includes/pre-loader.php'; ?>
	<?php include_once __DIR__ . '/includes/script/script2.php'; ?>
</body>

</html>