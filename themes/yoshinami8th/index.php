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
<body <?php body_class(['bg-zinc-800', 'text-white', 'font-sans']); ?>>

    <header class="bg-zinc-900 p-4 sticky top-0 z-10 h-16 sm:h-32">
        <div class="mx-auto grid grid-cols-2 sm:grid-cols-1 items-center text-center gap-4 lg:w-4/5 lg:max-w-screen-md">
            <h1 class="text-xl font-bold"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <!-- mobile menu -->
            <div class="sm:hidden grid grid-cols-1 justify-items-end">
                

                <div class="relative">
                    <label for="toggle" class="size-8">
                        <input type="checkbox" id="toggle" class="peer opacity-0 size-6" />

                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 peer-checked:hidden fixed top-4" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 hidden peer-checked:block fixed top-4" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        <nav id="menu-nav" class="hidden peer-checked:block fixed top-16 right-0 bg-zinc-900/80 w-2/3 max-w-xs h-lvh shadow-lg p-4 space-y-4">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu' => 'PageMenu',
                                'container' => '',
                                'menu_class' => 'grid grid-cols-1 divide-dotted divide-orange-400 divide-y border-y border-dotted border-orange-400 hover:*:text-orange-400 *:h-16',
                                'link_before' => '<span class="block h-full pt-5">',
                                'link_after' => '</span>',
                            )); ?>
                        </nav>
                    </label>
                    
                    
                </div>
            </div>
            <!-- desktop menu -->
            <nav class="hidden sm:block justify-center space-x-6 mt-2">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu' => 'PageMenu',
                    'container' => '',
                    'menu_class' => 'grid grid-cols-4 gap-4 *:block hover:*:text-orange-400 *:text-center *:border-b *:border-orange-400',
                   )); ?>
            </nav>
        </div>
   </header>

    <main class="flex-grow relative">
        <?php if (!is_home()) : ?>
            <h2 class="text-6xl font-bold text-center text-orange-400 h-auto sticky top-16 p-4 sm:top-32 bg-zinc-800"><?php single_tag_title(); ?></h2>
        <?php endif; ?>
        <div class="grid gap-4 grid-cols-1 place-items-center divide-dotted divide-orange-400 divide-y mx-auto lg:w-4/5 lg:max-w-screen-md">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="w-full">
                    <h3 class="text-3xl my-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="w-fit sm:max-w-96 mx-auto">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="post-content mt-6 grid gap-2 w-full has-[iframe]:aspect-video [&_iframe]:w-full">
                        <?php the_content(); ?>
                    </div>
                    <div class="post-meta text-right">
                        <span><?php the_time('m-d Y'); ?></span> |
                        <span><?php the_author(); ?></span>
                    </div>
                    <div class="post-tags text-right">
                        <?php the_tags('<span>Section: </span>', ', ', ''); ?>
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
        <div class="px-4 text-center mx-auto lg:w-4/5 lg:max-w-screen-md">
          <div class="grid grid-cols-3 gap-8 content-between">
            <p><a href="https://www.pixiv.net/users/3864757">pixiv</a></p>
            <p><a href="https://x.com/yoshinami8th">X</a></p>
            <p><a href="https://rotelstift.booth.pm/">BOOTH</a></p>
          </div>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
