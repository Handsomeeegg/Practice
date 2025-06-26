<?php include_once __DIR__ . "/includes/head/head-min.php";?>
<html lang="en">
<body>
		<div id="colorlib-main">
			<!--<div style="padding: 40px 0 0 10px; background: #FAF0E6;">-->
			<div style="padding: 40px 0 0 10px;">
				<h1 style="font-size: 50px; margin: 0;">Cписок всех постов</h1>
			</div>
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row d-flex">
						<div class="col-xl-8 col-md-8 py-5 px-md-2">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<?php if (!$initUser->isGuest && !$initUser->isAdmin): ?>
										<div class="text-end mb-3 me-4">
											<a href="<?= $response->getLink('/practic_php/post-create.php') ?>"
												class="btn btn-success">📝Создать пост</a>
										</div>
									<?php endif; ?>
								</div>
								<div class="row pt-md-4">
									<?php if (!empty($posts)): ?>
										<?php foreach ($posts as $postItem): ?>
											<div class="col-md-6 mb-4 d-flex align-items-stretch"> <!-- Изменено -->
												<div class="blog-entry ftco-animate d-flex flex-column">
													<div class="text text-2 pl-md-3">
														<h3 class="mb-2">
															<a
																href="<?= $response->getLink('/practic_php/post.php', ['id' => $postItem->id]) ?>">
																<?= $postItem->title ?>
															</a>
														</h3>
														<div class="meta-wrap">
															<p class="meta">
																<span class="text text-3"><?= $postItem->user->login ?></span>
																<span><?= $post->formatPostDate($postItem->created_at) ?></span>
															</p>
														</div>
														<p class="mb-4"><?= $postItem->preview ?? '' ?></p>
														<div class="d-flex pt-1 justify-content-between mt-auto">
															<div>
																<a href="<?= $response->getLink('/practic_php/post.php', ['id' => $postItem->id]) ?>"
																	class="btn-custom">Подробнее...</a>
															</div>
															<?php if (!$initUser->isGuest && isset($postItem->author_id) && $initUser->id == $postItem->author_id): ?>
																<div>
																	<a href="<?= $response->getLink('/practic_php/post-create.php', ['id' => $postItem->id]) ?>"
																		class="text-warning" title="Редактировать">🖍</a>
																</div>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>

									<?php else: ?>
										<div class="col-md-12">
											<div class="alert alert-info">Нет доступных постов</div>
										</div>
									<?php endif; ?>
								</div> <!-- END row pt-md-4 -->
							</div>
						</div>
					</div>
			</section>
		</div> <!-- END COLORLIB-MAIN -->
	</div> <!-- END COLORLIB-PAGE -->
	<?php include_once __DIR__ . '/includes/pre-loader.php';
  	include_once __DIR__ . '/includes/script/inc/base.inc.php';
  	if (!$initUser->isGuest && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
    	$postId = (int) $_GET['id'];
    	$post1 = $post->findOne($postId);
    		if ($post1 && ($initUser->id === $post->user->id || $initUser->isAdmin)) {
        		$post->delete();
        		$response->redirect('/practic_php/posts.php');
    }
	}?>
</body>
</html>