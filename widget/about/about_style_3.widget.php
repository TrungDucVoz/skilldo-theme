<?php
class widget_about_style_3 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_3', 'About (style 3)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'description', 'label' =>'Mô tả', 'type' => 'wysiwyg' ];
        $left[] = ['field' => 'item', 'type' => 'widget_about_style_3::inputItems', 'arg' => ['number' => 3]];
        $right[] = [ 'field' => 'url', 'label' =>'Liên kết', 'type' => 'text'];
        $right[] = [ 'field' => 'banner_img', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => [
            'text_img' => 'Bài viết - Hình ảnh',
            'img_text' => 'Hình ảnh - Bài viết',
        ]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_3');
        echo $box['before'];
        if($this->name != ''){?><?php }
        ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-6 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
                <div class="row">
                    <?php foreach ($this->options->item as $key => $item) { ?>
                        <div class="col-sm-6 col-md-6">
                            <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $key*300;?>" data-aos="<?php echo $item['animate'];?>" data-aos-duration="2000">
                                <div class="img"><?php Template::img($item['image'], $item['title'], ['lazy' => 'default']);?></div>
                                <div class="title">
                                    <p class="heading"><?php echo $item['title'];?></p>
                                    <?php if(!empty($item['description'])) {?>
                                        <p class="description"><?php echo $item['description'];?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="button text-center"><a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme"><?php echo __('XEM THÊM');?></a></div>
            </div>
            <div class="col-md-6 about-image">
                <?php Template::img($this->options->banner_img, $this->name, ['lazy' => 'default']);?>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-3.css'); }
    function update( $new_instance, $old_instance ) {
        if(isset($new_instance['options']['item'])) {
            foreach ($new_instance['options']['item'] as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    function default() {
        if(!isset($this->options->heading))    {
            $this->options->heading = ['style' => 'style11', 'margin_top' => 40, 'margin_bottom' => 30];
        }
        if($this->name == 'About (style 3)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->banner_img))  $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x800';
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
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-1.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Suspendisse ullamcorper mollis orci in facilisis.',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-2.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Etiam orci magna, accumsan varius enim volutpat.',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-3.png',
                'title'         =>  'Etiam orci magna, accumsan.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Donec fringilla velit risus, in imperdiet turpis euismod quis.',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-4.png',
                'title'         =>  'Aliquam diam tempor.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Aliquam pulvinar diam tempor erat pellentesque, accumsan mauri.',
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
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($this->options->{'description_'.$current})) $this->options->description = $this->options->{'description_'.$current};
            foreach ($this->options->item as $key => &$item) {
                if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
            }
        }
        return $this->options;
    }
    static public function inputItems($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'animate' => '');
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
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                }
            }
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
Widget::add('widget_about_style_3');