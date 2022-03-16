<?php
class widget_slider_style_9 extends widget {
    function __construct() {
        parent::__construct('widget_slider', 'Slider 9', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['slider'];
        $this->author = 'Ngọc Diệp';
        $this->heading = false;
    }
    function form($left = [], $right = []) {
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
        $this->options = [];
        foreach ($sliders as $key => $val) { $this->options[$val->id] = $val->name;}
        $left[] = ['field' => 'gallery', 'label' =>'Nguồn slider', 'type' => 'select', 'options' => $this->options];
        $left[] = ['field' => 'ratio_width', 'label' => 'Tỉ lệ hiển thị rộng (width)', 'type'  => 'number', 'value' => 3, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'ratio_height', 'label' => 'Tỉ lệ hiển thị cao (Height)', 'type'  => 'number', 'value' => 1, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];

        //Menu dọc
        $left[] = ['field' => 'headingBg', 'label' =>'Màu nền Heading', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'headingColor', 'label' =>'Màu chữ Heading', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuBg', 'label' =>'Màu nền menu', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuBgActive', 'label' =>'Màu nền menu hover', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuTxt', 'label' =>'Màu chữ menu', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuTxtActive', 'label' =>'Màu chữ menu hover', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuBorderActive', 'label' =>'Màu viền menu', 'type' => 'color', 'after' => '<div class="builder-col-12 col-md-12 form-group group">', 'before'=> '</div>'];

        $right[] = ['field' => 'itemColor', 'label' =>'Màu chữ item', 'type' => 'color'];
        $right[] = ['field' => 'itemBgOutside', 'label' =>'Nền item bên ngoài', 'type' => 'background'];
        $right[] = ['field' => 'itemBgInside', 'label' =>'Nền item bên trong', 'type' => 'background'];
        $right[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Items', 'fields' => [
            ['name' => 'image', 'type' => 'image',  'label' => __('Icon')],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề')],
        ]];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_9');
        echo $box['before']; ?>
        <div class="row-flex-center">
            <div class="slider_menu">
                <div class="slider-heading"><p class="heading"><?php echo $this->name;?></p></div>
                <?php $this->menu(); ?>
            </div>
            <div class="slider_content"><?php $this->slider(); ?></div>
            <div class="slider_items" style="<?php echo $this->generatorBackground($this->options->itemBgOutside);?>">
                <?php foreach ($this->options->item as $item) { ?>
                    <div class="item_right_slider" style="<?php echo $this->generatorBackground($this->options->itemBgInside);?>">
                        <div class="img"><?php Template::img($item['image'], $item['title'])?></div>
                        <div class="content">
                            <p class="title"><?php echo $item['title'];?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <style>
            :root {
                --slider9-heading-bg:<?php echo (!empty($this->options->headingBg)) ? $this->options->headingBg : 'var(--theme-color)';?>;
                --slider9-heading-txt:<?php echo (!empty($this->options->headingColor)) ? $this->options->headingColor : '#fff';?>;
                --slider9-item-txt:<?php echo (!empty($this->options->itemColor)) ? $this->options->itemColor : '#fff';?>;
            }
        </style>
        <script defer>
            $(function () {
                let wwidth = $(window).width();
                if(wwidth >= 768) {
                    let sheight = $('.slider_content').height();
                    sheight = sheight / 2;
                    $('.slider_right .banner').css('height', sheight + 'px');
                }
            })
        </script>
        <?php
        echo $box['after'];
    }
    public function slider() {
        ?>
        <div class="box-content widget_slider_content" style="position: relative">
            <div class="arrow_box" id="slider_btn_<?= $this->id; ?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="slider_list_<?= $this->id; ?>" class="slider_list_item owl-carousel">
                <?php foreach ($this->options->galleryList as $key => $val) { $this->item($val); } ?>
            </div>
            <div id="slider_list_thumb_<?= $this->id; ?>" class="slider_list_thumb owl-carousel">
                <?php foreach ($this->options->galleryList as $key => $val) { $this->thumb($val); } ?>
            </div>
        </div>
        <script defer>
            $(document).ready(function() {
                let swidth = $('.widget_slider_content').width();
                let sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                $('.widget_slider_content .slider_list_item .item').css('height',sheight+'px');
                $(window).resize(function () {
                    swidth = $('.widget_slider_content').width();
                    sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                    $('.widget_slider_content .slider_list_item .item').css('height',sheight+'px');
                });

                let sync1 = $("#slider_list_<?php echo $this->id;?>");

                let sync2 = $("#slider_list_thumb_<?php echo $this->id;?>");

                sync1.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: "#slider_list_thumb_<?php echo $this->id;?>"
                });

                $('#slider_btn_<?php echo $this->id;?> '+'.next').click(function() {
                    sync1.slick('slickNext'); return false;
                });
                $('#slider_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                    sync1.slick('slickPrev'); return false;
                });

                sync2.slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: "#slider_list_<?php echo $this->id;?>",
                    focusOnSelect: true,
                    loop:true,
                    responsive: [
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                            }
                        }
                    ]
                });
            });
        </script>
        <style>
            .widget_slider_style_8 .slider_list_item .item {
                height: calc(100%*<?php echo $this->options->ratio_height / $this->options->ratio_width; ?>);
            }
        </style>
        <?php
    }
    public function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <a aria-label='slide' href="<?php echo $item->url;?>">
                <?php get_img($item->value, $item->name, array('style' => 'cursor:pointer'));?>
            </a>
        </div>
        <?php
    }
    public function thumb($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?><div class="item"><p class="heading"><?php echo $item->name;?></p></div><?php
    }
    public function menu() {
        ?>
        <div class="menu-vertical">
            <div class="menu-vertical__content">
                <div class="menu-vertical__category">
                    <ul class="menu-vertical__category__nav">
                        <?php echo ThemeMenu::render(['theme_location' => 'main-vertical', 'walker' => 'store_nav_menu_vertical']);?>
                        <li class="nav-item">
                            <a href="#" class="nav-link js_navigation_vertical__show"><span><i class="fal fa-plus"></i> Xem thêm</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <style>
            :root {
                --slider9-menu-bg:<?php echo (!empty($this->options->menuBg)) ? $this->options->menuBg : '#fff';?>;
                --slider9-menu-bg-active:<?php echo (!empty($this->options->menuBgActive)) ? $this->options->menuBgActive : 'var(--theme-color)';?>;
                --slider9-menu-txt:<?php echo (!empty($this->options->menuTxt)) ? $this->options->menuTxt : '#000';?>;
                --slider9-menu-txt-active:<?php echo (!empty($this->options->menuTxtActive)) ? $this->options->menuTxtActive : '#fff';?>;
                --slider9-menu-border:<?php echo (!empty($this->options->menuBorderActive)) ? $this->options->menuBorderActive : '#ccc';?>;
            }
        </style>
        <?php
    }
    public function css() {
        include_once 'assets/slider-style-9.css';
    }
    public function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 1.87;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->itemBgOutside)) $this->options->itemBgOutside = [];
        if(!isset($this->options->itemBgInside)) {
            $this->options->itemBgInside = [
                'color' => 'var(--theme-color)'
            ];
        }
        if(!isset($this->options->gallery)) {
            $this->options->galleryList    = [];
            $this->options->galleryList[0] = (object)[
                'id'    => 1,
                'value' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'  =>  'Slider là một thành tố điều khiển đồ họa',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->galleryList[1] = (object)[
                'id'    => 2,
                'value' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'  =>  'Người dùng có thể cài đặt giá trị',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->galleryList[2] = (object)[
                'id'    => 3,
                'value' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'  =>  'Bằng cách di chuyển một vật chỉ thị',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->galleryList[3] = (object)[
                'id'    => 4,
                'value' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'  =>  'Người dùng cũng có thể nhấp vào một điểm trên slider để thay đổi cài đặt',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->galleryList[4] = (object)[
                'id'    => 5,
                'value' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'  =>  'The basic slider is horizontal and has a single handle',
                'url'   =>  'https://sikido.vn',
            ];
        }
        else {
            $this->options->galleryList = Gallery::getsItem($this->options->gallery);
        }
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'Giá rẻ nhất thị trường',
            ];
            $this->options->item[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'Nguyên liệu thiên nhiên',
            ];
            $this->options->item[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'Giao hàng toàn quốc',
            ];
            $this->options->item[3] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'Nhiều dung lượng',
            ];
            $this->options->item[4] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'Đa dạng mùi hương',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }
    }
    public function generatorBackground($background) {

        $color = (!empty($background['color'])) ? $background['color'] : '';
        $image = (!empty($background['image'])) ? $background['image'] : '';
        $gradientUse = (empty($background['gradientUse'])) ? 0 : 1;

        //CSS
        $css = '';

        if(!empty($color)) $css .= 'background-color:'.$color.';';

        //background gradient
        if(!empty($gradientUse)) {
            $gradientColor1 = (empty($background['gradientColor1'])) ? '' : $background['gradientColor1'];
            $gradientColor2 = (empty($background['gradientColor2'])) ? '' : $background['gradientColor2'];
            $gradientType = (empty($background['gradientType'])) ? 'linear-gradient' : $background['gradientType'].'-gradient';
            $gradientPositionStart = (empty($background['gradientPositionStart'])) ? 0 : $background['gradientPositionStart'];
            if($gradientType == 'linear-gradient') {
                $gradientRadialDirection = (empty($background['gradientRadialDirection2'])) ? '180deg' : $background['gradientRadialDirection2'].'deg';
            }
            else {
                $gradientRadialDirection = 'circle at '.((empty($background['gradientRadialDirection1'])) ? 'center' : $background['gradientRadialDirection1']);
            }
            $gradientPositionEnd = (empty($background['gradientPositionEnd'])) ? 100 : $background['gradientPositionEnd'];
            $gradient = $gradientType.'('.$gradientRadialDirection.','.$gradientColor1.' '.$gradientPositionStart.'%, '.$gradientColor2.' '.$gradientPositionEnd.'%)';
        }

        //background image
        if(!empty($image)) {
            $imageSize = (!empty($background['imageSize'])) ? $background['imageSize'] : 'cover';
            $imagePosition = (!empty($background['imagePosition'])) ? $background['imagePosition'] : 'center center';
            $imageRepeat = (!empty($background['imageRepeat'])) ? $background['imageRepeat'] : 'no-repeat';
            $css .= 'background-image:url(\''.Template::imgLink($image).'\')'.((!empty($gradient)) ? ','.$gradient.';' : ';');
            $css .= 'background-size:'.$imageSize.';background-repeat: '.$imageRepeat.'; background-position: '.$imagePosition.';background-blend-mode: color-burn;';
        }
        else if(!empty($gradient)) {
            $css .= 'background:'.$gradient.';';
        }
        return $css;
    }
}
Widget::add('widget_slider_style_9');
ThemeMenu::addLocation('main-vertical', 'Menu slider dọc');
if(!class_exists('store_nav_menu_vertical')) {
    class store_nav_menu_vertical extends walker_nav_menu {

        function start_el(&$output, $item, $depth = 0, $args = array(), $number = 0)
        {

            if (!empty($item->data['target'])) {
                $item->target = $item->data['target'];
            }

            $class = have_posts($item->child) ? 'dropdown ' : '';

            $class .= isset($item->class) ? $item->class : '';

            if ($number >= 9 && $depth == 0) $class .= ' nav-hidden';

            $output .= '<li class="nav-item ' . $class . '">';

            $atts = array();

            $atts['title'] = isset($item->attr) ? $item->attr : '';

            $atts['target'] = isset($item->target) ? $item->target : '';

            $atts['rel'] = isset($item->xfn) ? $item->xfn : '';

            $atts['href'] = isset($item->slug) ? get_url($item->slug) : '';

            $atts['class'] = 'nav-link';

            $attributes = '';

            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $icon = '';

            if (!empty($item->data['icon'])) {
                $icon = '<div class="icon">' . Template::img($item->data['icon'], $item->name, ['return' => true]) . '</div>';
            }

            $output .= '<a ' . $attributes . '>' . $icon . '<span>' . $item->name . '</span></a>';
            if (have_posts($item->child)) $output .= '<i class="fal fa-angle-right"></i>';
        }

        function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $output .= '</li>';
        }
    }
}