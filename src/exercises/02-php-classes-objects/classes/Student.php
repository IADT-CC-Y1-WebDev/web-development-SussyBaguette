<?php
    class Student {
        protected $name;
        protected $number;

        private static $students = [];
        private static $count = 0;

        public function __construct($name, $num) {
            self::$students[$num] = $this;

            // echo "Creating student: $name...<br>";
            $this->name = $name;
            $this->number = $num;

            if ($num === "") {
                throw new Exception("Student number cannot be empty");
            }

            self::$students[$num] = $this;
            echo "Opened account for {$this->name}<br>";

        }

        public function getName() {
            return $this->name;
        }

        public function getNumber() {        
            return $this->number;
        }

        public function leave() {
            unset(self::$students[$this->name]);
            echo "leaving and closing account for {$this->name}<br>";
        }

        public function __destruct() {
            echo "Student {$this->number} has been destroyed <br>";
        }

        public function __toString() {
            $format = " Student: %s, N%s";
            return sprintf($format, $this->name, $this->number);
        }

        public static function getCount() {
            return count(self::$students);
        }

        public static function findAll() {
            return self::$students;
        }

        public static function findByNumber($num) {
            return self::$students[$num] ?? null;
        }
    }
    
?>
