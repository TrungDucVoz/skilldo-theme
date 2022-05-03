<?php
class widget_about_style_14 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_14', 'About (style 14 - Tab)', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['item'];
        $this->author = 'Hữu Trọng';
    }
    function form($left = [], $right = []) {

        $left[]  = ['field' => 'item', 'type' => 'repeater', 'label' => 'Danh sách tab', 'fields' => [
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề tab'), 'col' => 12, 'language' => true],
            ['name' => 'description', 'type' => 'wysiwyg', 'label' => __('Mô tả'), 'col' => 12, 'language' => true],
            ['name' => 'img', 'type' => 'image', 'label' => __('Ảnh trái'), 'col' => 6, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
            ['name' => 'btnText', 'type' => 'text', 'label' => __('Chữ button'), 'col' => 6, 'language' => true, 'value' => 'Xem Thêm'],
        ]];

        $fonts 	= ['Font mặc định'];
        $fonts 	= array_merge($fonts, gets_theme_font());
        $right[] = ['field' => 'itemBg', 'type' => 'color', 'label' => 'Màu nền tab', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'itemHeadingColor', 'type' => 'color', 'label' => 'Màu chữ tab', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'itemBgHover', 'type' => 'color', 'label' => 'Màu nền tab (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'itemHeadingColorHover', 'type' => 'color', 'label' => 'Màu chữ tab (hover)', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];

        $right[] = ['field' => 'font', 'label' => 'Tab Font chữ', 'type' => 'select', 'options' => $fonts];
        $right[] = ['field' => 'fontSize', 'label' => 'Tab Font size', 'type' => 'tab', 'value' => 20, 'options' => ['13' => '13', '14' => '14', '15' => '15', '16' => '16', '18' => '18', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '42' => '42', '50' => '50']];

        parent::form($left, $right);
    }
    function widget() {
        $box  = $this->container_box('widget_about_style_14');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        $number = 0;
        ?>
        <div class="row-flex">
            <div class="item-list-tab">
                <ul>
                    <?php foreach ($this->options->item as $key => $item) { ?>
                        <li data-aos="fade-right"><a class="<?php echo ($number++ == 0) ? 'active' : '';?>" href="#item-tab-<?php echo $key;?>"><?php echo $item['title'];?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php $number = 0;?>
            <div class="item-tab-content">
                <?php foreach ($this->options->item as $key => $item) { ?>
                    <div class="item-tab <?php echo ($number++ == 0) ? 'active' : '';?>" id="item-tab-<?php echo $key;?>">
                        <div class="row" style="overflow: hidden">
                            <div class="col-md-8 item-content" data-aos="fade-down">
                                <div class="animated fadeInDown">
                                    <?php if(!empty($item['description'])) {?><p class="description"><?php echo $item['description'];?></p><?php } ?>
                                </div>
                                <a class="btn btn-effect-default btn-theme animated fadeInUp" href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php echo $item['btnText'];?></a>
                            </div>
                            <div class="col-md-4 item-img" data-aos="fade-down">
                                <div class="item-tab-img animated fadeInRight"><?php Template::img($item['img'], $this->name, ['lazy' => 'default']);?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <script>
            $(function () {
                let width = $(document).width();
                $('.widget_about_style_14 .item-list-tab ul li a').click(function () {
                    if(width > 768) {
                        let height = $(this).closest('.widget_about_style_14').find('.item-tab.active').height();
                        $(this).closest('.widget_about_style_14').find('.item-list-tab').css('min-height', height+'px');
                    }
                    let id = $(this).attr('href');
                    $(this).closest('.widget_about_style_14').find('.item-tab').removeClass('active');
                    $(this).closest('.widget_about_style_14').find('.item-list-tab li a').removeClass('active');
                    $(id).addClass('active');
                    $(this).addClass('active');
                    return false;
                });
            })
        </script>
        <style>
            .js_widget_about_style_14_<?php echo $this->id;?> {
                --tab-color:<?php echo (!empty($this->options->itemHeadingColor)) ? $this->options->itemHeadingColor : '#000';?>;
                --tab-background:<?php echo (!empty($this->options->itemBg)) ? $this->options->itemBg : '#fff';?>;

                --tab-color-active:<?php echo (!empty($this->options->itemHeadingColorHover)) ? $this->options->itemHeadingColorHover : '#fff';?>;
                --tab-background-active:<?php echo (!empty($this->options->itemBgHover)) ? $this->options->itemBgHover : '#000';?>;

                --title-size: <?php echo (!empty($this->options->fontSize)) ? $this->options->fontSize : '18';?>px;
                --title-font: <?php echo (!empty($this->options->font)) ? $this->options->font : 'var(--font-family)';?>;
            }
            .js_widget_about_style_14_<?php echo $this->id;?>.widget_about_style_14 .item {
                <?php echo $this->backgroundRender((isset($this->options->itemBgColor)) ? $this->options->itemBgColor : []);?>
            }
        </style>
        <?php echo $box['after'];
    }
    function default() {
        if(!isset($this->options->box)) $this->options->box = 'container';
        if(empty($this->options->item)) {
            $this->options->item    = [];
            $this->options->item[0] = [
                'title'         =>  'Về chúng tôi',
                'img'           =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Bên cạch chuỗi các cửa hàng trên, chúng tôi phát triển Website bán hàng trực tuyến tại địa chỉ: F1gen Watch nhằm mang đến cho Khách hàng thêm một lựa chọn mua sắm tiện ích, tiết kiệm thời gian, dễ dàng chọn lựa khi có nhu cầu tìm mua một chiếc đồng hồ tốt chính hãng. Trang web F1gen Watch được xây dựng với giao diện sang trọng thể hiện chất lượng của sản phẩm đang bán cũng như tiêu chí kinh doanh chuẩn mực, với tính năng đặt hàng online được tích hợp sẵn cho từng sản phẩm, khách hàng sẽ nhận được phản hồi nhanh chóng từ chúng tôi khi gửi cho chúng tôi "Đơn đặt hàng" trực tiếp từ website.',
                'btnText'       =>  'Xem Thêm',
            ];
            $this->options->item[1] = [
                'title'         =>  'Thương hiệu thụy sỹ',
                'img'           =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Những cỗ máy đếm tiêu chuẩn Swiss Made luôn là niềm mong chờ và khao khát của tín đồ sành đồng hồ thế giới. Hiện nay các thương hiệu đồng hồ đeo tay nổi tiếng luôn nỗ lực tạo ra những sản phẩm chất lượng nhất để đem lại giá trị cao cho người dùng',
                'btnText'       =>  'Xem Thêm',
            ];
            $this->options->item[2] = [
                'title'         =>  'Audemars Piguet Chính Hãng',
                'img'           =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Là một tên tuổi lâu đời trong ngành chế tạo đồng hồ Thụy Sỹ, thương hiệu Audemars Piguet vẫn luôn chứng minh được giá trị của mình trên thị trường đồng hồ thế giới tính từ ngày thành lập cho đến nay. Và ít ai biết được rằng, Audemars Piguet chính là thương hiệu đồng hồ duy nhất ở phân mức cao cấp trên thế giới có người điều hành hoạt động kinh doanh là hậu duệ đời thứ tư của những người sáng lập.',
                'btnText'       =>  'Xem Thêm',
            ];
            $this->options->item[3] = [
                'title'         =>  'Thương Hiệu Đồng Hồ Mido',
                'img'           =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                'url'           =>  'https://sikido.vn',
                'description'   =>  'Mido được thành lập vào ngày 11/11/1918 bởi George G. Schaeren đặt trụ sở tại Le Locle, Thụy Sỹ. Tên thương hiệu này bắt nguồn từ cụm từ “Yo mido” trong tiếng Tây Ban Nha nghĩa là “Tôi đo” mang hàm ý về sự cách tân kỹ thuật và thiết kế vĩnh cửu.',
                'btnText'       =>  'Xem Thêm',
            ];
        }
        else{
            foreach ($this->options->item as $key => $value) {
                if(!isset($value['title'])) $value['title'] = '';
                if(!isset($value['img'])) $value['img'] = '';
                if(!isset($value['description'])) $value['description'] = '';
                if(!isset($value['url'])) $value['url'] = '';
                if(!isset($value['btnText'])) $value['btnText'] = 'Xem Thêm';
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
    function css() { include_once('assets/about-style-14.css'); }
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

Widget::add('widget_about_style_14');