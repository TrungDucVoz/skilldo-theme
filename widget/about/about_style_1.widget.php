<?php
class widget_about_style_1 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_1', 'About (style 1)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'description', 'label' =>'Mô tả', 'type' => 'wysiwyg' ];
        $left[] = [ 'field' => 'url', 'label' =>'Liên kết', 'type' => 'text'];
        $right[] = [ 'field'=> 'banner_img', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => ['text_img' => 'Bài viết - Hình ảnh', 'img_text' => 'Hình ảnh - Bài viết',]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_1');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-6 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
                <div class="button">
                    <a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme"><?php echo __('XEM THÊM');?></a>
                </div>
            </div>
            <div class="col-md-6 about-image">
                <?php Template::img($this->options->banner_img, $this->name, ['lazy' => 'default', 'data-depth' => 0.5]);?>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function default() {
        if($this->name == 'About (style 1)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->banner_img))  $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x600';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'text_img';
        if(!isset($this->options->box_size))    {
            $this->options->box_size = [
                'margin' => ['top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0],
                'padding' => ['top' => 30, 'left' => 0, 'right' => 0, 'bottom' => 30]
            ];
        }
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($this->options->{'description_'.$current})) $this->options->description = $this->options->{'description_'.$current};
        }
    }
    function css() { include_once('assets/about-style-1.css'); }
}

Widget::add('widget_about_style_1');
