<?php
    require_once __DIR__ . '/Student.php';

    class Undergrad extends Student {
        protected $course;
        protected $year;

        public function __construct($name, $num, $course, $year) {
            parent::__construct($name, $num);
            $this->course = $course;
            $this->year = $year;
        }

        public function getCourse() {
            return $this->course;
        }

        public function getYear() {
            return $this->year;
        }

        public function __toString() {
            $format = "Undergrad: %s, (N%s, %s, Year %s)";
            return sprintf($format, $this->name, $this->number, $this->course, $this->year);
        }
    }


?>