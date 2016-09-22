<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

    <section id="primary" class="site-content layout-authors">
        <div id="content" role="main">

        <?php if ( have_posts() ) : ?>

            <?php
                /* Queue the first post, that way we know
                 * what author we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                the_post();
            ?>

            <header class="archive-header">
                <h1 class="archive-title"><?php printf( __( 'Уроци от %s', 'twentytwelve' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
            </header><!-- .archive-header -->

            <?php
                /* Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();
            ?>

            <?php twentytwelve_content_nav( 'nav-above' ); ?>

            <?php
            // If a user has filled out their description, show a bio on their entries.
            if ( get_the_author_meta( 'description' ) ) : ?>
            <div class="author-info">
                <div class="author-avatar">

                    <?php
                    // TODO: Refactor: Duplicated logic with team-page.php

                    /**
                     * Get teacher photo via the Google+ API,
                     * or fallback to Gravatar.
                     */
                    $googlePlusApiKey = 'AIzaSyCj4CItxsT4pF15t3BOk86bK8r5LyglyQg';
                    $googlePlusUrl = get_the_author_meta('googleplus');
                    $googlePlusId = str_replace('https://plus.google.com/', '', $googlePlusUrl);

                    $google_profile_json = file_get_contents('https://www.googleapis.com/plus/v1/people/' . $googlePlusId . '?fields=image&key=' . $googlePlusApiKey);
                    $google_profile_json = json_decode($google_profile_json, true);
                    $user_avatar_url = $google_profile_json["image"]["url"];

                    if (isset($user_avatar_url)) {
                        $user_avatar_url = str_replace("sz=50", "sz=240", $user_avatar_url);
                    } else {
                        $author_email_md5 = md5(strtolower(trim( get_the_author_meta('user_email') )));
                        $user_avatar_url = "//www.gravatar.com/avatar/" . $author_email_md5 . "?s=240";
                    }

                    echo '<img class="avatar avatar-200 photo" src="' . $user_avatar_url . '" alt="' . $user_name . ', учител в EasierEnglish" width="200" height="200" />';

                    ?>


                </div><!-- .author-avatar -->
                <div class="author-description">
                    <?php
                        $author_bio = get_the_author_meta('description');
                        echo '<p>' . nl2br($author_bio) . '</p>';
                    ?>
                </div><!-- .author-description  -->
            </div><!-- .author-info -->
            <?php endif; ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); 
                echo "<h2><a class='mainLinks' href='".get_permalink()."'>";
                echo the_title()."</a></h2>";
                echo the_excerpt();
            endwhile; ?>

            <?php twentytwelve_content_nav( 'nav-below' ); ?>

        <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

        </div><!-- #content -->
    </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>