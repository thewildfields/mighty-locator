<?php get_header(); ?>

<div class="container colGr">
    <div class="colGr__col colGr__col_8">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <div class="mlCard listing">
                <div class="mlCard__content">
                    <div class="mlCard__contentHeader">
                        <h2 class="mlCard__title listing__title">
                            <?php the_title(); ?>
                        </h2>
                    </div>
                    <div class="mlCard__contentBody"></div>
                    <div class="mlCard__contentFooter"></div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
    <div class="colGr__col colGr__col_4"></div>
</div>

