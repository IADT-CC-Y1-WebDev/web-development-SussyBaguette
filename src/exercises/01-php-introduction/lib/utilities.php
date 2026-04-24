<?php
function truncate($text, $length) {
    echo substr($text, -$length),  PHP_EOL;
}

function formatPrice($amount) {
    $currency = "€$amount";
    echo "<p>$currency</p>";
}

function getCurrentYear() {
    echo "<p>The current year is 2026</p>";
}

?>
