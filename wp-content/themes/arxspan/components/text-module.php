<?php

$gradientBackground = get_sub_field('gradient_background');
$wysiwygContent = get_sub_field('wysiwyg');

?>

<div class="text-module <?php if($gradientBackground){echo ' gradient'; }?>">

    <div class="inner">
        <?php echo $wysiwygContent; ?>
    </div><!-- .inner -->

</div><!-- .text-module -->
