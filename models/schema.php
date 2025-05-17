<?php
    class DatabaseSchema {
        private $db_conn;

        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }
        

        public function createAllTables() {
            $this->createUsersTable();
            $this->createPostsTable();
            $this->createPostImagesTable();
            $this->createCommentsTable();
        }

        private function createUsersTable() {
            $query = "CREATE TABLE users (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                first_name VARCHAR(50) NOT NULL, 
                last_name VARCHAR(50) NOT NULL, 
                email VARCHAR(100) NOT NULL UNIQUE,
                role VARCHAR(10) NOT NULL,
                password VARCHAR(255) NOT NULL, 
                phone VARCHAR(20), 
                address VARCHAR(100),
                image BLOB
            )";
            $this->executeCreationIfTableExistsQuery('users', $query);
        }

        private function createPostsTable() {
            $query = "CREATE TABLE posts (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                user_id INT UNSIGNED, 
                type VARCHAR(20) NOT NULL,
                title VARCHAR(255) NOT NULL UNIQUE,
                slug_title VARCHAR(255),
                content TEXT,
                short_description TEXT,
                category VARCHAR(50) NOT NULL,
                date DATE NOT NULL,
                created_at DATE NOT NULL,
                updated_at DATE NOT NULL,
                FOREIGN KEY(user_id) REFERENCES users(id)
            )";
            $this->executeCreationIfTableExistsQuery('posts', $query);
        }

        private function createPostImagesTable() {
            $query = "CREATE TABLE post_images (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                post_id INT UNSIGNED,
                image_url VARCHAR(255) NOT NULL,
                FOREIGN KEY(post_id) REFERENCES posts(id)
            )";
            $this->executeCreationIfTableExistsQuery('post_images', $query);
        }

        private function createCommentsTable() {
            $query = "CREATE TABLE comments (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED, 
                post_id INT UNSIGNED,
                comment VARCHAR(255) NOT NULL,
                created_at DATE NOT NULL,
                updated_at DATE NOT NULL,
                FOREIGN KEY(post_id) REFERENCES posts(id), 
                FOREIGN KEY(user_id) REFERENCES users(id)
            )";
            $this->executeCreationIfTableExistsQuery('comments', $query);
        }

        private function executeCreationIfTableExistsQuery($table_name, $db_query) {
            try {
                $table_exists = $this->db_conn->query("SHOW TABLES LIKE '$table_name'");
                if(mysqli_num_rows($table_exists) <= 0)
                    $this->db_conn->query($db_query);
            } catch (Exception $e) {
                throw new Exception("Database queries for '$table_name' table creation failed: " . $e->getMessage());
            }
        }
    }
?>