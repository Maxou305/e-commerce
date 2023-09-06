<?php

function formatPrice($prix) {
    $format = numfmt_create('fr_FR', NumberFormatter::CURRENCY);
    echo numfmt_format_currency($format, $prix, "EUR");
}

function priceExcludingVAT($prix){
    return (100 * $prix) / (100 + 20);
}
function discountedPrice($prix, $ristourne){
    return $prix - ($prix * $ristourne / 100);
}