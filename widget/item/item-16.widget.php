<?php
class widget_item_style_16 extends widget {

    function __construct() {
        parent::__construct('widget_item_style_16', 'Item 16', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {

        $left[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu tiêu đề item', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemHeadingColorHover', 'type' => 'color', 'label' => 'Màu tiêu đề item (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $left[] = ['field' => 'itemHeadingFont', 'label' => 'Font tiêu đề item', 'type' => 'select', 'options' => $fonts, 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemHeadingWeight', 'label' => 'Độ đậm tiêu đề item', 'type' => 'tab', 'options' => ['300' => 300, 400 => 400, 500 => 500, 'bold' => 'bold'], 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>', 'value' => 'bold'];
        $left[] = ['field' => 'itemHeadingFontSize', 'label' => 'Font size tiêu đề item', 'type' => 'tab', 'value' => 20, 'options' => ['13' => '13', '14' => '14', '15' => '15', '16' => '16', '18' => '18', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '42' => '42', '50' => '50']];

        $left[] = ['field' => 'itemDesColor', 'type' => 'color', 'label' => 'Màu mô tả item', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDesColorHover', 'type' => 'color', 'label' => 'Màu mô tả item (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];

        $left[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Icon'), 'col' => 4],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 4, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 4],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 12, 'language' => true],
        ]];

        $right[] = ['field' => 'itemIconColor', 'type' => 'color', 'label' => 'Màu nền icon', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'itemIconColorHover', 'type' => 'color', 'label' => 'Màu nền icon (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];

        $right[] = ['field' => 'per', 'label' =>'Số item/hàng (Desktop)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = ['field' => 'perTablet', 'label' =>'Số item/hàng (Tablet)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 4]];
        $right[] = ['field' => 'perMobile', 'label' =>'Số item/hàng (Mobile)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 2]];

        if(method_exists('Template','cssBg')) {
            $right[] = ['field' => 'itemBgHover', 'label' => 'Nền item (hover)', 'type' => 'background'];
        }

        parent::form($left, $right);
    }
    function widget() {
        $box  = $this->container_box('widget_item_style_16');
        echo $box['before'];
        $number = 0;
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div class="swiper" id="item_style_16_<?php echo $this->id;?>">
            <div class="row-flex list-item swiper-wrapper">
                <?php foreach ($this->options->item as $key => $item) { ?>
                    <div class="service-block swiper-slide">
                        <div class="inner-box">
                            <div class="icon"><?php Template::img($item['image'], $item['title']);?></div>
                            <div class="service-number">0<?php echo ++$number;?></div>
                            <h3><a href="<?php echo $item['url'];?>"><?php echo $item['title'];?></a></h3>
                            <div class="text"><?php echo $item['description'];?></div>
                            <a href="<?php echo $item['url'];?>" class="read-more"><?php echo __('Xem thêm');?> <span class="fa fa-angle-double-right"></span></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <style>
            .js_widget_item_style_16_<?php echo $this->id;?> {
                --item-title:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#222';?>;
                --item-title-active:<?php echo (!empty($this->options->itemHeadingColorHover)) ? $this->options->itemHeadingColorHover : 'var(--theme-color)';?>;
                --item-title-font:<?php echo (!empty($this->options->itemHeadingFont)) ? $this->options->itemHeadingFont : 'var(--font-family)';?>;
                --item-title-font-size:<?php echo (!empty($this->options->itemHeadingFontSize)) ? $this->options->itemHeadingFontSize : '18';?>px;
                --item-title-weight:<?php echo (!empty($this->options->itemHeadingWeight)) ? $this->options->itemHeadingWeight : 'bold';?>;
                --item-des:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#555';?>;
                --item-des-active:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#555';?>;
                --item-icon-bg:<?php echo (!empty($this->options->itemIconColor)) ? $this->options->itemIconColor : '#00085c';?>;
                --item-icon-bg-active:<?php echo (!empty($this->options->itemIconColorHover)) ? $this->options->itemIconColorHover : 'var(--theme-color)';?>;
            }
            <?php if(method_exists('Template','cssBg')) { ?>
            .js_widget_item_style_16_<?php echo $this->id;?> .list-item .service-block .inner-box:hover:before {
                <?php echo Template::cssBg($this->options->itemBgHover);?>
            }
            <?php } ?>
        </style>
        <script>
            $(function () {
                var swiper = new Swiper("#item_style_16_<?php echo $this->id;?>", {
                    slidesPerView: <?php echo $this->options->per;?>,
                    spaceBetween: 30,
                    loop: true,
                    breakpoints : {
                        0: { slidesPerView: 1 },
                        500: { slidesPerView: <?php echo $this->options->perMobile;?>, spaceBetween: 5, },
                        768: { slidesPerView: <?php echo $this->options->perTablet;?>, spaceBetween: 20 },
                        1100: { slidesPerView: <?php echo $this->options->per;?> },
                    }
                });
            })
        </script>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->per)) $this->options->per = 4;
        if(!isset($this->options->perTablet)) $this->options->perTablet = 3;
        if(!isset($this->options->perMobile)) $this->options->perMobile = 2;
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->itemBgHover)) $this->options->itemBgHover = [];
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-004.svg',
                'title'         =>  'Software Development',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'We are the best world Information Technology Company',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-005.svg',
                'title'         =>  'Branding and Design',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Providing the highest quality in hardware & Network solutions',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-006.svg',
                'title'         =>  'Website Development',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'About more than 25 years of experience and 1000 of innovative achievements.',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-007.svg',
                'title'         =>  'Mobile Development',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'consectetur adipisicing perspiciatis eiusmod tempor incididunt excepteur labore magna aliqua obtain some advantage from it',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['description'])) $value['description'] = '';
                if(!isset($value['url'])) $value['url'] = '';
                if(!isset($value['animate'])) $value['animate'] = 0;
            }
        }
        $this->language();
    }
    function language() {
        $language_current = Language::current();
        if(Language::hasMulti() && Language::default() != $language_current) {
            foreach ($this->options->item as $key => &$item) {
                if(isset($item['title_'.$language_current])) $item['title'] = $item['title_'.$language_current];
                if(isset($item['description_'.$language_current])) $item['description'] = $item['description_'.$language_current];
            }
        }
    }
    function css() { include_once('css/item-style-16.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance['options']->item)) {
            foreach ($new_instance['options']->item as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
}

Widget::add('widget_item_style_16');