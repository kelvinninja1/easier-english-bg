<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
    </div><!-- #main .wrapper -->

</div><!-- #page -->

<footer class="page-footer">
    <div class="page_wrapper group">

        <p class="footer_title">EasierEnglish.BG | Уроци по английски език</p>
        <p class="footer_text">Всеки от екипа допринася безвъзмездно, за да осъществим заедно идеята за безплатни и достъпни уроци по английски език.<br />
        Ако желаеш да подкрепиш труда на всички ни - <a class="fancy-link" target="_blank" href="https://www.facebook.com/easierenglish.bg">сподели нашия проект</a> с твоите приятели. Благодарим предварително! :-)</p>
        <div class="footer-contacts-holder group">
            <div class="left">
                <div class="person-left-holder group">
                    <img src="<?= get_template_directory_uri(); ?>/img/Kaloyan_Kosev_160.jpg" width="60" height="60" class="right" alt="Калоян Косев" />
                    <div class="right">
                        Калоян Косев,<br />
                        <a class="fancy-link" href="mailto:stoyan.panayotov@easierenglish.bg">kaloyan.kosev@easierenglish.bg</a><br />
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="person-right-holder group">
                    <img src="<?= get_template_directory_uri(); ?>/img/Stoyan_Panayotov_160.jpg" width="60" height="60" class="left" alt="Стоян Панайотов" />
                    <div class="left">
                        Стоян Панайотов,<br />
                        <a class="fancy-link" href="mailto:stoyan.panayotov@easierenglish.bg">stoyan.panayotov@easierenglish.bg</a><br />
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-contacts-holder group">
            <?php
                /**
                 * Important note!
                 * This code is kind of duplicated a lot with the one
                 * located in the team-page.php Sorry about that.
                 */

                /**
                 * Build an array with all team members,
                 * starting with the founders.
                 */
                $team_members = array();

                // Mark these as special
                $foundersIds = array(
                    1, // That's our co-founder, Kalo
                    7 // That's the other one, Stoyan
                );
                // Our designers, have no posts, but display them
                $designersIds = array(
                    17, // Petya
                    18 // Alex
                );

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
                    if ($isUserFounder) {
                        continue;
                    }

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

                    /**
                     * Get teacher photo via the user profile custom field,
                     * or fallback to a generic photo.
                     */
                    $template_url = get_bloginfo('template_directory');
                    $profile_img = get_the_author_meta('profile-img', $user->ID);
                    $image = $template_url . '/img/' .
                        (empty($profile_img) ? 'team/generic.jpg' : $profile_img);

                    // Linked-in URL
                    if ($user->user_url) {
                        echo '<a title="' . $user_name . ' в LinkedIn" href="' . $user->user_url . '" target="_blank"><img class="rounded-footer-image" src="' . $image . '" alt="' . $user_name . '" width="60" height="60" /></a>';
                    } else {
                        echo '<img class="rounded-footer-image" src="' . $image . '" alt="' . $user_name . '" width="60" height="60" />';
                    }
                }

            ?>
        </div>

        <div class="footer-links">
            <a class="fancy-link" itemprop="url" href="https://easierenglish.bg" title="Уроци по английски език | EasierEnglish.BG">EasierEnglish.BG</a> &copy; 2013 - <?php echo date("Y"); ?>
            <a class="fancy-link" href="/мисия/">Мисия</a>
            <a class="fancy-link" href="/партньори/">Партньори</a>
            <a class="fancy-link" href="/свържи-се-с-нас/" title="Свържи се с нас">Контакти</a>
            <a class="fancy-link" href="/feed/" target="_blank" title="Пълна RSS Емисия">RSS Емисия</a>
        </div>
    </div>

</footer>

<script>
    var templateUrl = '<?= get_bloginfo("template_url"); ?>';
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/js/script.min.js"></script>

<?php wp_footer(); ?>

<script>
    //Facebook Group:
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=195363947331773";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    //Google+ Badge and Google+ Button:
    window.___gcfg = {lang: 'bg'};
    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>

</body>
</html>
