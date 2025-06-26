<?php 
include_once __DIR__ . "/init.php";

$id = $_GET['id'] ?? null;
if ($id && is_numeric($id)) {
    $post = new Post($user);
    if (!$post->findOne((int) $id)) {
        $response->redirect('/practic_php/index.php');
        exit;
    }

    if ($post->user->id !== $user->id) {
        $response->redirect('/practic_php/index.php');
        exit;
    }

} else {
    $post = new Post($user);
}
    if ($RequestUnit->isPost && !$user->isGuest) {
        $post->load($RequestUnit->post());
        if (!$post->validate()) {
            if ($post->save()) {
                $response->redirect('/practic_php/post.php?id=' . $post->id);
                exit;
            }
        }
    }