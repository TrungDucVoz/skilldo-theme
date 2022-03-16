<?php
class widget_slider_style_8 extends widget {
    function __construct() {
        parent::__construct('widget_slider', 'Slider 8', ['container' => true, 'position' => 'right']);
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
        $left[] = ['field' => 'ratio_width', 'label' => 'Tỉ lệ hiển thị rộng (width)', 'type'  => 'number', 'value' => 3, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'ratio_height', 'label' => 'Tỉ lệ hiển thị cao (Height)', 'type'  => 'number', 'value' => 1, 'step'  => 0.1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];

        $left[] = ['field' => 'headingBg', 'label' =>'Màu nền Heading', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'headingColor', 'label' =>'Màu chữ Heading', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'boxBorder', 'label' =>'Màu viền', 'type' => 'color'];
        $left[] = ['field' => 'itemBorder', 'label' =>'Màu gạch chân', 'type' => 'color'];
        $left[] = ['field' => 'customerColor', 'label' =>'Màu chữ khách hàng', 'type' => 'color'];
        $left[] = ['field' => 'customerBg', 'label' =>'Nền khách hàng', 'type' => 'background'];
        $left[] = ['field' => 'customerNum', 'label' =>'Số khách hàng hiển thị', 'type' => 'number', 'value' => 4];
        $left[] = ['field' => 'customer', 'type' => 'repeater', 'label' => 'Khách hàng', 'fields' => [['name' => 'title', 'type' => 'text',  'label' => __('Nội dung')],]];

        $right[] = ['field' => 'titleRight', 'label' =>'Tiêu đề phải', 'type' => 'text'];
        $right[] = ['field' => 'itemColor', 'label' =>'Màu chữ item', 'type' => 'color'];
        $right[] = ['field' => 'itemBg', 'label' =>'Nền item', 'type' => 'background'];
        $right[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Items', 'fields' => [
            ['name' => 'image', 'type' => 'image',  'label' => __('Icon')],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề')],
        ]];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_slider_style_8');
        echo $box['before']; ?>
        <div class="row-flex-center">
            <div class="slider_customer" style="<?php echo $this->generatorBackground($this->options->customerBg);?>">
                <div class="slider-heading"><p class="heading"><?php echo $this->name;?></p></div>
                <div class="slider_customer_box" id="slider_customer_<?php echo $this->id;?>">
                    <?php foreach ($this->options->customer as $item) { ?>
                        <div class="item_customer">
                            <p class="title"><?php echo $item['title'];?> - <span class="date"><?php echo date('d/m/Y');?></span></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="slider_content"><?php $this->slider(); ?></div>
            <div class="slider_items" style="<?php echo $this->generatorBackground($this->options->itemBg);?>">
                <div class="slider-heading"><p class="heading"><?php echo $this->options->titleRight;?></p></div>
                <?php foreach ($this->options->item as $item) { ?>
                    <div class="item_right_slider">
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
                --slider8-heading-bg:<?php echo (!empty($this->options->headingBg)) ? $this->options->headingBg : '#084557';?>;
                --slider8-heading-txt:<?php echo (!empty($this->options->headingColor)) ? $this->options->headingColor : '#fff';?>;
                --slider8-item-txt:<?php echo (!empty($this->options->itemColor)) ? $this->options->itemColor : '#084557';?>;
                --slider8-customer-txt:<?php echo (!empty($this->options->customerColor)) ? $this->options->customerColor : '#084557';?>;
                --slider8-border-color:<?php echo (!empty($this->options->boxBorder)) ? $this->options->boxBorder : '#084557';?>;
                --slider8-border-bottom:<?php echo (!empty($this->options->itemBorder)) ? $this->options->itemBorder : '#ccc';?>;
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

                let config = {
                    infinite: true,
                    vertical: true,
                    verticalScrolling: true,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 700,
                    slidesToShow: <?php echo $this->options->customerNum;?>,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1000,
                            settings: { slidesToShow: 4 }
                        },
                        {
                            breakpoint: 600,
                            settings: { slidesToShow: 3 }
                        }
                    ]
                };
                let sliderCustomer = $("#slider_customer_<?php echo $this->id;?>");
                sliderCustomer.slick(config);
            });
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
    public function css() { include_once 'assets/slider-style-8.css'; }
    public function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->ratio_width)) $this->options->ratio_width = 2.4;
        if(!isset($this->options->ratio_height)) $this->options->ratio_height = 1;
        if(!isset($this->options->customerNum)) $this->options->customerNum = 4;
        if(!isset($this->options->titleRight)) $this->options->titleRight = 'Cam kết';
        if(!isset($this->options->itemBg)) $this->options->itemBg = [];
        if(!isset($this->options->customerBg)) $this->options->customerBg = [];
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

        if(empty($this->options->customer)) {
            $this->options->customer    = [];
            $this->options->customer[0] = ['title' =>  'Chị Thanh Trúc vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[1] = ['title' =>  'Chị Kim Thoa vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[2] = ['title' =>  'Anh Thanh Phong vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[3] = ['title' =>  'Anh Đăng Quang vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[4] = ['title' =>  'Chị Minh Nguyệt vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[5] = ['title' =>  'Anh Mạnh Hùng vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[6] = ['title' =>  'Anh Nhật Sang vừa thêm sản phẩm vào giỏ hàng',];
            $this->options->customer[7] = ['title' =>  'Chị Thanh Vân vừa thêm sản phẩm vào giỏ hàng',];
        }
        else{
            foreach ($this->options->customer as $key => $value) {
                if(!isset($value['name'])) $value['name'] = '';
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
Widget::add('widget_slider_style_8');