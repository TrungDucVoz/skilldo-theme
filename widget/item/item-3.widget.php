<?php
class widget_item_style_3 extends widget {
    function __construct() {
        parent::__construct('widget_item_style_3', 'Item 3', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = array('field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu tiêu đề item');
        $left[] = array('field' => 'itemDesColor', 'type' => 'color', 'label' => 'Màu mô tả item');
        $left[] = array('field' => 'item', 'type' => 'widget_item_style_3::inputItem', 'arg' => ['number' => 5]);
        parent::form($left, $right);
    }
    function widget() {
        $box    = $this->container_box('widget_item_style_3');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div class="row row-flex">
            <?php foreach ($this->options->item as $key => $item) { ?>
            <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $key*300;?>" data-aos="<?php echo $item['animate'];?>" data-aos-duration="2000">
                <a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>">
                    <div class="img"><?php Template::img($item['image'], $item['title']);?></div>
                    <div class="title">
                        <p class="heading"><?php echo $item['title'];?></p>
                        <?php if(!empty($item['description'])) {?>
                            <p class="description"><?php echo $item['description'];?></p>
                        <?php } ?>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <style>
            :root {
                --item3-title-color:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --item3-des-color:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#8a8b8c';?>;
            }
        </style>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-1.png',
                'title'         =>  'Tiêu đề item 1',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 1',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-2.png',
                'title'         =>  'Tiêu đề item 2',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 2',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-3.png',
                'title'         =>  'Tiêu đề item 3',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 3',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-4.png',
                'title'         =>  'Tiêu đề item 4',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 4',
            ];
            $this->options->item[4] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-1.png',
                'title'         =>  'Tiêu đề item 5',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 5',
            ];
            $this->options->item[5] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-2.png',
                'title'         =>  'Tiêu đề item 6',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Nội dung mô tả của item 6',
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
    function css() { include_once('css/item-style-3.css'); }
    function update( $new_instance, $old_instance ) {
        if(isset($new_instance->options['item'])) {
            foreach ($new_instance->options['item'] as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    static function inputItem($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'url' => '', 'animate' => '', 'description' => '' );
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
            $Form->add($param->field.'['.$i.'][description]', 'text', [ 'label' => 'Mô tả',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['description']);
            if(Language::hasMulti()) {
                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $value[$i]['description_'.$lang_key] = (!empty($value[$i]['description_'.$lang_key])) ? $value[$i]['description_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['title_'.$lang_key]);
                    $Form->add($param->field.'['.$i.'][description_'.$lang_key.']', 'text', [ 'label' => 'Mô tả ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['description_'.$lang_key]);
                }
            }
            $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
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

Widget::add('widget_item_style_3');