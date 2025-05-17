<?php
    class Image {
        private $db_conn;

        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }
        public function insertNewImage($post_id, $image_data, $file_path, $image_url) {
            $image_name = basename($image_data["name"]);
            $unique_name = rand() . "_" . $image_name;

            $query = "INSERT INTO post_images (
                    post_id,
                    image_url
                ) VALUES (
                    ?,
                    ?
                );
            ";
            $type = "is";
            $fields_array = [$post_id, $image_url."/uploads/".$unique_name];
            $this->executeQuery('inserting an image info', $query, $type, $fields_array);
            return $this->uploadimage($image_data, $file_path, $image_url, $unique_name);
        }

        public function updateImage($img_encoded, $image_url, $file_path) {
            $image_name = basename($image_url);
            $target_path = $file_path . "/uploads/" . $image_name;
            $decoded_image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img_encoded));
            file_put_contents($target_path, $decoded_image);
        }

        public function deleteImage($post_id, $image_url) {
            $query = "DELETE FROM post_images WHERE post_id = ?;";
            $type = "i";
            $fields_array = [$post_id];
            unlink($image_url);
            return $this->executeQuery('deleting an image info', $query, $type, $fields_array);
        }

        private function uploadimage($image_data, $file_path, $image_url, $unique_name) {
            $image_tmp = $image_data["tmp_name"];
            $target_path = $file_path . "/uploads/" . $unique_name;

            try {
                return move_uploaded_file($image_tmp, $target_path);
            } catch(Exception $e) {
                throw new Exception("Post image database queries for '$action' failed: " . $e->getMessage());
            }
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
                throw new Exception("Post image database queries for '$action' failed: " . $e->getMessage());
            }
        }
    }
?>