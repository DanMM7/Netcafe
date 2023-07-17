<?php
    require './stripe-php-master/stripe-php-master/init.php';

    $publishable_key = "pk_test_51HZd7nInMxAFCaeUPAZyHRt7Kqseydpy4kwxKl4wWz7hy7DOAWlfo4tI0ZDsITZLFnP1A9UmtWuUyXeoYZse6kUU00GhZFtX0l";
    $secret_key = "sk_test_51HZd7nInMxAFCaeUULOdYlkzoYa7bfvbeoEsumZwlZrK7f4a3fseGhqbAc0wK2ix5zAmGPahCP5OafUTsuIM3D8i00lRGYz5gE";

    \Stripe\Stripe::setApiKey($secret_key);

?>