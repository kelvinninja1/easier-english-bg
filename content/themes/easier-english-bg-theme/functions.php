<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 *  custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
    /*
     * Makes Twenty Twelve available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Twenty Twelve, use a find and replace
     * to change 'twentytwelve' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // This theme supports a variety of post formats.
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

    /*
     * This theme supports custom background color and image, and here
     * we also set up the default background color.
     */
    add_theme_support( 'custom-background', array(
        'default-color' => 'e6e6e6',
    ) );

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Returns the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
    $font_url = '';

    /* translators: If there are characters in your language that are not supported
     by Open Sans, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
        $subsets = 'latin,latin-ext';

        /* translators: To add an additional Open Sans character subset specific to your language, translate
         this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
        $subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

        if ( 'cyrillic' == $subset )
            $subsets .= ',cyrillic,cyrillic-ext';
        elseif ( 'greek' == $subset )
            $subsets .= ',greek,greek-ext';
        elseif ( 'vietnamese' == $subset )
            $subsets .= ',vietnamese';

        $protocol = is_ssl() ? 'https' : 'http';
        $query_args = array(
            'family' => 'Open+Sans:300,400,600,700%26subset=latin,cyrillic',
            'subset' => $subsets,
        );
        $font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
    }

    return $font_url;
}

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string
 */
function twentytwelve_mce_css( $mce_css ) {
    $font_url = twentytwelve_get_font_url();

    if ( empty( $font_url ) )
        return $mce_css;

    if ( ! empty( $mce_css ) )
        $mce_css .= ',';

    $mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

    return $mce_css;
}
add_filter( 'mce_css', 'twentytwelve_mce_css' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'twentytwelve' ),
        'id' => 'sidebar-1',
        'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
        'id' => 'sidebar-2',
        'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
        'id' => 'sidebar-3',
        'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
    global $wp_query;

    $html_id = esc_attr( $html_id );

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
            <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Още уроци', 'twentytwelve' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'По-нови уроци <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
        </nav><!-- #<?php echo $html_id; ?> .navigation -->
    <?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
                <?php
                    echo get_avatar( $comment, 44 );
                    printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Автор на урока', 'twentytwelve' ) . '</span>' : ''
                    );
                    printf( '<time datetime="%2$s">%3$s</time>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                        sprintf( __( '%1$s', 'twentytwelve' ), get_comment_date('j F, Y') )
                    );
                ?>
            </header><!-- .comment-meta -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
            <?php endif; ?>

            <section class="comment-content comment">
                <?php comment_text(); ?>
                <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
            </section><!-- .comment-content -->

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Отговори на коментара', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );

    $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
        get_the_author()
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    if ( $tag_list ) {
        $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    } elseif ( $categories_list ) {
        $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    } else {
        $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    }

    printf(
        $utility_text,
        $categories_list,
        $tag_list,
        $date,
        $author
    );
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
    $background_color = get_background_color();
    $background_image = get_background_image();

    if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
        $classes[] = 'full-width';

    if ( is_page_template( 'page-templates/front-page.php' ) ) {
        $classes[] = 'template-front-page';
        if ( has_post_thumbnail() )
            $classes[] = 'has-post-thumbnail';
        if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
            $classes[] = 'two-sidebars';
    }

    if ( empty( $background_image ) ) {
        if ( empty( $background_color ) )
            $classes[] = 'custom-background-empty';
        elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
            $classes[] = 'custom-background-white';
    }

    // Enable custom font class only if the font CSS is queued to load.
    if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
        $classes[] = 'custom-font-enabled';

    if ( ! is_multi_author() )
        $classes[] = 'single-author';

    return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
    if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
        global $content_width;
        $content_width = 960;
    }
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

//Custom Fields for the Articles:
function displayCompetionTime($post){
    $completionTime =  get_post_meta( $post->ID, 'completionTime', true );
    $difficultyLevel =  get_post_meta( $post->ID, 'difficultyLevel', true );
    $articleAuthor =  get_post_meta( $post->ID, 'articleAuthor', true );

    ?>
        <div class="inside">
            Време за прочитане:&nbsp;
            <input class="ynfTextarea" name="completionTime" style="width: 30px; text-align: center;" value="<?php echo $completionTime; ?>"> минути
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            Ниво на трудност:&nbsp;
            <select name="difficultyLevel">
                <option <?= $difficultyLevel == "Лесно :)" ? selected : "";  ?> value="Лесно :)">Лесно :)</option>
                <option <?= $difficultyLevel == "Малко заплетено" ? selected : "";  ?> value="Малко заплетено">Малко заплетено</option>
                <option <?= $difficultyLevel == "Сложно :(" ? selected : "";  ?> value="Сложно :(">Сложно :(</option>
            </select>
            <br />
            <br />
            Автор (Gravatar E-mail):&nbsp;
            <input class="ynfTextarea" name="articleAuthor" style="width: 200px;" value="<?php echo $articleAuthor; ?>">
        </div>
    <?php
}
function displayQuestions($post){
    $questions =  get_post_meta( $post->ID, 'questions', true );
    $answers =  get_post_meta( $post->ID, 'answers', true );
    ?>
        <div class="inside">
            Въпрос #1: <input name="questions[]" style="width: 100%;" value="<?php echo $questions[0]; ?>" />
            Отговор: <textarea name="answers[]" style="width: 100%; height: 100px;"><?php echo $answers[0]; ?></textarea>
            <hr />
            Въпрос #2: <input name="questions[]" style="width: 100%;" value="<?php echo $questions[1]; ?>" />
            <textarea name="answers[]" style="width: 100%; height: 100px;"><?php echo $answers[1]; ?></textarea>
            <hr />
            Въпрос #3: <input name="questions[]" style="width: 100%;" value="<?php echo $questions[2]; ?>" />
            Отговор: <textarea name="answers[]" style="width: 100%; height: 100px;"><?php echo $answers[2]; ?></textarea>
        </div>
    <?php
}


function exam($post){
    //$examArray = [];
    ?>
        <style>
            .correctAnswer {
                color: #94e100;
            }
            .correctInput {
                width: 100%;
                border-color: #94e100 !important;
            }
            .wrongAnswer {
                color: #ff1313;
            }
            .wrongInput {
                width: 100%;
                border-color: #ff1313 !important;
            }
            .examBox hr {
                margin: 30px 0;
                border-top: 5px solid #61BD66;
            }
            .examBox p {
                font-size: 15px;
                text-transform: uppercase;
                padding: 5px 0;
                margin: 0;
            }
            .controlTest {
                background-color: #ffff99;
                padding: 15px 20px;
                border-radius: 5px;
            }
            .controlTest input {
                margin-left: 20px;
            }

        </style>
        <div class="inside examBox">
            <?php
                //Trun on the test:
                $enableExam =  get_post_meta( $post->ID, 'enableExam', true );
                if ( $enableExam == '' ) {
                    $enableExam = "false";
                }
            ?>
            <div class="controlTest">
                <input name="enableExam" type="radio" value="true" <?= $enableExam == "true" ? checked : ""; ?> />Публикувай тестчето
                <input name="enableExam" type="radio" value="false" <?= $enableExam == "false" ? checked : ""; ?> />Изключено
            </div>
            
            <?php
                for( $i = 1; $i <= 10; $i++ ){
                    $examArr =  get_post_meta( $post->ID, 'examArr' . $i, true );
                    $m = 0;
                    ?>
                    <p>Въпрос #<?= $i; ?>:</p>
                    <input type="text" name="examArr<?= $i;?>[]" style="width: 100%;" value="<?= $examArr[$m]; ?>" />
                    <span class="correctAnswer">Верен отговор:</span>
                    <input type="text" name="examArr<?= $i?>[]" class="correctInput" value="<?= $examArr[$m + 1]; ?>" />
                    <br />
                    <br />
                    <span class="wrongAnswer">Грешен отговор:</span>
                    <input type="text" name="examArr<?= $i;?>[]" class="wrongInput" value="<?= $examArr[$m + 2]; ?>" />
                    <span class="wrongAnswer">Защо е грешен?</span>
                    <input type="text" name="examArr<?= $i;?>[]" class="wrongInput" value="<?= $examArr[$m + 3]; ?>" />
                    <br />
                    <br />
                    <span class="wrongAnswer">Друг грешен отговор:</span>
                    <input type="text" name="examArr<?= $i;?>[]" class="wrongInput" value="<?= $examArr[$m + 4]; ?>" />
                    <span class="wrongAnswer">Защо е грешен?</span>
                    <input type="text" name="examArr<?= $i;?>[]" class="wrongInput" value="<?= $examArr[$m + 5]; ?>" />
                    <hr />
            <?php } ?>
        </div>
    <?php
}

//adding meta boxes to posts
add_action( 'add_meta_boxes', 'add_meta_boxes_to_post' );

function add_meta_boxes_to_post(){
    add_meta_box( 'completionTime', 'Допълнителна информация към статията:', 'displayCompetionTime', 'post', 'normal', 'core' );
    add_meta_box( 'questions', 'Зададени до момента въпроси към урока:', 'displayQuestions', 'post', 'normal', 'core' );
    add_meta_box( 'examArray', 'Упражнение към урока:', 'exam', 'post', 'normal', 'core' );
}

add_action( 'save_post', 'add_object_fields', 10, 2 );
//Update:
function add_object_fields( $post_id, $post ) {
    // Check post type for resorts
    if ( $post->post_type == 'post' ) {
        if ( isset( $_POST['completionTime'] ) && $_POST['completionTime'] != '' ) {
            update_post_meta( $post_id, 'completionTime', $_POST['completionTime'] );
        }
        if ( isset( $_POST['difficultyLevel'] ) && $_POST['difficultyLevel'] != '' ) {
            update_post_meta( $post_id, 'difficultyLevel', $_POST['difficultyLevel'] );
        }
        if ( isset( $_POST['articleAuthor'] ) && $_POST['articleAuthor'] != '' ) {
            update_post_meta( $post_id, 'articleAuthor', $_POST['articleAuthor'] );
        }
        if ( isset( $_POST['questions'] ) && $_POST['questions'] != '' ) {
            update_post_meta( $post_id, 'questions', $_POST['questions'] );
        }
        if ( isset( $_POST['answers'] ) && $_POST['answers'] != '' ) {
            update_post_meta( $post_id, 'answers', $_POST['answers'] );
        }
        //Exam:
        for( $i = 1; $i <= 10; $i++ ){
            if ( isset( $_POST['examArr' . $i] ) && $_POST['examArr' . $i] != '' ){
                update_post_meta( $post_id, 'examArr' . $i, $_POST['examArr' . $i] );
            }
        }
        if ( isset( $_POST['enableExam'] ) && $_POST['enableExam'] != '' ) {
            update_post_meta( $post_id, 'enableExam', $_POST['enableExam'] );
        }
    }
}

//Gravatar images Alt:
function replace_content($text) {
    $alt = get_comment_author($id_or_email);
    $text = str_replace('alt=\'\'', 'alt=\''.$alt.'\'',$text);
    return $text;
}
add_filter('get_avatar','replace_content');


//Login Screen Set Logo:
function my_login_logo() { ?>
    <style>
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/EasierEnglish_logo.png);
            width: 92px;
            height: 70px;
            background-size: 92px 70px;
        }
        body.login div#login h1:after {
            content: "Не ни хаквай :)";
            font-size: 14px;
            margin: 5px 0
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


//Login Screen link logo to the homepage:
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'EasierEnglish.BG';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


//Categories number of posts fix:
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
  $links = str_replace('</a>', '', $links);
    $links = str_replace(')', ')</a>', $links);
  return $links;
}

//Custom Read more:
function new_excerpt_more( $excerpt ) {
    return ' ... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">прочети урока</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Categories title lang fix:
function remove_category_link_prefix($output) {
    $replace = array( 
            'View all posts in ',
            'View all posts filed under ' 
    );
    return str_replace( $replace, 'Виж всички уроци от категория ', $output);
}
add_filter( 'the_category', 'remove_category_link_prefix' );
add_filter( 'wp_list_categories', 'remove_category_link_prefix' );

//Custom exerpt length
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Set html lang tag:
add_filter('language_attributes', 'custom_lang_attr');
function custom_lang_attr() {
    return 'lang="bg"';
}

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'feed_links', 2);
//remove_action('wp_head', 'index_rel_link');
//remove_action('wp_head', 'wlwmanifest_link');
//remove_action('wp_head', 'feed_links_extra', 3);
//remove_action('wp_head', 'start_post_rel_link', 10, 0);
//remove_action('wp_head', 'parent_post_rel_link', 10, 0);
//remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

//Disable the File Editor, Automatic updates and stop users from uploading plugins/themes directly
define( 'DISALLOW_FILE_MODS', true );