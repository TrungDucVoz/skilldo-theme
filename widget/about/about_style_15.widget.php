<?php
class widget_about_style_15 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_15', 'About (style 15)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'description1', 'label' =>'Mô tả trên', 'type' => 'wysiwyg'];
        $left[] = ['field' => 'description2', 'label' =>'Mô tả dưới', 'type' => 'wysiwyg'];
        $left[] = ['field' => 'itemTitle', 'label' =>'Màu tiêu đề item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDes', 'label' =>'Màu mô tả item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Icon'), 'col' => 6],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 6, 'language' => true],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 6, 'language' => true],
        ]];
        $right[] = ['field' => 'banner1_img', 'label' =>'Banner 1', 'type' => 'image'];
        $right[] = ['field' => 'banner2_img', 'label' =>'Banner 2', 'type' => 'image'];
        $right[] = ['field' => 'url', 'label' =>'Liên kết video youtube', 'type' => 'text'];
        $right[] = ['field' => 'videoColor', 'label' =>'Màu button video', 'type' => 'color'];
        $right[] = ['field' => 'avatar', 'label' => 'Hình avatar', 'type' => 'image'];
        $right[] = ['field' => 'signature', 'label' => 'Hình chữ ký', 'type' => 'image'];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_15');
        echo $box['before']; ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-6 order-md-1 order-2 about-image">
                <div class="about-image-content">
                    <div class="img1">
                        <?php Template::img($this->options->banner1_img, $this->name, ['lazy' => 'default']);?>
                    </div>
                    <div class="img2" data-aos-delay="300" data-aos="fade-right" data-aos-duration="800">
                        <?php Template::img($this->options->banner2_img, $this->name, ['lazy' => 'none']);?>
                        <a href="<?php echo $this->options->url;?>" data-fancybox class="video-box"><span class="fa fa-play"><i class="ripple"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 about-content order-md-2 order-1">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description-mini"><?php echo $this->options->description1;?></div>
                <div class="about-item-list">
                    <?php foreach ($this->options->item as $key => $item) { ?>
                        <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $key*100;?>" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="img"><?php Template::img($item['image'], $item['title'], ['lazy' => 'default']);?></div>
                            <div class="title">
                                <p class="heading"><?php echo $item['title'];?></p>
                                <?php if(!empty($item['description'])) {?><p class="description"><?php echo $item['description'];?></p><?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="about-author-box">
                    <div class="box-inner">
                        <div class="comment"><?php echo $this->options->description2;?></div>
                        <div class="lower-box">
                            <div class="lower-inner">
                                <div class="author-image">
                                    <?php Template::img($this->options->avatar, $this->name, ['lazy' => 'default']);?>
                                </div>
                                <div class="signature">
                                    <?php Template::img($this->options->signature, $this->name, ['lazy' => 'default']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .js_widget_about_style_15_<?php echo $this->id;?> {
                --ab-item-title:<?php echo (!empty($this->options->itemTitle)) ? $this->options->itemTitle : '#000';?>;
                --ab-item-des:<?php echo (!empty($this->options->itemDes)) ? $this->options->itemDes : '#8a8b8c';?>;
                --ab-video-bg:<?php echo (!empty($this->options->videoColor)) ? $this->options->videoColor : 'var(--theme-color)';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-15.css'); }
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
        if(!isset($this->options->description1)) $this->options->description1 = '<p>We are specializes in technological and IT-related services such as product engineering, warranty management, building cloud, infrastructure, network, etc. We put a strong focus on the needs of your business to figure out solutions that best fits your demand and nail it.</p>';
        if(!isset($this->options->description2)) $this->options->description2 = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->banner1_img)) $this->options->banner1_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500';
        if(!isset($this->options->banner2_img)) $this->options->banner2_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500';
        if(!isset($this->options->avatar))      $this->options->avatar = 'http://wp1.efforttech.com/newwp/nitech/wp-content/uploads/2021/08/author-1.jpg';
        if(!isset($this->options->signature))   $this->options->signature = 'http://wp1.efforttech.com/newwp/nitech/wp-content/uploads/2021/08/signature.png';
        if(!isset($this->options->url))         $this->options->url = '';
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
                'title'         =>  'Expert Needed Worker',
                'description'   =>  '',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-002.svg',
                'title'         =>  'Urgent Support For Clients',
                'description'   =>  '',
            ];
        }
        else {
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
Widget::add('widget_about_style_15');