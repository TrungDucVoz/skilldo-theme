<?php
class widget_about_style_8 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_8', 'About (style 8)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        add_action('theme_custom_script', array( $this, 'script'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'description', 'label' =>'Mô tả', 'type' => 'wysiwyg' ];

        $left[] = ['field' => 'itemHeading', 'label' =>'Màu tiêu đề item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDes', 'label' =>'Màu mô tả item', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBackground', 'label' =>'Màu nền item', 'type' => 'background'];

        $left[] = ['field' => 'items', 'type' => 'widget_about_style_8::inputItems', 'arg' => ['number' => 7]];

        $left[] = ['field' => 'counterHeading', 'label' =>'Màu tiêu đề counter', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'counterNum', 'label' =>'Màu số counter', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'counterBackground', 'label' =>'Màu nền counter', 'type' => 'background'];


        $left[] = ['field' => 'counter', 'type' => 'widget_about_style_8::inputCounter', 'arg' => ['number' => 2]];
        $right[] = ['field'=> 'banner_img', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = ['field'=> 'position', 'label' =>'Vị trí', 'type' => 'tab', 'options' => ['text_img' => 'Bài viết - Hình ảnh', 'img_text' => 'Hình ảnh - Bài viết',]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_8');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-7 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
                <div class="row-flex">
                    <?php foreach ($this->options->items as $key => $item) { ?>
                    <div class="item item<?php echo $key;?>" data-aos-delay="<?php echo $key*300;?>" data-aos="<?php echo $item['animate'];?>" data-aos-duration="2000" style="<?php echo $this->generatorBackground($this->options->itemBackground);?>">
                        <div class="img"><?php Template::img($item['image'], $item['title'], ['lazy' => 'default']);?></div>
                        <div class="title">
                            <p class="heading"><?php echo $item['title'];?></p>
                            <?php if(!empty($item['description'])) {?>
                                <p class="description"><?php echo $item['description'];?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-5 about-image">
                <?php Template::img($this->options->banner_img, $this->name, ['lazy' => 'default']);?>
                <div class="counter-section-container" id="js_counter_section_<?php echo $this->id;?>" data-id="<?php echo $this->id;?>" style="<?php echo $this->generatorBackground($this->options->counterBackground);?>">
                    <?php foreach ($this->options->counter as $key => $counter) { ?>
                        <div class="counter-item">
                            <span class="counter" data-number="<?php echo $counter['number'];?>"></span>
                            <p class="counter-heading"><?php echo $counter['title'];?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_about_style_8_<?php echo $this->id;?> {
                --about8-item-heading-color:<?php echo (!empty($this->options->itemHeading)) ? $this->options->itemHeading : '#000';?>;
                --about8-item-des-color:<?php echo (!empty($this->options->itemDes)) ? $this->options->itemDes : '#8a8b8c';?>;
                --about8-counter-heading-color:<?php echo (!empty($this->options->counterHeading)) ? $this->options->counterHeading : '#000';?>;
                --about8-counter-num-color:<?php echo (!empty($this->options->counterNum)) ? $this->options->counterNum : '#8a8b8c';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-8.css'); }
    function script() {
        ?>
        <script>
            $(function () {
                var hasCount = [];
                function counterRun(id) {
                    let oTop = $('#js_counter_section_' + id + ' .counter-item').offset().top - window.innerHeight;
                    if(typeof hasCount[id] == 'undefined' && $(window).scrollTop() > oTop) {
                        $('#js_counter_section_' + id + ' .counter-item .counter').each(function () {
                            let $this = $(this), countTo = $this.attr("data-number");
                            $({countNum: $this.text()}).animate({countNum: countTo}, {
                                duration: 850,
                                easing: "swing",
                                step: function () {
                                    $this.text(Math.ceil(this.countNum).toLocaleString("en"));
                                },
                                complete: function () {
                                    $this.text(Math.ceil(this.countNum).toLocaleString("en"));
                                }
                            });
                        });
                        hasCount[id] = id;
                    }
                }
                $('.counter-section-container').each(function () {
                    counterRun($(this).data('id'));
                });
                $(window).scroll(function () {
                    $('.counter-section-container').each(function () {
                        counterRun($(this).data('id'));
                    });
                });
            });
        </script>
        <?php
    }
    function update( $new_instance, $old_instance ) {
        if(isset($new_instance->options->items)) {
            foreach ($new_instance->options->items as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    function default() {
        if($this->name == 'About (style 8)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->banner_img))  $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'text_img';
        if(!isset($this->options->itemBackground))    $this->options->itemBackground = [];
        if(!isset($this->options->itemHeading))    $this->options->itemHeading = '#000';
        if(!isset($this->options->itemDes))    $this->options->itemDes = '#8a8b8c';

        if(!isset($this->options->counterBackground)) $this->options->counterBackground = [];
        if(!isset($this->options->counterHeading)) $this->options->counterHeading = '#000';
        if(!isset($this->options->counterDes)) $this->options->counterDes = '#8a8b8c';

        if(!isset($this->options->box_size))    {
            $this->options->box_size = [
                'margin' => ['top' => 0, 'left' => 0, 'right' => 0, 'bottom' => 0],
                'padding' => ['top' => 30, 'left' => 0, 'right' => 0, 'bottom' => 30]
            ];
        }

        if(empty($this->options->items)) {
            $this->options->items    = [];
            $this->options->items[0] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-1.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Suspendisse ullamcorper mollis orci in facilisis.',
            ];
            $this->options->items[1] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-2.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Etiam orci magna, accumsan varius enim volutpat.',
            ];
            $this->options->items[2] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-3.png',
                'title'         =>  'Etiam orci magna, accumsan.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Donec fringilla velit risus, in imperdiet turpis euismod quis.',
            ];
            $this->options->items[3] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-4.png',
                'title'         =>  'Aliquam diam tempor.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Aliquam pulvinar diam tempor erat pellentesque',
            ];
            $this->options->items[4] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-1.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Suspendisse ullamcorper mollis orci in facilisis.',
            ];
            $this->options->items[5] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-2.png',
                'title'         =>  'Nulla dict posuere veliitae.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Etiam orci magna, accumsan varius enim volutpat.',
            ];
            $this->options->items[6] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-3.png',
                'title'         =>  'Etiam orci magna, accumsan.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Donec fringilla velit risus, in imperdiet turpis euismod quis.',
            ];
            $this->options->items[7] = [
                'image'         =>  'http://cdn.sikido.vn/images/widgets/icons-4.png',
                'title'         =>  'Aliquam diam tempor.',
                'url'           =>  'https://sikido.vn',
                'animate'       =>  'fade',
                'description'   =>  'Aliquam pulvinar diam tempor erat pellentesque',
            ];
        }
        else{
            foreach ($this->options->items as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['description'])) $value['description'] = '';
                if(!isset($value['url'])) $value['url'] = '';
                if(!isset($value['animate'])) $value['animate'] = 0;
            }
        }

        if(empty($this->options->counter)) {
            $this->options->counter    = [];
            $this->options->counter[0] = [
                'title'         =>  'Khách hàng',
                'number'        =>  '3000',
            ];
            $this->options->counter[1] = [
                'title'         =>  'Sản phẩm',
                'number'         =>  '6000'
            ];
            $this->options->counter[2] = [
                'title'         =>  'Kinh nghiệm',
                'number'         =>  '30',
            ];
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
    function generatorBackground($background) {

        $color = (!empty($background['color'])) ? $background['color'] : '';
        $image = (!empty($background['image'])) ? $background['image'] : '';
        $gradientUse = (empty($background['gradientUse'])) ? 0 : 1;

        //CSS
        $css = '';

        if(!empty($color)) $css .= 'background-color:'.$color.';';

        //background gradient
        if(!empty($gradientUse)) {
            $gradientColor1 = (empty($background['gradientColor1'])) ? '' : $background['gradientColor1'];
            $gradientColor2 = (empty($background['gradientColor2'])) ? '' : $background['gradientColor2'];
            $gradientType = (empty($background['gradientType'])) ? 'linear-gradient' : $background['gradientType'].'-gradient';
            $gradientPositionStart = (empty($background['gradientPositionStart'])) ? 0 : $background['gradientPositionStart'];
            if($gradientType == 'linear-gradient') {
                $gradientRadialDirection = (empty($background['gradientRadialDirection2'])) ? '180deg' : $background['gradientRadialDirection2'].'deg';
            }
            else {
                $gradientRadialDirection = 'circle at '.((empty($background['gradientRadialDirection1'])) ? 'center' : $background['gradientRadialDirection1']);
            }
            $gradientPositionEnd = (empty($background['gradientPositionEnd'])) ? 100 : $background['gradientPositionEnd'];
            $gradient = $gradientType.'('.$gradientRadialDirection.','.$gradientColor1.' '.$gradientPositionStart.'%, '.$gradientColor2.' '.$gradientPositionEnd.'%)';
        }

        //background image
        if(!empty($image)) {
            $imageSize = (!empty($background['imageSize'])) ? $background['imageSize'] : 'cover';
            $imagePosition = (!empty($background['imagePosition'])) ? $background['imagePosition'] : 'center center';
            $imageRepeat = (!empty($background['imageRepeat'])) ? $background['imageRepeat'] : 'no-repeat';
            $css .= 'background-image:url(\''.Template::imgLink($image).'\')'.((!empty($gradient)) ? ','.$gradient.';' : ';');
            $css .= 'background-size:'.$imageSize.';background-repeat: '.$imageRepeat.'; background-position: '.$imagePosition.';background-blend-mode: color-burn;';
        }
        else if(!empty($gradient)) {
            $css .= 'background:'.$gradient.';';
        }
        return $css;
    }
    static public function inputItems($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = array( 'image' => '', 'title' => '', 'description' => '', 'animate' => '');
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
            $Form->add($param->field.'['.$i.'][description]', 'textarea', [ 'label' => 'Mô tả',
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
                    $Form->add($param->field.'['.$i.'][description_'.$lang_key.']', 'textarea', [ 'label' => 'Mô tả ('.$lang_val['label'].')',
                        'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                    ], $value[$i]['description_'.$lang_key]);
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
    static public function inputCounter($param, $value = []) {
        if(!have_posts($value)) $value = [];
        $value_default = ['number' => '', 'title' => ''];
        //Số Lượng item
        $number = (isset($param->arg['number'])) ? (int)$param->arg['number'] : 1;
        $output = '';
        $Form = new FormBuilder();
        for ( $i = 0; $i <= $number; $i++ ) {
            if(!isset($value[$i]) || !is_array($value[$i])) $value[$i] = [];
            $value[$i] = array_merge($value_default, $value[$i]);
            $output .= '<label for="name" class="control-label">Item '.($i+1).'</label>';
            $output .= '<div class="stote_wg_item">';
            $Form->add($param->field.'['.$i.'][number]', 'number', [ 'label' => 'Số đếm',
                'after' => '<div class="col-md-12"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['number']);
            $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
                'after' => '<div class="col-md-12"><div class="form-group group">', 'before' => '</div></div>'
            ], $value[$i]['title']);
            if(Language::hasMulti()) {
                foreach (Language::list() as $lang_key => $lang_val) {
                    if($lang_key == Language::default()) continue;
                    $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                    $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', ['label' => 'Tiêu đề ('.$lang_val['label'].')', 'after' => '<div class="col-md-12"><div class="form-group group">', 'before' => '</div></div>'], $value[$i]['title_'.$lang_key]);
                }
            }
            $output .= $Form->html();
            $output .= '</div>';
        }
        return $output;
    }
}
Widget::add('widget_about_style_8');