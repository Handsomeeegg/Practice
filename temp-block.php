<?php include_once __DIR__ . '/includes/head/head-2.php';?>
<body>
	<div id="colorlib-page">
    	<aside id="colorlib-aside" role="complementary" class="js-fullheight">
      		<nav id="colorlib-main-menu" role="navigation">
        		<?php include_once __DIR__ . '/init/init.php'; 
        		echo $initMenu->htmlMenu($menuArray); ?> 
      		</nav>
    	</aside> 
		<div id="colorlib-main">
			<section class="contact-section px-md-2  pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Временная блокировка пользователя</h2>
							<div>
								Пользователь: login
							</div>
						</div>
					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
							<form action="#" class="bg-light p-5 contact-form">
								<div class="form-group">
									<label for="date-block">Дата временной блокировки</label>
									<input type="text" class="form-control" id="date-block" name="date_block" value=""
										required>
								</div>
								<div class="form-group">
									<input type="submit" value="Блокировать" class="btn btn-primary py-3 px-5">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->
	<?php include_once __DIR__ . '/includes/pre-loader.php';?>
  <?php include_once __DIR__ . '/includes/script/script3.php';?>
</body>
</html>