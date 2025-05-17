<?php
    class Travel {
        private $db_conn;

        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) as count
                FROM posts 
                WHERE type = 'travel'
            ";
            return $this->executeQuery('count the total posts', $query);
        }

        public function getPostBySlugTitle($slug_title) {
            $query = "SELECT posts.*,
                (
                    SELECT image_url
                    FROM post_images 
                    WHERE post_images.post_id = posts.id 
                    LIMIT 1
                ) AS image_url 
                FROM posts 
                WHERE slug_title = ?
            ";
            $type = "s";
            $fields_array = [$slug_title];
            return $this->executeQuery('fetch a post by title', $query, $type, $fields_array);
        }

        public function getPostById($id) {
            $query = "SELECT posts.*,
                (
                    SELECT image_url
                    FROM post_images 
                    WHERE post_images.post_id = posts.id 
                    LIMIT 1
                ) AS image_url 
                FROM posts 
                WHERE id = ?
            ";
            $type = "i";
            $fields_array = [$id];
            return $this->executeQuery('fetch a post', $query, $type, $fields_array);
        }

        public function getLimitedPosts($limit, $offset = 0) {
            $query = "SELECT posts.*, 
                (SELECT image_url 
                    FROM post_images 
                    WHERE post_images.post_id = posts.id 
                    LIMIT 1
                ) AS image_url 
                FROM posts 
                WHERE type = 'travel' 
                LIMIT ?
                OFFSET ?
            ";
            $type = "ii";
            $fields_array = [$limit, $offset];
            return $this->executeQuery('showing posts', $query, $type, $fields_array);
        }

        public function insertNewPost($user_id, $post_type, $title, $slug, $content, $category, $date) {
            $today = date("Y-m-d");
            $query = "INSERT INTO posts (
                    user_id,
                    type,
                    title,
                    slug_title,
                    content,
                    category,
                    date,
                    created_at,
                    updated_at
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );
            ";
            $type = "issssssss";
            $fields_array = [$user_id, $post_type, $title, $slug, $content, $category, $date, $today, $today];
            $this->executeQuery('inserting a post', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function updatePost($id, $title, $slug, $content, $category, $date) {
            $today = date("Y-m-d");
            $query = "UPDATE posts SET 
                title = ?, 
                slug_title = ?, 
                content = ?, 
                category = ?, 
                date = ?, 
                updated_at = ? 
                WHERE id = ?;
            ";
            $type = "ssssssi";
            $fields_array = [$title, $slug, $content, $category, $date, $today, $id];
            $this->executeQuery('updating a post', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function deletePost($id) {
            $query = "DELETE FROM posts WHERE id = ?;";
            $type = "i";
            $fields_array = [$id];
            return $this->executeQuery('deleting a post', $query, $type, $fields_array);
        }

        private function executeQuery($action, $query, $type = null, $fields_array = null) {
            try {
                $stmt = mysqli_prepare($this->db_conn, $query);
                if($type !== NULL) {
                    mysqli_stmt_bind_param($stmt, $type, ...$fields_array);
                }
                mysqli_stmt_execute($stmt);
                return mysqli_stmt_get_result($stmt);
            } catch(Exception $e) {
                throw new Exception("Travel database queries for '$action' failed: " . $e->getMessage());
            }
        }
    }
?>