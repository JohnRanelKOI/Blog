<?php
    class Navigation {
        public $current_url;
        public function __construct($current_url) {
            $this->current_url = $current_url;
        }

        public function getActivePage() {
            return str_replace("/", "-", substr($this->current_url, 1));
        }

        public function ifPageActiveReturnClassActive($page) {
            return ($this->current_url == "/" || strpos($this->current_url, "$page") !== false) ? 'class="active"' : '';
        }
    }
?>