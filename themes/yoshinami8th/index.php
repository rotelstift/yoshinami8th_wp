<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="w-full min-h-screen flex flex-col bg-neutral-300 text-neutral-700">
    <header class="mb-8">
        <div class="container px-4 lg:w-4/5 lg:max-w-screen-md lg:mx-auto">
            <h1 class="text-4xl lg:text-6xl"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <nav class="text-right">
                <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                <?php echo do_shortcode('[tag_menu]'); ?>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        <div class="container grid gap-8 px-4 lg:w-4/5 lg:max-w-screen-md lg:mx-auto">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h2 class="text-3xl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                          <div class="w-fit mx-auto">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                          </div>
                        <?php endif; ?>
                    </div>
                    <div class="post-meta mb-8">
                        <span><?php the_time('m-d Y'); ?></span> |
                        <span><?php the_author(); ?></span>
                    </div>
                    <div class="post-tags">
                        <?php the_tags('<span>Section: </span>', ', ', ''); ?>
                    </div>
                    <div class="post-content grid gap-4">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
                <div class="pagination text-right text-xl">
                    <?php
                    echo paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container px-4 text-center lg:w-4/5 lg:max-w-screen-md lg:mx-auto">
          <div class="grid grid-cols-3 gap-8 content-between">
            <p><a href="https://www.pixiv.net/users/3864757">pixiv</a></p>
            <p><a href="https://x.com/yoshinami8th">X</a></p>
            <p><a href="https://rotelstift.booth.pm/">BOOTH</a></p>
          </div>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
    </footer>

    <?php wp_footer(); ?>
  </div>
</body>
</html>
