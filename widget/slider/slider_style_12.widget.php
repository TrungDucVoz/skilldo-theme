<?php
class widget_slider_style_12 extends widget {
    function __construct() {
        parent::__construct('widget_slider_style_12', 'Slider 12',['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', [$this, 'css'], 10);
        $this->tags = ['slider'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading = false;
    }
    function form($left = [], $right = []) {

        $left[] = [
            'field' => 'itemBannerBg', 'label' => 'Màu nền banner', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'itemBannerColor', 'label' => 'Màu chữ banner', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $left[] = ['field' => 'itemBanner', 'type' => 'repeater', 'label' => 'Items Banner trái', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Hình ảnh')],
            ['name' => 'title', 'type' => 'text', 'label' => __('Tiêu đề'), 'col' => 6],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
        ]];

        $options = [];
        $sliders = Gallery::gets(['where' => ['object_type' => 'slider']]);
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
        $left[] = ['field' => 'sliderTxtType', 'type' => 'select', 'label' => 'Kiểu tiêu đề slider', 'options' => [
            'out-slider' => 'Dưới slider', 'in-slider' => 'Trong slider'
        ], 'value' => 'in-slider'];

        $left[] = [
            'field' => 'sliderTxtBg', 'label' => 'Màu nền thumb', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'sliderTxtColor', 'label' => 'Màu chữ thumb', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'sliderTxtActive', 'label' => 'Màu chữ thumb (active)', 'type'  => 'color',
            'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'
        ];

        $left[] = ['field' => 'banner1Img', 'label' => 'Banner trái', 'type' => 'image', 'after' => '<div class="col-md-6 form-group group">', 'before' => '</div>'];
        $left[] = ['field' => 'banner1Url', 'label' => 'Link banner trái', 'type' => 'text', 'after' => '<div class="col-md-6 form-group group">', 'before' => '</div><div class="clearfix"></div>'];
        $left[] = ['field' => 'banner2Img', 'label' => 'Banner phải', 'type' => 'image', 'after' => '<div class="col-md-6 form-group group">', 'before' => '</div>'];
        $left[] = ['field' => 'banner2Url', 'label' => 'Link banner phải', 'type' => 'text', 'after' => '<div class="col-md-6 form-group group">', 'before' => '</div><div class="clearfix"></div>'];

        $right[] = [
            'field' => 'orderTxt', 'label' => 'Tiêu đề mua hàng', 'type'  => 'text',
            'after' => '<div class="col-md-12 form-group group">', 'before'=> '</div>'
        ];
        $right[] = [
            'field' => 'orderTxtColor', 'label' => 'Màu chữ mua hàng', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $right[] = [
            'field' => 'orderTxtBg', 'label' => 'Màu nền mua hàng', 'type'  => 'color',
            'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $right[] = ['field' => 'itemCustomer', 'type' => 'repeater', 'label' => 'Items', 'fields' => [
            ['name' => 'title', 'type' => 'text', 'label' => __('Tiêu đề')],
        ]];

        parent::form($left, $right);
    }
    function widget() {
        $number = 0;
        $box = $this->container_box('widget_slider_style_12');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="slider-left col-md-3 col-sm-4 hidden-xs vertical-menu">
                <?php foreach ($this->options->itemBanner as $item) { ?>
                    <div class="item-banner effect-hover-zoom" data-aos="fade-right" data-aos-delay="<?php echo $number++*100;?>">
                        <a href="<?php echo $item['url']; ?>">
                            <div class="item-banner__img"><?php Template::img($item['image'], $item['title']); ?></div>
                            <div class="item-banner__title">
                                <p class="item-banner__title_txt"><?php echo $item['title']; ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="slider-center col-md-6 col-sm-8 col-xs-12">
                <div class="slider-top slider_content <?php echo (!empty($this->options->sliderTxtType)) ? $this->options->sliderTxtType : 'in-slider';?>">
                    <?php if(have_posts($this->options->galleryList)) $this->slider(); ?>
                </div>
                <div class="banner-main">
                    <div class="banner-left" data-aos="fade-up">
                        <a href="<?php echo $this->options->banner1Url;?>">
                            <?php echo Template::img($this->options->banner1Img); ?>
                        </a>
                    </div>
                    <div class="banner-right" data-aos="fade-up">
                        <a href="<?php echo $this->options->banner2Url;?>">
                            <?php echo Template::img($this->options->banner2Img); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="slider-right col-md-3 col-sm-12 col-xs-12 vertical-menu">
                <?php $this->formRegister();?>
                <?php $this->customerOrder();?>
            </div>
        </div>
        <style>
            .js_widget_slider_style_12_<?php echo $this->id;?>.widget_slider_style_12 {
                --slider-banner-bg:<?php echo (!empty($this->options->itemBannerBg)) ? $this->options->itemBannerBg : 'rgba(7, 97, 202, 0.67)';?>;
                --slider-banner-color:<?php echo (!empty($this->options->itemBannerColor)) ? $this->options->itemBannerColor : '#fff';?>;

                --slider-thumb-color:<?php echo (!empty($this->options->sliderTxtColor)) ? $this->options->sliderTxtColor : '#fff';?>;
                --slider-thumb-color-active:<?php echo (!empty($this->options->sliderTxtActive)) ? $this->options->sliderTxtActive : 'var(--theme-color)';?>;
                --slider-thumb-bg:<?php echo (!empty($this->options->sliderTxtBg)) ? $this->options->sliderTxtBg : 'rgba(0,0,0,0.5)';?>;

                --slider-order-bg:<?php echo (!empty($this->options->orderTxtBg)) ? $this->options->orderTxtBg : 'var(--theme-color)';?>;
                --slider-order-color:<?php echo (!empty($this->options->orderTxtColor)) ? $this->options->orderTxtColor : '#fff';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function slider() {
        ?>
        <div class="box-content slider_box" style="position: relative">
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
                let swidth = $('.slider_box').width();
                let sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                $('.slider_box .slider_list_item .item').css('height',sheight+'px');
                $(window).resize(function () {
                    swidth = $('.slider_box').width();
                    sheight = swidth*<?php echo $this->options->ratio_height/$this->options->ratio_width;?>;
                    $('.slider_box .slider_list_item .item').css('height',sheight+'px');
                });

                let sync1 = $("#slider_list_<?php echo $this->id;?>");

                let sync2 = $("#slider_list_thumb_<?php echo $this->id;?>");

                sync1.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    autoplay: true,
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
                    arrows: false,
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
        <?php
    }
    function item($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <a aria-label='slide' href="<?php echo $item->url;?>">
                <?php Template::img($item->value, $item->name, array('style' => 'cursor:pointer'));?>
            </a>
        </div>
        <?php
    }
    function thumb($item) {
        if(function_exists('slider_item_options')) $item = slider_item_options($item);
        ?>
        <div class="item">
            <p class="heading"><?php echo $item->name;?></p>
        </div>
        <?php
    }
    function formRegister() {
        ?>
        <div class="slider-form-register-box">
            <div class="heading"><h3><?php echo $this->name;?></h3></div>
            <div class="slider-form-register">
                <form class="form-hoivien email-register-form" method="post">
                    <?php echo form_open(); ?>
                    <div class="">
                        <div class="">
                            <input type="text" name="name" id="name" class="form-control" value="<?php set_value('name', ''); ?>" required="required" placeholder="Tên khách hàng">
                        </div>
                        <div class="">
                            <input type="text" name="phone" id="phone" class="form-control" value="<?php set_value('phone', ''); ?>" required="required" placeholder="Số điện thoại">
                        </div>
                        <div class="">
                            <input type="text" name="email" id="email" class="form-control" value="<?php set_value('email', ''); ?>" required="required" placeholder="Email">
                        </div>
                        <div class="">
                            <textarea name="note" id="note" class="form-control" placeholder="Ghi chú (nếu có)"><?php set_value('note', ''); ?></textarea>
                        </div>
                    </div>
                    <div class="">
                        <div class="text-center">
                            <input type="hidden" name="form_key" value="">
                            <button class="btn btn-theme btn-effect-default" type="submit">ĐĂNG KÝ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    function customerOrder() {
        ?>
        <div class="slider-customer-order">
            <div class="heading"><h3><?php echo $this->options->orderTxt;?></h3></div>
            <div class="customer-order--content">
                <?php foreach ($this->options->itemCustomer as $key => $val): ?>
                    <div class="item-order">
                        <div class="title">
                            <div class="text"><?= Str::limit(Str::clear($val['title']), 150); ?></div>
                            <div class="time"><span><?php echo date('d/m/Y');?></span></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.customer-order--content').slick({
                    infinite: true,
                    vertical: true,
                    arrows: false,
                    autoplay: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    speed: 1000,
                    autoplaySpeed: 2000,
                    pauseOnHover: 0,
                    dots: false,
                    focusOnSelect: true,
                    responsive: [
                        { breakpoint: 1000, settings: { slidesToShow: 7 }},
                    ]
                });
            });
        </script>
        <?php
    }
    function css() {
        include_once 'assets/slider-style-12.css';
    }
    function default() {
        if(empty($this->name) || $this->name == 'Slider 12') $this->name = 'ĐĂNG KÝ THÔNG TIN';
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->orderTxt)) $this->options->orderTxt = 'KHÁCH HÀNG MỚI';
        if(!isset($this->options->gallery)) {
            $this->options->galleryList    = [];
            $this->options->galleryList[0] = (object)[
                'id' => 1,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Slider là một thành tố điều khiển đồ họa',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[1] = (object)[
                'id' => 2,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Người dùng có thể cài đặt giá trị',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[2] = (object)[
                'id' => 3,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Bằng cách di chuyển một vật chỉ thị',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[3] = (object)[
                'id' => 4,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'Người dùng cũng có thể nhấp vào một điểm trên slider để thay đổi cài đặt',
                'url'          =>  'https://sikido.vn',
            ];
            $this->options->galleryList[4] = (object)[
                'id' => 5,
                'value'        =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/1000x500',
                'name'         =>  'The basic slider is horizontal and has a single handle',
                'url'          =>  'https://sikido.vn',
            ];
        }
        else {
            $this->options->galleryList = Gallery::getsItem($this->options->gallery);
        }

        if(!isset($this->options->itemBanner)) {
            $this->options->itemBanner    = [];
            $this->options->itemBanner[0] = [
                'image' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'  => 'Dịch vụ chất lượng',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->itemBanner[1] = [
                'image' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'  => 'Thương hiệu uy tín',
                'url'   =>  'https://sikido.vn',
            ];
            $this->options->itemBanner[2] = [
                'image' =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/320x170',
                'title'  => 'Luôn đi đầu xu hương',
                'url'   =>  'https://sikido.vn',
            ];
        }
        else{
            foreach ($this->options->itemBanner as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }

        if(empty($this->options->itemCustomer)) {
            $this->options->itemCustomer    = [];
            $this->options->itemCustomer[0] = ['title' =>  'Anh Cao Tiến Đạt vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[1] = ['title' =>  'Anh Nguyễn Trung Hiếu vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[2] = ['title' =>  'Chị Đỗ Thị Mỹ Linh vừa đặt lịch tư vấn',];
            $this->options->itemCustomer[3] = ['title' =>  'Chị Nguyễn Thị Thanh Trúc vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[4] = ['title' =>  'Chị Trần Thị Hà Vy vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[5] = ['title' =>  'Anh Nguyên Thanh Long vừa đặt hàng sản phẩm',];
            $this->options->itemCustomer[6] = ['title' =>  'Chị Như Quỳnh vừa đặt hàng sản phẩm',];
        }
        else{
            foreach ($this->options->itemCustomer as $key => $value) {
                if(!isset($value['title'])) $value['title'] = '';
            }
        }

        if(!isset($this->options->banner1Img))  $this->options->banner1Img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/300x150';
        if(!isset($this->options->banner1Url))  $this->options->banner1Url = '';

        if(!isset($this->options->banner2Img))  $this->options->banner2Img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/300x150';
        if(!isset($this->options->banner2Url))  $this->options->banner2Url = '';
    }
}

Widget::add('widget_slider_style_12');