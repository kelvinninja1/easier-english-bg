<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
            <?php the_post_thumbnail(); ?>
            <?php endif; ?>

            <div class="inside_articleBox article_info_wrapper group">
                <?php
                    /**
                     * Get teacher photo via the user profile custom field,
                     * or fallback to a generic photo.
                     */
                    $template_url = get_bloginfo('template_directory');
                    $profile_img = get_the_author_meta($field = 'profile-img');
                    $image = $template_url . '/img/' .
                        (empty($profile_img) ? 'team/generic.jpg' : $profile_img);

                    $author_linkedin = get_the_author_meta( $field = 'user_url' );
                    $author_name = get_the_author_meta( $field = 'first_name' ) . " " . get_the_author_meta( $field = 'last_name' );
                ?>
                <?php if( isset($author_linkedin) ) echo '<a href='. $author_linkedin . ' target="_blank">'; ?>
                <img src="<?= $image ?>" class="article-author" height="80" width="80" alt="<?= $author_name; ?>" />
                <?php if( isset($author_linkedin) ) echo '</a>'; ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="reading-time entry-header-common-styles">
                ... за прочитане си отдели около: <span class="info_value"><?php echo get_post_meta( $post->ID, 'completionTime', true ); ?> минути</span>

                <?php
                    $enableExam =  get_post_meta( $post->ID, 'enableExam', true );
                    if ($enableExam == "true"):
                ?>
                    &nbsp;|&nbsp;
                    <a class="js-start_exam" href="javascript:;">Стартирай упражнение</a>
                    </div>
                <?php endif; ?>

                <div class="item_header_group" style="display: none;">Ниво на трудност: <span class="info_value"><?php echo get_post_meta( $post->ID, 'difficultyLevel', true ); ?></span></div>
            </div>
        </header>

        <div id="post_mainContent" class="entry-content">

            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>

            <div class="pb">
                <h4 class="entry-content-sub-title">Упражнение</h4>

                <?php
                    $enableExam =  get_post_meta( $post->ID, 'enableExam', true );
                    if ($enableExam == "true"):
                ?>
                    <p>Към този урок има разработено упражнение - 10 въпроса от затворен тип. Всеки въпрос има три възможни отговора, от които само един е верен (или най-верен).</p>
                    <p>Всяко ново зареждане на страницата разбърква реда на възможните отговори.</p>
                    <p>Когато стартирате упражнението, по всяко време можете да се върнете към урока. Въведените от вас отговори ще се запазят докато не презаредите или напуснете страницата.</p>
                    <p>
                        <button type="button" class="js-start_exam slim_button startExam">Стартирай упражнение</button>
                    </p>
                <?php else: ?>
                    <p>Към този урок все още няма разработено упражнение.</p>
                    <p>Споделяме безплатни уроци и пишем упражнения в свободното си време. Ние сме екип от доброволци. Опитваме поетапно да попълваме липсващите упражнения, но това става бавно. Не ни се сърди :-)</p>
                    <p>Можеш <a href="/абонирай-се/">да се абонираш</a> за новостите около нас. Пишем всеки път, когато публикуваме упражнение или нов урок.</p>
                <?php endif; ?>

                <h4 class="entry-content-sub-title">Полезен ли ти беше урокът?</h4>
                <div id="feedback-btns-holder">
                    <button id="positive-feedback" type="button" class="btn--default">Да</button>
                    <button id="negative-feedback" type="button" class="btn--default">Не</button>
                </div>

                <div id="social-box" class="highlight border-pill p hidden">
                    <p>
                        За да подготвим и публикуваме урок като този, няколко доброволци отделят от свободното си време между 16 и 28 часа. Ако желаеш, подкрепи нашия проект, за да оцениш труда ни :-)
                    </p>
                    <p>
                        Подкрепи ни във Facebook:
                        <div class="fb-page" data-href="https://www.facebook.com/easierenglish.bg/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/easierenglish.bg/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/easierenglish.bg/">ЕasiеrЕnglish.BG</a></blockquote>
                        </div>
                    </p>
                    <p>
                        или сподели урока с твоите приятели:
                        <?php
                            /**
                             * Migrating urls to https breaks the fb like count :(
                             * That's why reference the data-href fb button link to http.
                             * Sadly, this is the only way to keep the like count.
                             *
                             * http://stackoverflow.com/questions/12229801/facebook-like-on-https
                             */
                        ?>
                        <div class="fb-like" data-href="<?= 'http://easierenglish.bg' . $_SERVER['REQUEST_URI'] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                    </p>
                    <p>Благодарим :-)</p>
                </div>
                <div id="suggestion-box" class="highlight border-pill p hidden">
                    <p>
                        Съжаляваме, че сме те разочаровали. Ще се радваме да <a href="/свържи-се-с-нас/">ни пишеш</a> какво можем да подобрим.
                    </p>
                    <img class="pb" src="https://media.giphy.com/media/dBHyy0gA87NTy/giphy.gif" alt="Giphy Fail Jump" />
                </div>
            </div>

            <p class="pt">
                PS: Всеки, помогнал за реализацията на безплатните уроци, е доброволец и прави това в свободното си време. Ако желаеш, подкрепи труда на всички ни като <a target="_blank" href="https://www.facebook.com/easierenglish.bg">споделиш нашия проект с твоите приятели</a>. Благодарим! :-)
            </p>

        </div><!-- .entry-content -->


        <footer class="entry-meta">
            <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>

            <?php // TODO: Refactor, duplicated logic with team-page.php ?>

            <?php if (strlen(get_the_author_meta('description')) > 0) { ?>
                <div class="author-card group">
                    <?php if( isset($author_linkedin) ) echo '<a class="profile-image-link" title="'. $author_name .' в LinkedIn" href='. $author_linkedin . ' target="_blank">'; ?>
                    <img src="<?= $image ?>" class="author-image left" height="120" width="120" alt="<?= $author_name; ?>" />
                    <?php if( isset($author_linkedin) ) echo '<span class="personal_linked">'. $author_name .' в LinkedIn</span>'; ?>
                    <?php if( isset($author_linkedin) ) echo '</a>'; ?>
                    <?php
                        $author_posts = get_the_author_posts();
                        if ( intval($author_posts) == 1){
                            $author_posts .= " урок";
                        } else {
                            $author_posts .= " урока";
                        }
                    ?>
                    <h5><?= get_the_author() . ", <a target='_blank' href=" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . ">" . $author_posts . "</a>"; ?></h5>
                    <p><?= nl2br(get_the_author_meta('description')); ?></p>
                </div>
            <?php } ?>

            <div class="post_updated">
                Урокът е последно обновен на <span class="date updated"><?php the_modified_date(); ?></span> от <span class="vcard author"><?php the_author_posts_link(); ?></span>
            </div>

            <?php
                $category_data = get_the_category($post->ID);
                $category_ID = $category_data[0]->term_id;
                $category_name = $category_data[0]->name;
                $category_count = $category_data[0]->count;

                if ($category_count > 1) { ?>
                    <br />
                    <h4>Още уроци от категорията: <?php echo $category_name; ?></h4>
                    <ul class="more-posts-below">
                        <?php
                            $args = array( 'posts_per_page' => 5, 'offset'=> 1, 'category' => $category_ID );

                            $myposts = get_posts( $args );
                            foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endforeach;
                            wp_reset_postdata();
                        ?>
                    </ul>
            <?php } ?>

        </footer><!-- .entry-meta -->
    </article><!-- #post -->
