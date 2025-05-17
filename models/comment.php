<?php
    class Comment {
        private $db_conn;

        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) as count
                FROM comments 
            ";
            return $this->executeQuery('count the total comments', $query);
        }

        public function getCommentsByPostId($id) {
            $query = "SELECT comments.*, users.first_name, users.last_name
                FROM comments
                INNER JOIN users ON comments.user_id=users.id
                WHERE post_id = ?
            ";
            $type = "i";
            $fields_array = [$id];
            return $this->executeQuery('fetch comments by post id', $query, $type, $fields_array);
        }

        public function getLimitedComments($id, $limit) {
            $query = "SELECT comments.*
                FROM comments 
                WHERE post_id = $id
                LIMIT $limit
            ";
            $type = "ii";
            $fields_array = [$id, $limit];
            return $this->executeQuery('showing comments on a post', $query, $type, $fields_array);
        }

        public function insertNewComment($user_id, $post_id, $comment) {
            $today = date("Y-m-d");
            $query = "INSERT INTO comments (
                    user_id,
                    post_id,
                    comment,
                    created_at,
                    updated_at
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );
            ";
            $type = "iisss";
            $fields_array = [$user_id, $post_id, $comment, $today, $today];
            $this->executeQuery('inserting a post', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function updateComment($id, $comment) {
            $today = date("Y-m-d");
            $query = "UPDATE comments SET comment = ? WHERE id = ?";
            $type = "si";
            $fields_array = [$comment, $id];
            $this->executeQuery('updating a comment', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function deleteComment($id) {
            $query = "DELETE FROM comments WHERE id = ?;";
            $type = "i";
            $fields_array = [$id];
            return $this->executeQuery('deleting a comment', $query, $type, $fields_array);
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
                throw new Exception("Comment database queries for '$action' failed.");
            }
        }
    }
?>