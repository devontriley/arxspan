<?php
$buttonLabel = get_sub_field('button_label');
$pathType = get_sub_field('path_type');
$internalType = get_sub_field('path_type') == 'internal';
$buttonPath = get_sub_field('button_path');
$internalPath = get_permalink($buttonPath[0]);
$buttonUrl = get_sub_field('button_url');
?>

<div class="btn-wrapper">
    <a class="btn" href="<?php echo ($internalType ? $internalPath : $buttonUrl); ?>">
        <?php echo $buttonLabel; ?>
    </a>
</div><!-- .btn-wrapper -->
