<?php
/**
 * Template Name: Team Page Template
 *
 * Description: List all page members, ordered by how many lessons they have
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

    <div id="primary" class="site-content">
        <div id="content" role="main">

            <h1 class="text-uppercase"><?php the_title(); ?></h1>

            <?php
                /**
                 * Build an array with all team members,
                 * starting with the founders.
                 */
                $team_members = [];

                // Mark these as special
                $foundersIds = [
                    1, // That's our co-founder, Kalo
                    7 // That's the other one, Stoyan
                ];
                // Our designers, have no posts, but display them
                $designersIds = [
                    17, // Petya
                    18 // Alex
                ];

                foreach ($foundersIds as $user_id) {
                    array_push(
                        $team_members,
                        get_user_by('id', $user_id)
                    );
                }

                $teachers_filter = array(
                    'orderby'      => 'post_count',
                    'order'        => 'DSC',
                    'exclude'      => array_merge($foundersIds, $designersIds)
                );
                $all_teachers = get_users($teachers_filter);
                $team_members = array_merge($team_members, $all_teachers);

                foreach ($designersIds as $user_id) {
                    array_push(
                        $team_members,
                        get_user_by('id', $user_id)
                    );
                }

                foreach ($team_members as $user) {
                    /**
                     * Skip the generic team account and move on.
                     * Sadly, he is not a real person :)
                     */
                    if ($user->user_email === 'team@easierenglish.bg') {
                        continue;
                    }

                    /**
                     * Skip teachers without any posts,
                     * except the two founders + designers. They are special :D
                     */
                    $isUserFounder = in_array($user->ID, $foundersIds);
                    $isUserDesigner = in_array($user->ID, $designersIds);
                    $user_posts_count = count_user_posts($user->ID);
                    if (
                        $user_posts_count == 0
                        && ! $isUserFounder
                        && ! $isUserDesigner
                    ) {
                       continue;
                    }

                    $user_name = esc_html($user->display_name);

                    echo '<div class="team_card group pb--lg" itemprop="' . ( $isUserFounder ? 'founders' : 'employee' ) . '" itemscope="" itemtype="http://schema.org/Person">';

                    // Linked-in URL
                    if ($user->user_url) {
                        echo '<a class="personal_linked" title="' . $user_name . ' в LinkedIn" href="' . $user->user_url . '" target="_blank">' . $user_name . ' в LinkedIn</a>';
                    }

                    /**
                     * Get teacher photo via the Google+ API,
                     * or fallback to Gravatar.
                     */
                    $googlePlusApiKey = 'AIzaSyCj4CItxsT4pF15t3BOk86bK8r5LyglyQg';
                    $googlePlusUrl = get_the_author_meta('googleplus', $user->ID);
                    $googlePlusId = str_replace('https://plus.google.com/', '', $googlePlusUrl);

                    $google_profile_json = file_get_contents('https://www.googleapis.com/plus/v1/people/' . $googlePlusId . '?fields=image&key=' . $googlePlusApiKey);
                    $google_profile_json = json_decode($google_profile_json, true);
                    $user_avatar_url = $google_profile_json["image"]["url"];

                    if (isset($user_avatar_url)) {
                        $user_avatar_url = str_replace("sz=50", "sz=240", $user_avatar_url);
                    } else {
                        $author_email_md5 = md5(strtolower(trim( $user->user_email )));
                        $user_avatar_url = "//www.gravatar.com/avatar/" . $author_email_md5 . "?s=240";
                    }

                    echo '<img itemprop="image" src="' . $user_avatar_url . '" alt="' . $user_name . ', учител в EasierEnglish" width="200" height="200" />';

                    /**
                     * Display teacher name, lessons count
                     * and attach a link to teacher portfolio
                     */
                    if ($isUserFounder) {
                        echo '<h2 class="author-card__title p0" itemprop="name">' . $user_name;
                        echo '<em>, съосновател на EasierEnglish.BG</em></h2>';
                    } elseif ($isUserDesigner) {
                        echo '<h2 class="author-card__title p0" itemprop="name">' . $user_name;
                        echo '<em>, графичен дизайнер в EasierEnglish.BG</em></h2>';
                    }
                    else {
                        $user_portfolio_url = get_author_posts_url($user->ID);
                        echo '<h2 class="author-card__title p0"><a itemprop="name" href="' . $user_portfolio_url . '">' . $user_name . '</a>';
                        echo '<em>, <span itemprop="jobTitle">учител в EasierEnglish.BG</span>';
                        echo '<a href="' . get_author_posts_url($user->ID) .'">';
                        echo ', ' . $user_posts_count . ' ';
                        echo $user_posts_count == 1 ? 'урок' : 'урока';
                        echo '</a></em></h2>';
                    }

                    $$author_bio = get_the_author_meta('description', $user->ID);
                    echo '<p>' . nl2br($$author_bio) . '</p>';

                    echo '</div>';
                }

            ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
