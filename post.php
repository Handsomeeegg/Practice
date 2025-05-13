<?php include_once __DIR__ . "/includes/head/head-min.php";?>
<html lang="en">
<body>
	<div id="colorlib-page">
    	<aside id="colorlib-aside" role="complementary" class="js-fullheight">
      		<nav id="colorlib-main-menu" role="navigation">
        		<?php include_once __DIR__ . '/init.php'; 
        		echo $init->htmlMenu($menuArray); ?> 
      		</nav>
    	</aside> 
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 px-md-3 py-5">
							<div>
								<a href="" class="text-warning" style="font-size: 1.8em;" title="Редактировать">🖍</a>
								<a href="" class="text-danger" style="font-size: 1.8em;" title="Удалить">🗑</a>
							</div>

							<div class="post">
								<h1 class="mb-3">тема поста</h1>
								<div class="meta-wrap">
									<p class="meta">
										<!-- <img src='avatar.jpg' /> -->
										<span class="text text-3">login</span>
										<span><i class="icon-calendar mr-2"></i>June 28, 2019</span>
										<span><i class="icon-comment2 mr-2"></i>6 Comment</span>
									</p>
								</div>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, eius
									mollitia
									suscipit, quisquam doloremque distinctio perferendis et doloribus unde
									architecto
									optio laboriosam porro adipisci sapiente officiis nemo accusamus ad
									praesentium?
									Esse minima nisi et. Dolore perferendis, enim praesentium omnis, iste
									doloremque
									quia officia optio deserunt molestiae voluptates soluta architecto tempora.
								</p>
								<p>
									Molestiae cupiditate inventore animi, maxime sapiente optio, illo est nemo
									veritatis
									repellat sunt doloribus nesciunt! Minima laborum magni reiciendis qui
									voluptate
									quisquam voluptatem soluta illo eum ullam incidunt rem assumenda eveniet
									eaque
									sequi
									deleniti tenetur dolore amet fugit perspiciatis ipsa, odit. Nesciunt dolor
									minima
									esse vero ut ea, repudiandae suscipit!
								</p>
								<p>
									<img src="images/image_1.jpg" alt="" class="img-fluid">
								</p>
								<div>
									<a href="" class="text-warning" style="font-size: 1.8em;"
										title="Редактировать">🖍</a>
									<a href="" class="text-danger" style="font-size: 1.8em;" title="Удалить">🗑</a>
								</div>

							</div>
							<div class="comments pt-5 mt-5">
								<h3 class="mb-5 font-weight-bold">6 комментариев</h3>
								<ul class="comment-list">
									<li class="comment">
										<!-- avatar
												<div class="vcard bio">
												<img src="images/person_1.jpg" alt="Image placeholder">
											</div> -->
										<div class="comment-body">
											<div class="d-flex justify-content-between">
												<h3>John Doe</h3>
												<a href="" class="text-danger" style="font-size: 1.8em;"
													title="Удалить">🗑</a>
											</div>
											<div class="meta">October 03, 2018 at 2:21pm</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit.
												Pariatur
												quidem laborum necessitatibus, ipsam impedit vitae autem, eum
												officia, fugiat saepe enim sapiente iste iure! Quam voluptas
												earum
												impedit necessitatibus, nihil?
											</p>
											<!-- <p><a href="#" class="reply">Ответить</a></p> -->
										</div>
									</li>
									<li class="comment">
										<!-- avatar
												<div class="vcard bio">
												<img src="images/person_1.jpg" alt="Image placeholder">
											</div> -->
										<div class="comment-body">
											<div class="d-flex justify-content-between">
												<h3>John Doe</h3>
												<a href="" class="text-danger" style="font-size: 1.8em;"
													title="Удалить">🗑</a>
											</div>
											<div class="meta">
												October 03, 2018 at 2:21pm
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit.
												Pariatur
												quidem laborum necessitatibus, ipsam impedit vitae autem, eum
												officia, fugiat saepe enim sapiente iste iure! Quam voluptas
												earum
												impedit necessitatibus, nihil?
											</p>
											<!-- <p><a href="#" class="reply">Ответить</a></p> -->
										</div>

									</li>
								</ul>
								<!-- END comment-list -->
								<div class="comment-form-wrap pt-5">
									<h3 class="mb-5">Оставьте комментарий</h3>
									<form action="#" class="p-3 p-md-5 bg-light">
										<div class="form-group">
											<label for="message">Сообщение</label>
											<textarea name="message" id="message" cols="30" rows="10"
												class="form-control"></textarea>
										</div>
										<div class="form-group">
											<input type="submit" value="Отправить" name="send_comment"
												class="btn py-3 px-4 btn-primary">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div><!-- END-->
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->
	<?php include_once __DIR__ . '/includes/pre-loader.php';?>
  <?php include_once __DIR__ . '/includes/script/inc/base.inc.php';?>
</body>
</html>