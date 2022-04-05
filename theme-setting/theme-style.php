<?php
if(!function_exists('theme_add_assets'))  {
	function theme_add_assets() {
	    if(Admin::is()) return false;
		$assets         = Path::theme('assets/');
        $add_on         = $assets.'add-on/';
        if (!Device::isGoogleSpeed()) {
            $font_family = get_font_family();
            $googles = '';
            if (have_posts($font_family)) {
                foreach ($font_family as $key => $font) {
                    if ($font['type'] == 'google') {
                        $googles .= $font['load'] . '&';
                    }
                }
                $googles = trim($googles, '&');
                if (!empty($googles)) {
                    if (strpos($googles, 'wght')) {
                        $googles = str_replace('&', '&family=', $googles);
                        $googles = 'https://fonts.googleapis.com/css2?family=' . $googles;
                    } else {
                        $googles = 'https://fonts.googleapis.com/css?family=' . $googles;
                    }
                    Template::asset()->location('header')->add('googfont', $googles);
                }
            }
            Template::asset()->location('header')->add('font-awesome', PLUGIN.'/font-awesome/css/all.min.css', ['minify' => false, 'path' => ['webfonts' => Url::base().'scripts/font-awesome']]);
        }
        Template::asset()->location('header')->add('reset', $assets.'css/reset.css', ['minify' => true]);
        Template::asset()->location('header')->add('bootstrap', $add_on.'bootstrap-3.3.7/css/bootstrap.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('dropdownhover', $add_on.'bootstrap-dropdownhover/bootstrap-dropdownhover.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('owlcarousel2', $add_on.'owlcarousel2-2.3.4/assets/owl.carousel.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('owlcarousel2', $add_on.'owlcarousel2-2.3.4/assets/owl.theme.default.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('slick', $add_on.'slick/slick.css', ['minify' => true, 'path' => ['fonts' => Url::base().$add_on.'slick']]);
        Template::asset()->location('header')->add('slick', $add_on.'slick/slick-theme.css', ['minify' => true, 'path' => ['fonts' => Url::base().$add_on.'slick']]);
        Template::asset()->location('header')->add('aos', $add_on.'aos/aos.css', ['minify' => true]);
        Template::asset()->location('header')->add('fancybox', $add_on.'fancybox-3/jquery.fancybox.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('animate', $add_on.'animate/animate.css', ['minify' => true]);
        Template::asset()->location('header')->add('mmenu', $add_on.'mmenu/mmenu.css', ['minify' => true]);
        Template::asset()->location('header')->add('ToastMessages',    PLUGIN.'/ToastMessages/jquery.toast.css', ['minify' => true]);
        Template::asset()->location('header')->add('animation', $assets.'css/animation.css', ['minify' => true]);
        Template::asset()->location('header')->add('swiper', $add_on.'swiper/swiper.min.css', ['minify' => true]);
        Template::asset()->location('header')->add('style', $assets.'css/style.css', ['minify' => true]);

        Template::asset()->location('footer')->add('bootstrap', $add_on.'bootstrap-3.3.7/js/bootstrap.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('jquery-ui', $assets.'js/jquery-ui-1.9.1.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('aos', $add_on.'aos/aos.js', ['minify' => true]);
        Template::asset()->location('footer')->add('dropdownhover', $add_on.'bootstrap-dropdownhover/bootstrap-dropdownhover.js', ['minify' => true]);
        Template::asset()->location('footer')->add('owlcarousel2', $add_on.'owlcarousel2-2.3.4/owl.carousel.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('slick', $add_on.'slick/slick.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('fancybox', $add_on.'fancybox-3/jquery.fancybox.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('mmenu', $add_on.'mmenu/mmenu.polyfills.js', ['minify' => true]);
        Template::asset()->location('footer')->add('mmenu', $add_on.'mmenu/mmenu.js', ['minify' => true]);
        Template::asset()->location('footer')->add('ToastMessages',  PLUGIN.'/ToastMessages/jquery.toast.js', ['minify' => true]);
        Template::asset()->location('footer')->add('script', $assets.'js/script.js', ['minify' => true]);
        Template::asset()->location('footer')->add('lazy', $add_on.'lazy/jquery.lazy.min.js', ['minify' => true]);
        Template::asset()->location('footer')->add('swiper', $add_on.'swiper/swiper.min.js', ['minify' => false]);
        return true;
    }
    add_action('init', 'theme_add_assets');
}