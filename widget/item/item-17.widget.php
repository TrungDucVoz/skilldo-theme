<?php
class widget_item_style_17 extends widget {
    function __construct() {
        parent::__construct('widget_item_style_17', 'Item 17', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'Ngọc Diệp';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu tiêu đề item', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemHeadingColorHover', 'type' => 'color', 'label' => 'Màu tiêu đề item (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBgColor', 'type' => 'color', 'label' => 'Màu nền item', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBgColorHover', 'type' => 'color', 'label' => 'Màu nền item (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = array('field' => 'item', 'type' => 'widget_item_style_17::inputItem', 'arg' => ['number' => 4]);

        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $right[] = ['field' => 'itemHeadingFont', 'label' => 'Font tiêu đề item', 'type' => 'select', 'options' => $fonts, 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'itemHeadingWeight', 'label' => 'Độ đậm tiêu đề item', 'type' => 'tab', 'options' => ['300' => 300, 400 => 400, 500 => 500, 'bold' => 'bold'], 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>', 'value' => 'bold'];
        $right[] = ['field' => 'itemHeadingFontSize', 'label' => 'Font size tiêu đề item', 'type' => 'tab', 'value' => 15, 'options' => ['13' => '13', '14' => '14', '15' => '15', '16' => '16', '18' => '18', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '42' => '42', '50' => '50']];
        $right[] = ['field' => 'url', 'label' => 'Liên kết button', 'type' => 'text',];

        parent::form($left, $right);
    }
    function widget() {
        $box  = $this->container_box('widget_item_style_17');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div class="inner-container" style="position: relative;">
            <div class="row-flex">
                <?php foreach ($this->options->item as $key => $item) { ?>
                    <div class="item item<?php echo $key;?>">
                        <a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>">
                            <div class="color-layer"></div>
                            <div class="img">
                                <?php Template::img($item['image'], $item['title']);?>
                            </div>
                            <div class="title">
                                <p class="heading"><?php echo $item['title'];?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if(!empty($this->options->url)) {?>
        <div class="text-center" style="margin-top: 30px;">
            <a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme">Xem Tất Cả</a>
        </div>
        <?php } ?>
        <style>
            .js_widget_item_style_17_<?php echo $this->id;?> {
                --item-title:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --item-title-active:<?php echo (!empty($this->options->itemHeadingColorHover)) ? $this->options->itemHeadingColorHover : '#fff';?>;
                --item-bg:<?php echo (!empty($this->options->itemBgColor)) ? $this->options->itemBgColor : '#ffff';?>;
                --item-bg-active:<?php echo (!empty($this->options->itemBgColorHover)) ? $this->options->itemBgColorHover : 'var(--theme-color)';?>;
                --item-title-font:<?php echo (!empty($this->options->itemHeadingFont)) ? $this->options->itemHeadingFont : 'var(--font-family)';?>;
                --item-title-font-size:<?php echo (!empty($this->options->itemHeadingFontSize)) ? $this->options->itemHeadingFontSize : '15';?>px;
                --item-title-weight:<?php echo (!empty($this->options->itemHeadingWeight)) ? $this->options->itemHeadingWeight : 'bold';?>;
            }
        </style>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-001.svg',
                'title'         =>  'Miễn Phí Vận Chuyển',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-002.svg',
                'title'         =>  'Sản Phẩm Chất Lượng',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-003.svg',
                'title'         =>  'Bảo Hành Từ 1 – 5 Năm',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-004.svg',
                'title'         =>  'Đội Ngũ Giàu Kinh Nghiệm',
                'url'           =>  'https://sikido.vn',
            ];
            $this->options->item[4] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/set-icon-005.svg',
                'title'         =>  'Đội Ngũ Giàu Kinh Nghiệm',
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
        $language_current = Language::current();
        if(Language::hasMulti() && Language::default() != $language_current) {
            foreach ($this->options->item as $key => &$item) {
                if(isset($item['title_'.$language_current])) $item['title'] = $item['title_'.$language_current];
            }
        }
    }
    function css() { include_once('css/item-style-17.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance->options['item'])) {
            foreach ($new_instance->options['item'] as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    static function inputItem($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = ['image' => '', 'title' => '', 'url' => ''];
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
            $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
                'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['url']);
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}

Widget::add('widget_item_style_17');