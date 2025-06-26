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
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 px-md-3 py-5">
							<?php if (isset($post) && $post->id): ?>
								<!-- подшаманеный вариант, чтобы у меня ничего не съезжало при исчезновении каких-либо кнопок -->

								<div class="mb-3 d-flex gap-3 align-items-center">
    							<?php if (!$user->isGuest && ($user->id == ($post->user_id ?? 0)) && !$user->isAdmin): ?>
        							<a href="<?= $response->getLink('/practic_php/post-create.php', ['id' => $post->id]) ?>"
           								class="text-warning" style="font-size: 1.8em;" title="Редактировать">🖍</a>
    							<?php else: ?>
        							<span style="width: 1.8em;"></span>
   								 <?php endif; ?>

   								 <?php if (!$user->isGuest && (($user->id == $post->user_id && empty($comments)) || $user->isAdmin)): ?>
        							<a href="<?= $response->getLink('/practic_php/post.php',['id' => $post->id, 'action' => 'delete']) ?>"
           								class="text-danger" style="font-size: 1.8em;" title="Удалить" onclick="return confirm('Вы уверены?')">🗑</a>
    							<?php else: ?>
        							<span style="width: 1.8em;"></span>
    							<?php endif; ?>
								</div>
								<div class="post">
									<h1 class="mb-3"><?= $post->title ?></h1>
									<div class="meta-wrap">
										<p class="meta">
											<span>Автор: <?= $post->user->login ?></span>

											<span>Дата: <?= $post->formatPostDate($post->created_at) ?></span>

											<span>Комментарии: <?= count($comments ?? []) ?></span>
										</p>
									</div>
									<p>
										<?= nl2br($post->content ?? 'Содержимое поста отсутствует') ?>
									</p>
								</div>
							<?php else: ?>
								<div class="alert alert-danger">Пост не найден или был удален</div>
							<?php endif; ?>

							<!-- Блок комментариев -->
							<div class="comments pt-5 mt-5">
								<h3 class="mb-5 font-weight-bold"><?= count($comments ?? []) ?> комментариев</h3>

								<?php if (!empty($comments)): ?>
									<ul class="comment-list">
									<?php foreach ($comments as $comment): ?>
											<li class="comment">
												<div class="comment-body">
													<div class="d-flex justify-content-between">
														<h3><?= $comment->login ?></h3>
														<?php if (!$user->isGuest && ($user->id == $comment->user_id || $user->isAdmin)): ?>
															<a href="<?= $response->getLink('/practic_php/post.php', ['id' => $post->id, 'delete_comment' => $comment->id]) ?>"
																class="text-danger" style="font-size: 1.8em;" title="Удалить"
																onclick="return confirm('Удалить комментарий?')">🗑</a>
														<?php endif; ?>
													</div>
													<div class="meta">
														<?= $post->formatPostDate($comment->created_at) ?>
													</div>
													<p><?= $comment->content ?? '' ?></p>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
			</section>
			<!-- Форма комментария -->
			<?php if (!$user->isGuest && !$user->isAdmin && !($user->id == $post->user_id)): ?>
				<div class="comment-form-wrap pt-5">
					<h3 class="mb-5">Оставьте комментарий</h3>
					<form action="<?= $response->getLink('/practic_php/post.php', ['id' => $post->id]) ?>" method="POST"
						class="p-3 p-md-5 bg-light">
						<input type="hidden" name="token" value="<?= $user->token ?>">
						<div class="form-group">
							<label for="message">Сообщение</label>
							<textarea name="comment_text" id="message" cols="30" rows="5" class="form-control"
								required></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="add_comment" value="Отправить" class="btn py-3 px-4 btn-primary">
						</div>
					</form>
				</div>
			<?php elseif (($user->id == $post->user_id)): ?>
					<div class="alert alert-warning">вы не можете оставлять комментарии на свои посты.</div>
			<?php elseif ($user->isAdmin): ?>
				<div class="alert alert-warning">Администратор не может оставлять комментарии.</div>
			<?php else: ?>
				<div class="alert alert-info pt-5">
					Чтобы оставить комментарий, <a href="<?= $response->getLink('/practic_php/login.php') ?>">войдите
						в аккаунт</a>.
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php include_once __DIR__ . '/includes/pre-loader.php';?>
  <?php include_once __DIR__ . '/includes/script/inc/base.inc.php';?>
</body>
</html>