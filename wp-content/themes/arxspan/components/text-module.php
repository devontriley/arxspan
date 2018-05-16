<?php

$gradientBackground = get_sub_field('gradient_background');
$wysiwygContent = get_sub_field('wysiwyg');

$supportPage = is_page(86);

?>

<div class="text-module <?php if($gradientBackground){echo ' gradient'; } if($supportPage){ echo ' support'; } ?>">

    <div class="inner">
        <?php echo $wysiwygContent; ?>
    </div><!-- .inner -->

</div><!-- .text-module -->
