<?php
class widget_about_style_12 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_12', 'About (style 12)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'Ngọc Diệp';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'tabsBg', 'label' =>'Màu nền tab', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabsTxt', 'label' =>'Màu chữ tab', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabsBorder', 'label' =>'Màu viền tab', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabsBgActive', 'label' =>'Màu nền tab active', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabsTxtActive', 'label' =>'Màu chữ tab active', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabsBorderActive', 'label' =>'Màu viền tab active', 'type' => 'color', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'tabs', 'label' =>'Danh sách tabs', 'type' => 'repeater', 'fields' => [
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'language' => true],
            ['name' => 'content', 'type' => 'wysiwyg',  'label' => __('Nội dung'), 'language' => true],
        ]];
        $right[] = [ 'field'=> 'banner_img', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => ['text_img' => 'Bài viết - Hình ảnh', 'img_text' => 'Hình ảnh - Bài viết',]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_12');
        echo $box['before'];
        ?>
        <div class="col-md-12">
            <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        </div>
        <div class="row row-flex <?php echo $this->options->position;?>">
            <div class="col-sm-6 col-md-6 about-image">
                <?php Template::img($this->options->banner_img, $this->name, ['lazy' => 'default', 'data-depth' => 0.5]);?>
            </div>
            <div class="col-sm-6 col-md-6 about-content">
                <div class="content">
                    <?php if(!empty($this->options->tabs)) {?>
                    <div class="about-tabs">
                        <ul class="nav nav-tabs">
                            <?php $i = 0; foreach ($this->options->tabs as $key => $tab) { $i++; ?>
                                <li class="<?php echo ($i == 1) ? 'active' : '';?>"><a data-toggle="tab" href="#<?php echo $key;?>" aria-expanded="false"><?php echo $tab['title'];?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php $i = 0; foreach ($this->options->tabs as $key => $tab) { $i++; ?>
                                <div id="<?php echo $key;?>" class="tab-pane fade <?php echo ($i == 1) ? 'active in' : '';?>"><?php echo $tab['content'];?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <style>
            :root {
                --about12-tab-bg:<?php echo (!empty($this->options->tabsBg)) ? $this->options->tabsBg : '#fff';?>;
                --about12-tab-txt:<?php echo (!empty($this->options->tabsTxt)) ? $this->options->tabsTxt : '#AEAEAE';?>;
                --about12-tab-border:<?php echo (!empty($this->options->tabsBorder)) ? $this->options->tabsBorder : '#AEAEAE';?>;
                --about12-tab-bg-active:<?php echo (!empty($this->options->tabsBgActive)) ? $this->options->tabsBgActive : '#fff';?>;
                --about12-tab-txt-active:<?php echo (!empty($this->options->tabsTxtActive)) ? $this->options->tabsTxtActive : '#000';?>;
                --about12-tab-border-active:<?php echo (!empty($this->options->tabsBorderActive)) ? $this->options->tabsBorderActive : '#000';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function default() {
        if($this->name == 'About (style 12)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->banner_img))  $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/600x600';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'img_text';
        if(empty($this->options->item)) {
            $this->options->tabs    = [];
            $this->options->tabs[0] = [
                'title'     =>  'Thế mạnh',
                'content'   =>  '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>',
            ];
            $this->options->tabs[1] = [
                'title'     =>  'Tầm nhìn',
                'content'   =>  '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>',
            ];
            $this->options->tabs[2] = [
                'title'     =>  'Sứ mệnh',
                'content'   =>  '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>',
            ];
        }
        else{
            foreach ($this->options->tabs as $key => $value) {
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['content'])) $value['content'] = '';
            }
        }
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($this->options->{'description_'.$current})) $this->options->description = $this->options->{'description_'.$current};
        }
    }
    function css() { include_once('assets/about-style-12.css'); }
}

Widget::add('widget_about_style_12');
