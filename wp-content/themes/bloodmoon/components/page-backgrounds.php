<?php

$bgImage;
$viewBox;

$homePage = is_front_page();
$productOverview = is_page(7);
$productType = is_singular('product');
$industryOverview = is_page(17);
$industryType = is_singular('industry');
$ourApproach = is_page(76);
$resourceEventTypeCareerTypePrivacy = is_page([80, 102]) || is_singular('event') || is_singular('event');
$newsEvents = is_page(78);
$solutionOverview = is_page(20);
$solutionSingle = is_singular('solution');
$contactWhitepaperThankYou = is_page([84, 328]) || is_singular('whitepaper');

if($homePage){
    $bgImage = '#home-bg';
    $viewBox = '0 0 1920 726';
} else if($productOverview) {
    $bgImage = '#product-overview-bg';
    $viewBox = '0 0 1920 765';
} else if($productType) {

} else {
    echo 'other one';
}

?>

<svg class="svg-background" viewbox="<?php echo $viewBox ?>"><use xlink:href="<?php echo $bgImage ?>"></use></svg>
