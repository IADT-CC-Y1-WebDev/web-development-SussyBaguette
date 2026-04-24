<?php
    require_once __DIR__ . '/Student.php';

    class Postgrad extends Student {
        protected $supervisor;
        protected $topic;

        public function __construct($name, $num, $supervisor, $topic) {
            parent::__construct($name, $num);
            $this->supervisor = $supervisor;
            $this->topic = $topic;
        }

        public function getSupervisor(){
            return $this->supervisor;
        }

        public function getTopic(){
            return $this->topic;
        }

        public function __toString() {
            $format = "Postgrad: %s, (N%s), Supervisor: %s Topic: %s";
            return sprintf($format, $this->name, $this->number, $this->supervisor, $this->topic);
        }
    }
?>