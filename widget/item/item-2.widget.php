<?php
class widget_item_style_2 extends widget {
    function __construct() {
        parent::__construct('widget_item_style_2', 'Item 2', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu tiêu đề item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDesColor', 'type' => 'color', 'label' => 'Màu mô tả item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemHeight', 'type' => 'number', 'label' => 'Chiều cao icon', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>', 'value' => 60];

        $left[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Icon'), 'col' => 4],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 4, 'language' => true],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 4, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
            ['name' => 'animate', 'type' => 'select', 'label' => __('Hiệu ứng'), 'options' => animate_css_option(), 'col' => 6],
        ]];

        $right[] = ['field' => 'per', 'label' =>'Số item/hàng (Desktop)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = ['field' => 'perTablet', 'label' =>'Số item/hàng (Tablet)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 4]];
        $right[] = ['field' => 'perMobile', 'label' =>'Số item/hàng (Mobile)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 2]];

        parent::form($left, $right);
    }
    function widget() {
        $number = 0;
        $box = $this->container_box('widget_item_style_2');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div class="row-flex">
            <?php foreach ($this->options->item as $key => $item) { ?>
                <div class="service-block">
                    <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $number++*100;?>" data-aos="<?php echo $item['animate'];?>" data-aos-duration="2000">
                        <div class="img"><a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php Template::img($item['image'], $item['title']);?></a></div>
                        <div class="title">
                            <p class="heading"><a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php echo $item['title'];?></a></p>
                            <?php if(!empty($item['description'])) {?>
                                <p class="description"><a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php echo $item['description'];?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <style>
            .js_widget_item_style_2_<?php echo $this->id;?> {
                --item-title:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --item-des:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#8a8b8c';?>;
                --item-height:<?php echo (!empty($this->options->itemHeight)) ? $this->options->itemHeight : '60';?>px;

                --item-per-row:<?php echo $this->options->template;?>;
                --item-per-row-tablet:<?php echo $this->options->templateTablet;?>;
                --item-per-row-mobile:<?php echo $this->options->templateMobile;?>;
            }
        </style>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->per)) $this->options->per = 4;
        $this->options->template = '';
        for($i = 0; $i < $this->options->per; $i++) $this->options->template .= '1fr ';
        if(!isset($this->options->perTablet)) $this->options->perTablet = 2;
        $this->options->templateTablet = '';
        for($i = 0; $i < $this->options->perTablet; $i++) $this->options->templateTablet .= '1fr ';
        if(!isset($this->options->perMobile)) $this->options->perMobile = 2;
        $this->options->templateMobile = '';
        for($i = 0; $i < $this->options->perMobile; $i++) $this->options->templateMobile .= '1fr ';
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-001.svg',
                'title'         =>  'Tiêu đề item 1',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 1',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-002.svg',
                'title'         =>  'Tiêu đề item 2',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 2',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-003.svg',
                'title'         =>  'Tiêu đề item 3',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 3',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-004.svg',
                'title'         =>  'Tiêu đề item 4',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 4',
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
    function css() { include_once('css/item-style-2.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance['options']->item)) {
            foreach ($new_instance['options']->item as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
}

Widget::add('widget_item_style_2');