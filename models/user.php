<?php
    class User {
        private $db_conn;

        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) as count
                FROM users 
            ";
            return $this->executeQuery('count the total users', $query);
        }

        public function getUserById($id) {
            $query = "SELECT *
                FROM users 
                WHERE id = ?
            ";
            $type = "s";
            $fields_array = [$id];
            return $this->executeQuery('fetch a post', $query, $type, $fields_array);
        }

        public function getUserByEmail($email) {
            $query = "SELECT *
                FROM users 
                WHERE email = ?
            ";
            $type = "s";
            $fields_array = [$email];
            return $this->executeQuery('fetch a post', $query, $type, $fields_array);
        }

        public function insertNewUser($first_name, $last_name, $email, $password, $phone = null, $address = null) {
            $today = date("Y-m-d");
            $query = "INSERT INTO users (
                    first_name,
                    last_name,
                    email,
                    role,
                    password,
                    phone,
                    address
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );
            ";
            $type="sssssss";
            $fields_array = [$first_name, $last_name, $email, "member", $password, $phone, $address];
            $this->executeQuery('inserting a user', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function updateUser($id, $first_name, $last_name, $email, $phone, $address, $image) {
            $query = "UPDATE users 
                SET first_name = ?,
                    last_name = ?,
                    email = ?,
                    phone = ?, 
                    address = ?,
                    image = ?
                WHERE id = ?;
            ";
            $type = "ssssssi";
            $fields_array = [$first_name, $last_name, $email, $phone, $address, $image, $id];
            $this->executeQuery('updating a user', $query, $type, $fields_array);
            return $this->db_conn->insert_id;
        }

        public function deleteUser($id) {
            $query = "DELETE FROM users WHERE id = ?;";
            $type = "i";
            $fields_array = [$id];
            return $this->executeQuery('deleting a user', $query, $type, $fields_array);
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
                throw new Exception("User database queries for '$action'." . $e->getMessage());
            }
        }
    }
?>