<?php

$bgPath;

$homePage = is_front_page();
$productOverview = is_page(7);
$productType = is_singular('product');
$industryOverview = is_page(17);
$industryType = is_singular('industry');
$ourApproach = is_page(76);
$resourceEventTypeCareerTypePrivacy = is_page([80, 102]) || is_singular('career') || is_singular('event');
$newsEvents = is_page(78);
$solutionOverview = is_page(20);
$solutionSingle = is_singular('solution');
$contactWhitepaperThankYou = is_page([84, 328]) || is_singular('whitepaper');

if($homePage){
    $bgPath = 'backgrounds/home-bg.php';
} else if($productOverview) {
    $bgPath = 'backgrounds/product-overview-bg.php';
} else if($productType) {
    $bgPath = 'backgrounds/products-bg.php';
} else if($industryOverview){
    $bgPath = 'backgrounds/industry-overview-bg.php';
} else if($industryType){
    $bgPath = 'backgrounds/industries-bg.php';
} else if($ourApproach){
    $bgPath = 'backgrounds/our-approach-bg.php';
} else if($resourceEventTypeCareerTypePrivacy){
    $bgPath = 'backgrounds/resource-eventtype-careertype-privacy-bg.php';
} else if($newsEvents){
    $bgPath = 'backgrounds/news-events-bg.php';
} else if($solutionOverview){
    $bgPath = 'backgrounds/solution-overview-bg.php';
} else if($solutionSingle){
    $bgPath = 'backgrounds/solution-single-bg.php';
} else if($contactWhitepaperThankYou){
    $bgPath = 'backgrounds/contact-whitepaper-thankyou-bg.php';
} else if(is_404()){
    $bgPath = 'backgrounds/gradient-bg.php';
}
else {
    $bgPath = 'backgrounds/products-bg.php';
}

include($bgPath);

?>