<?php

function button($id = null, $text = null, $class = null) {
    $btnLink = get_sub_field('button_link');
    $btnText = get_sub_field('button_text');
    $btnPath = get_sub_field('button_path');
    $url = $btnPath ? get_permalink($btnPath) : $btnLink;

    if($btnPath) $btnPath = $btnPath[0];

    if($id) {
        $btnPath = $id;
    }

    if($text) {
        $btnText = $text;
    } ?>

    <div class="btn-wrap <?php echo $class ?>">
        <a class="btn" href="<?php echo $url ?>">
            <span><?php echo $btnText ?></span>
        </a>
    </div><!-- .btn-wrap --> <?php
}

?>