<?php get_header(); ?>
<div class="news-event-career">
    <div class="inner">

        <?php

        $newsType = is_singular('news');
        $eventType = is_singular('event');
        $careerType = is_singular('career');
        $title = get_field('title');
        $postDate = get_the_date('m/d/Y');

        //news
        $articleContent = get_field('article_content');

        //event
        $eventDate = get_field('event_date');
        $smLinks = have_rows('sm_links');
        $eventWysiwyg = get_field('event_wysiwyg');
        $aboutModule = get_field('about_content');

        //career
        $careerWysiwyg = get_field('career_wysiwyg');


        // news page
        if($newsType){ ?>
            <div class="intro-col">
                <p class='header'><?php echo $title; ?></p>
                <?php echo $postDate; ?>
            </div> <!-- .intro-col -->

            <div class="details-col">
                <?php echo $articleContent; ?>
            </div> <?php
        }

        if($eventType){ ?>
            <div class="intro-col">
                <p class='header'><?php echo $title ?></p>
                <p class="date"><?php echo $eventDate?></p><?php
            if($smLinks){
                while($smLinks) : the_row();

                $smIcon = get_sub_field('sm_icon');
                $smLink = get_sub_field('sm_link');

                endwhile;
            } ?>
            </div><!-- .intro-col -->
            <div class="details-col">
                <?php echo $eventWysiwyg ?>
                <?php echo $aboutModule ?>
            </div><!-- details-col --> <?php
        }

        if($careerType){ ?>
            <div class="intro-col">
                <p class='header'><?php echo $title ?></p>
                <p>Posted:</p>
                <p><?php echo $postDate; ?></p>

                <div class="btn-wrapper">
                    <a class="btn" href="<?php echo get_permalink('84'); ?>">
                        <p>Contact Us</p>
                    </a><!-- .btn -->
                </div><!-- .btn-wrapper -->
            </div>
            <div class="details-col">
                <?php echo $careerWysiwyg; ?>
            </div><!-- details-col --><?php
        } ?>
    </div><!-- .inner -->
</div><!-- .news-event-career -->

<?php include('components/components.php'); ?>

<?php get_footer(); ?>
