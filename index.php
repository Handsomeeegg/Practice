<?php include_once __DIR__ . "/includes/head/head-min.php";?>
<html lang="en">
<body>
	<div id="colorlib-page">
    	<aside id="colorlib-aside" role="complementary" class="js-fullheight">
      		<nav id="colorlib-main-menu" role="navigation">
        		<?php include_once __DIR__ . '/init/init.php'; 
        		echo $initMenu->htmlMenu($menuArray); ?> 
      		</nav>
    	</aside> 
		<div id="colorlib-main">
		<div style="padding: 40px 0 0 20px;">
  			<h1 style="font-size: 50px; margin: 0;">Лента постов</h1>
			</div>
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row d-flex">
						<div class="col-xl-8 col-md-8 py-5 px-md-2">
							<div class="row pt-md-4">
								<?php if (!empty($posts)): ?>
									<?php foreach ($posts as $postItem): ?>
										<div class="col-md-12">
											<div class="blog-entry ftco-animate d-md-flex">
												<div class="text text-2 pl-md-4">
													<h3><a
															href="<?= $response->getLink('post.php', ['id' => $postItem->id]) ?>">
															<?= $postItem->title ?>
														</a></h3>
													<div class="meta-wrap">
														<p class="meta">
															<span><?= $postItem->user->login ?></span>
															<span><?= $post->formatPostDate($postItem->created_at) ?></span>
														</p>
													</div>
													<p><?= $postItem->preview ?></p>
													<p><a href="<?= $response->getLink('post.php', ['id' => $postItem->id]) ?>"
															class="btn-custom">
															Подробнее...
														</a></p>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php else: ?>
									<div class="col-md-12">
										<div class="alert alert-info">Нет постов</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<?php include_once __DIR__ . '/includes/pre-loader.php';?>
  <?php include_once __DIR__ . '/includes/script/inc/base.inc.php';?>
</body>
</html>