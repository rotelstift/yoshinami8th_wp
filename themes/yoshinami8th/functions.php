<?php
    function my_theme_setup() {
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'my_theme_setup');

    function add_ogp_meta_tags() {
        if (is_single() || is_page()) {
            global $post;
            $og_title = get_the_title($post->ID);
            $og_url = get_permalink($post->ID);
            $og_description = get_the_excerpt($post->ID);

            if (has_post_thumbnail($post->ID)) {
                $og_image = get_the_post_thumbnail_url($post->ID, 'full');
            } else {
                // デフォルトの画像URLを指定
                $og_image = get_template_directory_uri() . '/images/image.jpg';
            }

            echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($og_description) . '">' . "\n";
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
            echo '<meta property="og:type" content="article">' . "\n";
        } else {
            echo '<meta property="og:title" content="' . get_bloginfo('name') . '">' . "\n";
            echo '<meta property="og:url" content="' . home_url() . '">' . "\n";
            echo '<meta property="og:description" content="' . get_bloginfo('description') . '">' . "\n";
            echo '<meta property="og:image" content="' . get_template_directory_uri() . '/images/image.jpg">' . "\n";
            echo '<meta property="og:type" content="website">' . "\n";
        }
    }
    add_action('wp_head', 'add_ogp_meta_tags');

    // タグのリストを表示するカスタム関数を作成
    function display_tag_menu() {
        $tags = get_tags();
        if ($tags) {
            $output = '<ul class="tag-menu">';
            foreach ($tags as $tag) {
                $tag_link = get_tag_link($tag->term_id);
                $output .= '<li><a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a></li>';
            }
            $output .= '</ul>';
            return $output;
        }
        return '';
    }

    // ショートコードを作成
    function tag_menu_shortcode() {
        return display_tag_menu();
    }
    add_shortcode('tag_menu', 'tag_menu_shortcode');
?>
