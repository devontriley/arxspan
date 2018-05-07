<?php

//layout types
$gridType = get_sub_field('grid_type');
$postGrid = get_sub_field('grid_type') == 'post';
$graphicGrid = get_sub_field('grid_type') == 'graphic';
$solutionsGridType = get_sub_field('solutions_grid_layout');

//post grid variables
$postOrigin = get_sub_field('post_origin');
$queryOrigin = get_sub_field('post_origin') == 'query';
$choiceOrigin = get_sub_field('post_origin') == 'choice';
$postType = get_sub_field('post_type');
$postQuantity = get_sub_field('post_quantity');
$postOrder = get_sub_field('post_order');
$postOrderby = get_sub_field('post_orderby');
$postSelection = get_sub_field('post_selection');

?>

<div class="grid <?php if($gridLayout){echo $gridLayout; } if($solutionsGridType){echo 'gradient'; } ?>">
    <div class="inner">

        <?php

        include('grid-post.php');

        include('grid-graphic.php');

        ?>

    </div> <!-- .inner -->
</div><!-- .grid -->
