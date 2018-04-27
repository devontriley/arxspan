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
        $twitter = get_field('twitter_link');
        $facebook = get_field('facebook_link');
        $linkedin = get_field('linkedin_link');
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

                if($twitter || $linkedin || $facebook ) {?>
                    <div class="sm-wrapper"><?php
                        if($twitter){ ?>
                            <a class="sm-icon" href="<?php echo $twitter ?>">
                                <svg viewBox="0 0 50 41">
                                    <use xlink:href="#twitter-icon"></use>
                                </svg>
                            </a><?php
                        }

                        if($linkedin){ ?>
                            <a class="sm-icon" href="<?php echo $linkedin ?>">
                                <svg viewBox="0 0 48 47">
                                    <use xlink:href="#linkedin-icon"></use>
                                </svg>
                            </a><?php
                        } ?>

                    </div><!-- .sm-wrapper --><?php
                }?>
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
