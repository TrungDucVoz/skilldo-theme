<?php
class widget_about_style_11 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_11', 'About (style 11)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'descriptionColor', 'label' =>'Màu chữ mô tả nhỏ', 'type' => 'color', 'after' => '<div class="builder-col-12 col-md-12 form-group group">', 'before'=> '</div>',];
        $left[] = ['field' => 'description1', 'label' =>'Mô tả nhỏ', 'type' => 'textarea'];
        $left[] = ['field' => 'description2', 'label' =>'Mô tả lớn', 'type' => 'wysiwyg'];
        $left[] = ['field' => 'itemTitle', 'label' =>'Màu tiêu đề item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDes', 'label' =>'Màu mô tả item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Icon'), 'col' => 6],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 6, 'language' => true],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 6, 'language' => true],
        ]];
        $right[] = ['field' => 'url', 'label' =>'Liên kết', 'type' => 'text'];
        $right[] = ['field' => 'borderColor', 'label' => 'Màu bo viền', 'type' => 'color'];
        $right[] = ['field' => 'banner1_img', 'label' =>'Banner 1', 'type' => 'image'];
        $right[] = ['field' => 'banner2_img', 'label' =>'Banner 2', 'type' => 'image'];
        $right[] = ['field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => ['text_img' => 'Bài viết - Hình ảnh', 'img_text' => 'Hình ảnh - Bài viết',]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_11');
        echo $box['before']; ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-6 about-image">
                <div class="about-image-content">
                    <div class="img img1">
                        <?php Template::img($this->options->banner1_img, $this->name, ['lazy' => 'default']);?>
                    </div>
                    <div class="img img2">
                        <?php Template::img($this->options->banner2_img, $this->name, ['lazy' => 'default']);?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description-mini"><?php echo $this->options->description1;?></div>
                <div class="description"><?php echo $this->options->description2;?></div>
                <div class="button"><a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme"><?php echo __('XEM THÊM');?></a></div>
                <div class="about-item-list">
                    <?php foreach ($this->options->item as $key => $item) { ?>
                        <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $key*300;?>" data-aos="zoom-in" data-aos-duration="2000">
                            <div class="img"><?php Template::img($item['image'], $item['title'], ['lazy' => 'default']);?></div>
                            <div class="title">
                                <p class="heading"><?php echo $item['title'];?></p>
                                <?php if(!empty($item['description'])) {?><p class="description"><?php echo $item['description'];?></p><?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_about_style_11_<?php echo $this->id;?> {
                --ab11-des-color:<?php echo (!empty($this->options->descriptionColor)) ? $this->options->descriptionColor : '#000';?>;
                --ab11-item-title:<?php echo (!empty($this->options->itemTitle)) ? $this->options->itemTitle : '#000';?>;
                --ab11-item-des:<?php echo (!empty($this->options->itemDes)) ? $this->options->itemDes : '#8a8b8c';?>;
                --ab11-border-color:<?php echo (!empty($this->options->borderColor)) ? $this->options->borderColor : 'var(--theme-color)';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-11.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance['options']->item)) {
            foreach ($new_instance['options']->item as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    function default() {
        if($this->name == 'About (style 11)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description1)) $this->options->description1 = '<p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->description2)) $this->options->description2 = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->banner1_img))  $this->options->banner1_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x800';
        if(!isset($this->options->banner2_img))  $this->options->banner2_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x800';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'img_text';
        if(!isset($this->options->box_size))    {
            $this->options->box_size = [
                'margin' => ['top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0],
                'padding' => ['top' => 30, 'left' => 0, 'right' => 0, 'bottom' => 30]
            ];
        }
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-001.svg',
                'title'         =>  'Nulla dict posuere veliitae.',
                'description'   =>  'Suspendisse ullamcorper mollis orci in facilisis.',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-002.svg',
                'title'         =>  'Nulla dict posuere veliitae.',
                'description'   =>  'Etiam orci magna, accumsan varius enim volutpat.',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-003.svg',
                'title'         =>  'Etiam orci magna, accumsan.',
                'description'   =>  'Donec fringilla velit risus, in imperdiet turpis euismod quis.',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-004.svg',
                'title'         =>  'Aliquam diam tempor.',
                'description'   =>  'Aliquam pulvinar diam tempor erat pellentesque, accumsan mauri.',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['description'])) $value['description'] = '';
            }
        }
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($option->{'description1_'.$current})) $this->options->description1 = $this->options->{'description1_'.$current};
            if(isset($option->{'description2_'.$current})) $this->options->description2 = $this->options->{'description2_'.$current};
            foreach ($this->options->item as $key => &$item) {
                if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
                if(isset($item['description_'.$current])) $item['description'] = $item['description_'.$current];
            }
        }
    }
}
Widget::add('widget_about_style_11');