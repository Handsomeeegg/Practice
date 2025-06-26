<?php

class Post extends Data
{

    public $id = null;
    public $title = null;
    public $content = null;
    public $preview = null;
    public $created_at = null;
    public int $comments_count = 0;
    public $user_id;
    public array $deletedPostData = [];

    public $title_error = null;
    public $content_error = null;
    public $preview_error = null;
    public $user;
    public $mysql;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function validate()
    {
        $result = false;
        if (empty($this->title)) {
            $this->title_error = 'Заголовок обязателен';
            $result = true;
        }

        if (empty($this->content)) {
            $this->content_error = 'Содержание обязательно';
            $result = true;
        }
        if (empty($this->preview)) {
            $this->preview_error = 'Превью обязательно';
            $result = true;
        }
        return $result;
    }

    public function load(array $data): void
    {
        parent::loadData($this, $data);
    }
    public function save()
    {
        if($this->user->isGuest){
            return false;
        }
        $title = $this->mysql->real_escape_string($this->title);
        $content = $this->mysql->real_escape_string(self::convert_rn($this->content));
        $preview = $this->mysql->real_escape_string($this->preview);
        $userId = (int) $this->user->id;

        if ($this->id) {
            $id = (int) $this->id;
            $sql = "
                UPDATE posts 
                SET title = '$title', content = '$content', preview = '$preview' 
                WHERE id = $id AND user_id = $userId
            ";
            return $this->mysql->query($sql);
        } else {
            $sql = "
                INSERT INTO posts (title, content, preview, user_id) 
                VALUES ('$title', '$content','$preview', $userId)
            ";
            $result = $this->mysql->query($sql);

            if ($result) {
                $this->id = $this->mysql->insert_id;
                return true;
            }

            return false;
        }
    }
    public function findOne(int $id): bool
    {
        $sql = "SELECT posts.*, User.login 
        FROM posts 
        JOIN User ON posts.user_id = User.id 
        WHERE posts.id = $id";


        $query_result = $this->mysql->query($sql);
        $row = $query_result ? $query_result->fetch_assoc() : false;

        if ($row) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->content = self::convert_br($row['content']);
            $this->preview = $row['preview'];
            $this->created_at = $row['created_at'];
            $this->user_id = $row['user_id'];
            $this->user->login = $row['login'];

            return true;
        }

        return false;
    }
    public function formatPostDate($date)
    {
        return parent::formatDate($date);
    }

    public function getAll($limit = null)
    {
        if ($limit === false) {
            $countResult = $this->mysql->query("SELECT COUNT(id) as count FROM posts");
            $limit = $countResult ? (int) $countResult->fetch_assoc()['count'] : 0;
        }


        $sql = "SELECT 
                p.*,
                (SELECT COUNT(*) FROM comment c WHERE c.post_id = p.id) AS comments_count,
                u.login
            FROM posts p
            LEFT JOIN User u ON p.user_id = u.id
            ORDER BY p.created_at DESC";

        if (is_numeric($limit)) {
            $limit = (int) $limit;
            $sql .= " LIMIT $limit";
        }

        $result = [];
        $queryResult = $this->mysql->query($sql);

        if ($queryResult && $queryResult->num_rows > 0) {
            while ($row = $queryResult->fetch_assoc()) {
                $postUser = new User($this->user->request, $this->mysql);
                $postUser->id = $row['user_id'];
                $postUser->login = $row['login'];

                $post = new static($postUser);

                $post->id = $row['id'];
                $post->title = $row['title'];
                $post->content = self::convert_br($row['content']);
                $post->preview = $row['preview'];
                $post->created_at = $row['created_at'];
                $post->comments_count = $row['comments_count'];

                $result[] = $post;
            }
        }

        return $result;
    }

    public function delete(): bool
{
    if ($this->user->isGuest || !$this->id) {
        return false;
    }

    $id = (int)$this->id;
    $userId = (int)$this->user->id;
    $isAdmin = $this->user->isAdmin;

    $whereCondition = $isAdmin ? "id = $id" : "id = $id AND user_id = $userId";

    $sql = "SELECT * FROM posts WHERE $whereCondition";
    $result = $this->mysql->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $this->deletedPostData = [
            'id' => $row['id'],
            'title' => $row['title'],
            'content' => $row['content'],
            'preview' => $row['preview'],
            'created_at' => $row['created_at'],
            'user_id' => $row['user_id']
        ];

        $deleteSql = "DELETE FROM posts WHERE $whereCondition";
        return $this->mysql->query($deleteSql);
        
    }

    return false;
}
   







}




