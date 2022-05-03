<?php
class widget_item_style_13 extends widget {
    function __construct() {
        parent::__construct('widget_item_style_13', 'Item 13', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'Hữu Trọng';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu heading', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDesColor', 'type' => 'color', 'label' => 'Màu mô tả item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBorderColor', 'type' => 'color', 'label' => 'Màu viền item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];

        $left[] = ['field' => 'itemPadding1', 'type' => 'number', 'label' => 'Khoảng cách trên / dưới', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>', 'value' => '60'];
        $left[] = ['field' => 'itemPadding2', 'type' => 'number', 'label' => 'Khoảng cách trái / phải', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>', 'value' => '20'];

        $left[] = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Icon'), 'col' => 6],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 6, 'language' => true],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 6, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
        ]];
        $right[] = ['field' => 'per_row', 'label' =>'Số item/hàng (Desktop)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = ['field' => 'per_row_tablet', 'label' =>'Số item/hàng (Tablet)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 4]];
        $right[] = ['field' => 'per_row_mobile', 'label' =>'Số item/hàng (Mobile)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 2]];
        $right[] = ['field' => 'itemBgColor', 'type' => 'background', 'label' => 'Nền item'];
        parent::form($left, $right);
    }
    function widget() {
        $box  = $this->container_box('widget_item_style_13');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div id="item_style_13_content_<?php echo $this->id;?>">
            <div class="row-flex list-item">
                <?php foreach ($this->options->item as $key => $item) { ?>
                    <div class="item item<?php echo $key;?>">
                        <a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>">
                            <div class="img">
                                <?php Template::img($item['image'], $item['title']);?>
                            </div>
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
        </div>
        <style>
            .js_widget_item_style_13_<?php echo $this->id;?> {
                --item13-title-color:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --item13-des-color:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#8a8b8c';?>;
                --item13-border-color:<?php echo (!empty($this->options->itemBorderColor)) ? $this->options->itemBorderColor : '#ccc';?>;
                --item13-per-row:calc(100% / <?php echo (!empty($this->options->per_row)) ? $this->options->per_row : 3;?> - 30px);
                --item13-per-row-tablet:calc(100% / <?php echo (!empty($this->options->per_row_tablet)) ? $this->options->per_row_tablet : 2;?> - 30px);
                --item13-per-row-mobile:calc(100% / <?php echo (!empty($this->options->per_row_mobile)) ? $this->options->per_row_mobile : 1;?> - 30px);
            }
            .js_widget_item_style_13_<?php echo $this->id;?>.widget_item_style_13 .item {
                <?php echo $this->backgroundRender($this->options->itemBgColor);?>
                padding: <?php echo $this->options->itemPadding1+30;?>px <?php echo $this->options->itemPadding2;?>px <?php echo $this->options->itemPadding1;?>px <?php echo $this->options->itemPadding2;?>px;
            }
            .js_widget_item_style_13_<?php echo $this->id;?>.widget_item_style_13 .item .img{
                top:-<?php echo $this->options->itemPadding1+25;?>px;
            }
        </style>
        <?php if(Device::isMobile()) {?>
        <script defer>
            $(function(){
                let config = {
                    infinite: true,
                    dots:false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 500,
                    slidesToShow: <?php echo (!empty($this->options->per_row_mobile)) ? $this->options->per_row_mobile : 1;?>,
                    slidesToScroll: 1,
                };
                $('#item_style_13_content_<?php echo $this->id;?> .list-item').slick(config);
            });
        </script>
        <?php } ?>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->per_row)) $this->options->per_row = 3;
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 2;
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 1;
        if(!isset($this->options->itemPadding1)) $this->options->itemPadding1 = 60;
        if(!isset($this->options->itemPadding2)) $this->options->itemPadding2 = 30;
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-001.svg',
                'title'         =>  'Miễn Phí Vận Chuyển',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
            $this->options->item[1] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-002.svg',
                'title'         =>  'Sản Phẩm Chất Lượng',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
            $this->options->item[2] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-003.svg',
                'title'         =>  'Bảo Hành Từ 1 – 5 Năm',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
            $this->options->item[3] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-004.svg',
                'title'         =>  'Đội Ngũ Giàu Kinh Nghiệm',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
            $this->options->item[4] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-005.svg',
                'title'         =>  'Đội Ngũ Giàu Kinh Nghiệm',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
            $this->options->item[5] = [
                'image'         =>  'https://cdn.sikido.vn/images/widgets/set-icon-006.svg',
                'title'         =>  'Đội Ngũ Giàu Kinh Nghiệm',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['description'])) $value['description'] = '';
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
                if(isset($item['description_'.$language_current])) $item['description'] = $item['description_'.$language_current];
            }
        }
    }
    function css() { include_once('css/item-style-13.css'); }
    function update($new_instance, $old_instance) {
        if(isset($new_instance['options']->item)) {
            foreach ($new_instance['options']->item as $key => &$item) {
                $item['image'] = FileHandler::handlingUrl($item['image']);
            }
        }
        return $new_instance;
    }
    function backgroundRender($background) {
        
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
}

Widget::add('widget_item_style_13');