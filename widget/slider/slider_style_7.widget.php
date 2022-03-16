<?php
class widget_slider_style_7 extends widget {
    function __construct() {
        parent::__construct('widget_slider', 'Slider 7', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['slider'];
        $this->author = 'Ngọc Diệp';
        $this->heading = false;
    }
    function form($left = [], $right = []) {
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
        $this->optionss = [];
        foreach ($sliders as $key => $val) { $this->optionss[$val->id] = $val->name;}
        $left[] = ['field' => 'gallery', 'label' =>'Nguồn slider', 'type' => 'select', 'options' => $this->optionss];
        $left[] = ['field' => 'ratio_width', 'label' => 'Tỉ lệ hiển thị rộng (width)', 'type'  => 'number', 'value' => 3, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'ratio_height', 'label' => 'Tỉ lệ hiển thị cao (Height)', 'type'  => 'number', 'value' => 1, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemRight', 'label' => 'Banner phải', 'type' => 'widget_slider_style_7::inputBanner', 'arg' => ['number' => 1]];
        $left[] = ['field' => 'itemBottom', 'label' => 'Banner dưới slider', 'type' => 'widget_slider_style_7::inputBanner', 'arg' => ['number' => 2]];

        //Menu dọc
        $left[] = ['field' => 'menuBg', 'label' =>'Màu nền menu', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuBgActive', 'label' =>'Màu nền menu hover', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuTxt', 'label' =>'Màu chữ menu', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuTxtActive', 'label' =>'Màu chữ menu hover', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'menuBorderActive', 'label' =>'Màu chữ border', 'type' => 'color', 'after' => '<div class="builder-col-12 col-md-12 form-group group">', 'before'=> '</div>'];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_7');
        echo $box['before']; ?>
        <div class="row-flex-center">
            <div class="slider_menu">
                <?php $this->menu(); ?>
            </div>
            <div class="slider_content">
                <div class="slider_content_top">
                    <div class="slider_slider">
                        <?php $this->slider(); ?>
                    </div>
                    <div class="slider_banner_right">
                        <?php foreach ($this->options->itemRight as $key => $item) { $this->banner($item, $key); } ?>
                    </div>
                </div>
                <div class="slider_banner_bottom">
                    <?php foreach ($this->options->itemBottom as $key => $item) { $this->banner($item, $key); } ?>
                </div>
            </div>

        </div>
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
    function slider() {
        if(isset($this->options->gallery)) {
            $gallerys = Gallery::getsItem($this->options->gallery);
        }
        else $gallerys = $this->options->galleryList;
        ?>
        <div class="box-content widget_slider_content" style="position: relative">
            <div class="arrow_box" id="slider_btn_<?= $this->id; ?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="slider_list_<?= $this->id; ?>" class="slider_list_item owl-carousel">
                <?php foreach ($gallerys as $key => $val) {$this->item($val);} ?>
            </div>
        </div>
        <script defer>
            $(document).ready(function() {
                let swidth = $('.widget_slider_content').width();
                let sheight = swidth*<?php echo $this->options->ratio_height/ $this->options->ratio_width;?>;
                $('.widget_slider_content .slider_list_item .item').css('height',sheight+'px');
                $(window).resize(function () {
                    swidth = $('.widget_slider_content').width();
                    sheight = swidth*<?php echo $this->options->ratio_height/ $this->options->ratio_width;?>;
                    $('.widget_slider_content .slider_list_item .item').css('height',sheight+'px');
                });
                let sync1 = $("#slider_list_<?php echo $this->id;?>");
                sync1.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 700,
                });
                $('#slider_btn_<?php echo $this->id;?> '+'.next').click(function() {
                    sync1.slick('slickNext'); return false;
                });
                $('#slider_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                    sync1.slick('slickPrev'); return false;
                });
            });
        </script>
        <style>
            .widget_slider_style_5 .slider_list_item .item {
                height: calc(100%*<?php echo $this->options->ratio_height / $this->options->ratio_width; ?>);
            }
        </style>
        <?php
    }
    function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item"><a aria-label='slide' href="<?php echo $item->url;?>"><?php get_img($item->value, $item->name, array('style' => 'cursor:pointer'));?></a></div>
        <?php
    }
    function banner($item, $key) {
        ?><div class="banner banner<?php echo $key;?> effect-hover-guong effect-hover-zoom"><a href="<?php echo Url::permalink($item['url']);?>"><?php Template::img($item['image'], $item['title']);?></a></div><?php
    }
    function menu() {
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
                --slider7-menu-bg:<?php echo (!empty($this->options->menuBg)) ? $this->options->menuBg : '#fff';?>;
                --slider7-menu-bg-active:<?php echo (!empty($this->options->menuBgActive)) ? $this->options->menuBgActive : 'var(--theme-option)';?>;
                --slider7-menu-txt:<?php echo (!empty($this->options->menuTxt)) ? $this->options->menuTxt : '#000';?>;
                --slider7-menu-txt-active:<?php echo (!empty($this->options->menuTxtActive)) ? $this->options->menuTxtActive : '#fff';?>;
                --slider7-menu-border:<?php echo (!empty($this->options->menuBorderActive)) ? $this->options->menuBorderActive : '#ccc';?>;
            }
        </style>
        <?php
    }
    function css() {
        include_once 'assets/slider-style-7.css';
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 1.87;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
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
        if(!isset($this->options->itemRight)) {
            $this->options->itemRight    = [];
            $this->options->itemRight[0] = [
                'image' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'  =>  'Slider là một thành tố điều khiển đồ họa',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->itemRight[1] = [
                'image' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'  =>  'Người dùng có thể cài đặt giá trị',
                'url'   =>  'https://sikido.vn',
            ];
        }
        else{
            foreach ($this->options->itemRight as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }
        if(empty($this->options->itemBottom)) {
            $this->options->itemBottom    = [];
            $this->options->itemBottom[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'         =>  'bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->itemBottom[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'         =>  'thường theo chiều ngang chiều dọc',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->itemBottom[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'         =>  'thường theo chiều ngang chiều dọc',
                'url'           =>  'https://sikido.vn',
            ];
        }
        else{
            foreach ($this->options->itemBottom as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }
    }
    static function inputBanner($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'url' => '');
        //Số Lượng item
        $number = (isset($param->arg['number'])) ? (int)$param->arg['number'] : 1;
        $output = '';
        $Form = new FormBuilder();
        for ( $i = 0; $i <= $number; $i++ ) {
            if(!isset($value[$i]) || !is_array($value[$i])) $value[$i] = [];
            $value[$i] = array_merge($value_default, $value[$i]);
            $output .= '<label for="name" class="control-label">Item '.($i+1).'</label>';
            $output .= '<div class="stote_wg_item">';
            $Form->add($param->field.'['.$i.'][image]', 'image', [ 'label' => 'Hình ảnh',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['image']);
            $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['title']);
            $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}

Widget::add('widget_slider_style_7');

if(!class_exists('store_nav_menu_vertical')) {
    class store_nav_menu_vertical extends walker_nav_menu
    {

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

ThemeMenu::addLocation('main-vertical', 'Menu slider dọc');