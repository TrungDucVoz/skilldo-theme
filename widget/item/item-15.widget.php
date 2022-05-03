<?php
class widget_item_style_15 extends widget {
    function __construct() {
        parent::__construct('widget_item_style_15', 'Item 15', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'Hữu Trọng';
    }
    function form($left = [], $right = []) {

        $left[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu heading item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDesColor', 'type' => 'color', 'label' => 'Màu mô tả item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBg', 'type' => 'color', 'label' => 'Màu nền item', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];

        $left[] = ['field' => 'itemHeadingColorHover', 'type' => 'color', 'label' => 'Màu heading (hover)', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemDesColorHover', 'type' => 'color', 'label' => 'Màu mô tả (hover)', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBgHover', 'type' => 'color', 'label' => 'Màu nền item (hover)', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];


        $left[] = ['field' => 'itemNumberColor', 'type' => 'color', 'label' => 'Màu số', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemNumberColorHover', 'type' => 'color', 'label' => 'Màu số (hover)', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'itemBorderRadius', 'type' => 'number', 'label' => 'Bo tròn gốc', 'after' => '<div class="builder-col-4 col-md-4 form-group group">', 'before'=> '</div>', 'value' => 4];

        $left[]  = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách item', 'fields' => [
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 6, 'language' => true],
            ['name' => 'description', 'type' => 'textarea', 'label' => __('Mô tả'), 'col' => 6, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
            ['name' => 'display', 'type' => 'select', 'label' => __('Hiển thị'), 'col' => 6, 'options' => ['active' => 'hover - active', 'normal' => 'Bình thường'], 'value' => 'normal'],
        ]];
        $right[] = ['field' => 'per_row', 'label' => 'Số item/hàng (Desktop)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = ['field' => 'per_row_tablet', 'label' =>'Số item/hàng (Tablet)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 4]];
        $right[] = ['field' => 'per_row_mobile', 'label' =>'Số item/hàng (Mobile)', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 2]];

        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $right[] = ['field' => 'font', 'label' => 'Item Font chữ tiêu đề', 'type' => 'select', 'options' => $fonts];
        $right[] = ['field' => 'fontSize', 'label' => 'Item Font size tiêu đề', 'type' => 'tab', 'value' => 20, 'options' => ['13' => '13', '14' => '14', '15' => '15', '16' => '16', '18' => '18', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '42' => '42', '50' => '50']];
        parent::form($left, $right);
    }
    function widget() {
        $box  = $this->container_box('widget_item_style_15');
        echo $box['before'];
        $number = 1;
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        ?>
        <div id="item_style_15_content_<?php echo $this->id;?>">
            <div class="row-flex list-item">
                <?php foreach ($this->options->item as $key => $item) { ?>
                    <div class="item item<?php echo $key;?> <?php echo $item['display'];?>">
                        <a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>">
                            <div class="number-box"><span class="number">0<?php echo $number++;?></span></div>
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
            .js_widget_item_style_15_<?php echo $this->id;?> {
                --item-title:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --item-des:<?php echo (!empty($this->options->itemDesColor)) ? $this->options->itemDesColor : '#8a8b8c';?>;
                --item-bg:<?php echo (!empty($this->options->itemBg)) ? $this->options->itemBg : '#fff';?>;

                --item-title-hover:<?php echo (!empty($this->options->itemHeadingColorHover)) ? $this->options->itemHeadingColorHover : '#fff';?>;
                --item-des-hover:<?php echo (!empty($this->options->itemDesColorHover)) ? $this->options->itemDesColorHover : '#fff';?>;
                --item-bg-hover:<?php echo (!empty($this->options->itemBgHover)) ? $this->options->itemBgHover : '#000';?>;

                --item-number:<?php echo (!empty($this->options->itemNumberColor)) ? $this->options->itemNumberColor : '#000';?>;
                --item-number-hover:<?php echo (!empty($this->options->itemNumberColorHover)) ? $this->options->itemNumberColorHover : '#fff';?>;
                --item-border-radius:<?php echo (!empty($this->options->itemBorderRadius)) ? $this->options->itemBorderRadius : '4';?>px;

                --item-per-row:<?php echo $this->options->template;?>;
                --item-per-row-tablet:<?php echo $this->options->templateTablet;?>;
                --item-per-row-mobile:<?php echo $this->options->templateMobile;?>;

                --number-title-size: <?php echo (!empty($this->options->fontSize)) ? $this->options->fontSize : '20';?>px;
                --number-title-font: <?php echo (!empty($this->options->font)) ? $this->options->font : 'var(--font-family)';?>;
            }
            .js_widget_item_style_15_<?php echo $this->id;?>.widget_item_style_15 .item {
                <?php echo $this->backgroundRender((isset($this->options->itemBgColor)) ? $this->options->itemBgColor : []);?>
            }
        </style>
        <?php echo $box['after'];
    }
    function default() {
        $this->options->heading['style'] = 'heading-style-1-2';
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(!isset($this->options->per_row)) $this->options->per_row = 3;
        $this->options->template = '';
        for($i = 0; $i < $this->options->per_row; $i++) $this->options->template .= '1fr ';
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 2;
        $this->options->templateTablet = '';
        for($i = 0; $i < $this->options->per_row_tablet; $i++) $this->options->templateTablet .= '1fr ';
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 1;
        $this->options->templateMobile = '';
        for($i = 0; $i < $this->options->per_row_mobile; $i++) $this->options->templateMobile .= '1fr ';
        if(!isset($this->options->itemPadding1)) $this->options->itemPadding1 = 60;
        if(!isset($this->options->itemPadding2)) $this->options->itemPadding2 = 30;
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'title'         =>  'Miễn Phí Vận Chuyển',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
                'display'       =>  'active',
            ];
            $this->options->item[1] = [
                'title'         =>  'Sản Phẩm Chất Lượng',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
                'display'       =>  'normal',
            ];
            $this->options->item[2] = [
                'title'         =>  'Bảo Hành Từ 1 – 5 Năm',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Cam kết miễn phí vận chuyển cho khách hàng trong khu vực Thành Phố Hồ Chí Minh.',
                'display'       =>  'normal',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
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
    function css() { include_once('css/item-style-15.css'); }
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

Widget::add('widget_item_style_15');