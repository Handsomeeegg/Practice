<?php 
include_once __DIR__ . "/init.php";


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $response->redirect('practic_php/posts.php');
    exit;
}

$postId = (int) $_GET['id'];
$post = new Post($user);


if (!$post->findOne($postId)) {
    $response->redirect('practic_php/posts.php'); //2
    exit;
}


// Проверки прав с учетом $post->user
$canEditPost = !$user->isGuest && $post->user && ($user->id === $post->user_id || $user->isAdmin);
$canDeletePost = $canEditPost;
$canComment = !$user->isGuest && !$user->isAdmin;
$canDeleteComment = function ($comment) use ($user) {
    return !$user->isGuest && ($user->id === $comment->user_id || $user->isAdmin);
};

// Инициализируем класс комментариев
$commentClass = new Comment($user);

// Обработка удаления поста
if (
    !$user->isGuest &&
    isset($_GET['action']) &&
    $_GET['action'] === 'delete' &&
    isset($_GET['id'])
) {
    $post_delete = new Post($user);
    if (
        $post_delete->findOne((int) $_GET['id']) &&
        $post_delete->user &&
        ($user->id === $post_delete->user->id || $user->isAdmin)
    ) {
        // Удаление всех комментариев к посту
        $comments = $commentClass->get_post_id($post_delete->id);
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $commentClass->delete($comment->id, $user->id, $user->isAdmin);
            }
        }

        // Удаление самого поста
        $post_delete->delete();
        $response->redirect('practic_php/posts.php', []);
        exit;
    }
}

// Обработка удаления комментария
if (
    !$user->isGuest &&
    isset($_GET['delete_comment']) &&
    is_numeric($_GET['delete_comment'])
) {
    $commentId = (int) $_GET['delete_comment'];

    if ($commentClass->delete($commentId, $user->id, $user->isAdmin)) {
        $response->redirect('practic_php/post.php', ['id' => $postId]);
        exit;
    } else {
        $error = 'Недостаточно прав для удаления комментария или комментарий не найден.';
    }
}

// Обработка добавления комментария
if (
    !$user->isGuest &&
    !$user->isAdmin &&
    isset($_POST['add_comment']) &&
    isset($_POST['comment_text']) &&
    trim($_POST['comment_text']) !== ''
) {
    if ($user->id === $post->user_id) {
        $error = 'Нельзя комментировать свой собственный пост.';
    } else {
        $commentText = $RequestUnit->ClearInput($_POST['comment_text']);

        $newComment = new Comment($user);
        $newComment->post_id = $postId;
        $newComment->user_id = $user->id;
        $newComment->content = $commentText;

        if ($newComment->save()) {
            $response->redirect("/practic_php/post.php", ['id' => $postId]);
            exit;
        } else {
            $error = 'Ошибка при сохранении комментария.';
        }
    }
}

// Получаем комментарии для поста
$comments = $commentClass->get_post_id($postId);