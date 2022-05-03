<?php
class widget_about_style_10 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_10', 'About (style 10)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'description', 'label' =>'Mô tả', 'type' => 'wysiwyg' ];
        $left[] = ['field' => 'item', 'type' => 'widget_about_style_10::inputItem', 'arg' => ['number' => 2]];
        $right[] = ['field' => 'url', 'label' =>'Liên kết', 'type' => 'text'];
        $right[] = ['field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => ['text_img' => 'Bài viết - Item', 'img_text' => 'Item - Bài viết',]];

        $right[] = ['field' => 'itemBg', 'label' =>'Màu nền item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>',];
        $right[] = ['field' => 'itemBgHover', 'label' =>'Màu nền item (hover)', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>',];
        $right[] = ['field' => 'itemTxt', 'label' =>'Màu chữ item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>',];
        $right[] = ['field' => 'itemTxtHover', 'label' =>'Màu chữ item (hover)', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>',];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_10');
        echo $box['before']; ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-3 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
                <div class="button"><a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme"><?php echo __('XEM THÊM');?></a></div>
            </div>
            <div class="<?php echo $this->options->position;?> col-md-9 about-item">
                <div class="about-item-content" id="about_item_content_<?php echo $this->id;?>">
                    <?php foreach ($this->options->item as $key => $item) { ?>
                        <div class="item-box" data-aos-delay="<?php echo $key*300;?>" data-aos="fade-up" data-aos-duration="2000">
                            <div class="effect-hover-zoom item item<?php echo $key;?>">
                                <div class="img"><a href="<?php echo $item['url'];?>"><?php Template::img($item['image'], $item['title'], ['lazy' => 'default']);?></a></div>
                                <div class="title">
                                    <a href="<?php echo $item['url'];?>"><p class="heading"><?php echo $item['title'];?></p></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_about_style_10_<?php echo $this->id;?> {
                --ab10-item-bg:<?php echo (!empty($this->options->itemBg)) ? $this->options->itemBg : 'var(--theme-color)';?>;
                --ab10-item-bg-hover:<?php echo (!empty($this->options->itemBgHover)) ? $this->options->itemBgHover : '#fff';?>;
                --ab10-item-txt:<?php echo (!empty($this->options->itemTxt)) ? $this->options->itemTxt : '#fff';?>;
                --ab10-item-txt-hover:<?php echo (!empty($this->options->itemTxtHover)) ? $this->options->itemTxtHover : 'var(--theme-color)';?>;
            }
        </style>
        <?php if(Device::isMobile()) {?>
            <script defer>
                $(function(){
                    let windowWidth = $(document).width();
                    if(windowWidth <= 600) {
                        let config = {
                            infinite: true,
                            dots: false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            speed: 500,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                        };
                        $('#about_item_content_<?php echo $this->id;?>').slick(config);
                    }
                });
            </script>
        <?php } ?>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-10.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance['options']->item)) {
            foreach ($new_instance['options']->item as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    function default() {
        if($this->name == 'About (style 10)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'text_img';
        if(!isset($this->options->box_size))    {
            $this->options->box_size = [
                'margin' => ['top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0],
                'padding' => ['top' => 30, 'left' => 0, 'right' => 0, 'bottom' => 30]
            ];
        }
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x400',
                'title'         =>  'Local bread suppliers close to you',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x400',
                'title'         =>  'All potato on sale!',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x400',
                'title'         =>  'Forest mushrooms. Macadamia Nuts',
                'url'           =>  'https://sikido.vn',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['url'])) $value['url'] = '';
            }
        }
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($option->{'description_'.$current})) $this->options->description = $this->options->{'description_'.$current};
            foreach ($this->options->item as $key => &$item) {
                if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
                if(isset($item['description_'.$current])) $item['description'] = $item['description_'.$current];
            }
        }
    }
    static public function inputItem($param, $value = []) {
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
            if(Language::hasMulti()) {
                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $value[$i]['description_'.$lang_key] = (!empty($value[$i]['description_'.$lang_key])) ? $value[$i]['description_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                }
            }
            $Form->add($param->field.'['.$i.'][url]', 'text', [ 'label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}
Widget::add('widget_about_style_10');