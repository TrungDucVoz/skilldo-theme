<?php
class widget_slider_style_5 extends widget {
    function __construct() {
        parent::__construct('widget_slider', 'Slider 5', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['slider'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading = false;
    }
    function form( $left = [], $right = []) {
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
        $options = [];
        foreach ($sliders as $key => $val) { $options[$val->id] = $val->name; }
        $left[] = ['field' => 'gallery', 'label' =>'Nguồn slider', 'type' => 'select', 'options' => $options];
        $left[] = [
            'field' => 'ratio_width', 'label' => 'Tỉ lệ hiển thị rộng (width)', 'type'  => 'number', 'value' => 3, 'step'  => 0.1,
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'ratio_height', 'label' => 'Tỉ lệ hiển thị cao (Height)', 'type'  => 'number', 'value' => 1, 'step'  => 0.1,
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = array('field' => 'item', 'type' => 'widget_slider_style_5::inputItem', 'arg' => ['number' => 3]);

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_5');
        echo $box['before']; ?>
        <div class="row-flex-center">
            <div class="slider_content"><?php $this->slider(); ?></div>
            <div class="slider_right">
                <div class="slider_item">
                <?php foreach ($this->options->item as $item) { ?>
                    <div class="item_right_slider item_right_slider0 effect-hover-guong">
                        <div class="item-container">
                            <div class="img_container">
                                <div class="img"><?php Template::img($item['image'], $item['title'])?></div>
                            </div>
                            <div class="content">
                                <p class="title"><?php echo $item['title'];?></p>
                                <p class="description"><?php echo $item['description'];?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
            .widget_slider_style_5 .slider_list_item .item {
                height: calc(100%*<?php echo $this->options->ratio_height / $this->options->ratio_width; ?>);
            }
        </style>
        <?php
    }
    function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <a aria-label='slide' href="<?php echo $item->url;?>">
                <?php get_img($item->value, $item->name, array('style' => 'cursor:pointer'));?>
            </a>
        </div>
        <?php
    }
    function thumb($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?><div class="item"><p class="heading"><?php echo $item->name;?></p></div><?php
    }
    function css() {
        include_once 'assets/slider-style-5.css';
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->gallery)) {
            $this->options->galleryList    = [];
            $this->options->galleryList[0] = (object)[
                'id' => 1,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Slider là một thành tố điều khiển đồ họa',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[1] = (object)[
                'id' => 2,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Người dùng có thể cài đặt giá trị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[2] = (object)[
                'id' => 3,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Bằng cách di chuyển một vật chỉ thị',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[3] = (object)[
                'id' => 4,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'Người dùng cũng có thể nhấp vào một điểm trên slider để thay đổi cài đặt',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->galleryList[4] = (object)[
                'id' => 5,
                'value'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000),
                'name'         =>  'The basic slider is horizontal and has a single handle',
                'url'           =>  'https://sikido.vn',
            ];
        }
        else {
            $this->options->galleryList = Gallery::getsItem($this->options->gallery);
        }
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'TIÊN ÍCH VƯỢT TRỘI',
                'description'   =>  'typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s',
            ];
            $this->options->item[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'CAM KẾT CHẤT LƯỢNG',
                'description'   =>  'typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s',
            ];
            $this->options->item[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'THIẾT KẾ SÁNG TẠO',
                'description'   =>  'typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s',
            ];
            $this->options->item[3] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/icon',
                'title'         =>  'THƯƠNG HIỆU UY TÍN',
                'description'   =>  'typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s',
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
    static public function inputItem($param, $value = []) {

        if(!have_posts($value)) $value = [];

        $value_default = array( 'image' => '', 'title' => '', 'url' => '', 'animate' => '', 'description' => '' );
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

            $Form->add($param->field.'['.$i.'][description]', 'text', [ 'label' => 'Mô tả',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['description']);

            if(Language::hasMulti()) {

                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $value[$i]['description_'.$lang_key] = (!empty($value[$i]['description_'.$lang_key])) ? $value[$i]['description_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                    $Form->add($param->field.'['.$i.'][description_'.$lang_key.']', 'text', [ 'label' => 'Mô tả ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['description_'.$lang_key]);
                }
            }
            $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
            $Form->add($param->field.'['.$i.'][animate]', 'select', ['label' => 'Hiệu ứng hiển thị',
                'options' => animate_css_option(),
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['animate']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}

Widget::add('widget_slider_style_5');