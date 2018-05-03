<?php

$buttonLabel = 'Head Home';
$buttonUrl = get_permalink(5);

?>

<?php get_header(); ?>

    <div class="redirect-body">
        <div class="inner">
            <p class="header">
                Oops! A wild 404 page has appeared. (Place-holder)
            </p>

            <?php button($buttonLabel, $buttonUrl); ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>