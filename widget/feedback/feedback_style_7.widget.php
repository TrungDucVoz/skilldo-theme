<?php
class widget_feedback_style_7 extends widget {
    function __construct() {
        parent::__construct('widget_feedback_style_7', 'Feedback (style 7)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tabs = ['feedback'];
        $this->author = 'SKD Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'feedbackBorderColor', 'label' => 'Màu viền đánh giá', 'type' => 'color', 'after' => '<div class="builder-col-12 col-md-12 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackTitleColor', 'label' =>'Màu tiêu đề đánh giá', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackContentColor', 'label' =>'Màu nhận xét đánh giá', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackNameColor', 'label' =>'Màu tên người đánh giá', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackOfficeColor', 'label' =>'Màu nghề nghiệp', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];

        $left[] = ['field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'feedbackBackground', 'label' =>'Màu nền đánh giá', 'type' => 'background'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_feedback_style_7');
        echo $box['before'];
        ?>
        <div class="feedback-content-box">
            <?php echo ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
            <div class="box-content">
                <div class="arrow_box" id="feedback_btn_<?= $this->id;?>">
                    <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                    <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                </div>
                <div id="feedback_list_<?= $this->id;?>" class="owl-carousel">
                    <?php foreach ($this->options->feeds as $key => $val) { $this->item($val); } ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_feedback_style_7_<?php echo $this->id;?> { {
                --fbs7-border-color:<?php echo (!empty($this->options->feedbackBorderColor)) ? $this->options->feedbackBorderColor : 'var(--theme-color)';?>;
                --fbs7-feedback-slogan:<?php echo (!empty($this->options->feedbackTitleColor)) ? $this->options->feedbackTitleColor : 'var(--theme-color)';?>;
                --fbs7-feedback-content:<?php echo (!empty($this->options->feedbackContentColor)) ? $this->options->feedbackContentColor : '#000';?>;
                --fbs7-feedback-name:<?php echo (!empty($this->options->feedbackNameColor)) ? $this->options->feedbackNameColor : '#000';?>;
                --fbs7-feedback-office:<?php echo (!empty($this->options->feedbackOfficeColor)) ? $this->options->feedbackOfficeColor : '#000';?>;
            }
            .js_widget_feedback_style_7_<?php echo $this->id;?>.widget_feedback_style_7 .item {
                <?php echo $this->backgroundRender($this->options->feedbackBackground);?>
            }
        </style>
        <script defer>
            $(function(){
                let config = {
                    infinite: true,
                    dots:false,
                    autoplay: true,
                    autoplaySpeed: <?= $this->options->time*1000;?>,
                    speed: <?= $this->options->speed*1000;?>,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    responsive: [
                        { breakpoint: 600, settings: { slidesToShow: 1} }
                    ]
                };
                let feedbackList     = $("#feedback_list_<?php echo $this->id;?>");
                let feedbackBtnNext  = $('#feedback_btn_<?php echo $this->id;?> '+'.next');
                let feedbackBtnPrev  = $('#feedback_btn_<?php echo $this->id;?> '+'.prev');
                feedbackList.slick(config);
                feedbackBtnNext.click(function() {feedbackList.slick('slickNext');return false;});
                feedbackBtnPrev.click(function() {feedbackList.slick('slickPrev');return false;});
            });
        </script>
        <?php
        echo $box['after'];
    }
    function item($item) {
        ?>
        <div class="item">
            <div class="feedback-heading">
                <div class="avatar"><?php Template::img($item->image, $item->title);?></div>
                <div class="title"><p><?php echo $item->slogan;?></p></div>
            </div>
            <div class="feedback-content">
                <?php echo Str::clear($item->excerpt);?>
            </div>
            <div class="feedback-footer">
                <p class="feedback-name"><?= $item->title;?></p>
                <p class="feedback-office"><?= $item->content;?></p>
            </div>
        </div>
        <?php
    }
    function default() {
        if($this->name == 'Feedback (style 7)') $this->name = 'ĐÁNH GIÁ KHÁCH HÀNG';
        if(!isset($this->options->speed)) $this->options->speed = 1;
        if(!isset($this->options->time))  $this->options->time = 3;
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->url))   $this->options->url = '';
        if(Plugin::isActive('customer-feedback')) {
            $args = [
                'post_type' => FEEDBACK_POST_TYPE,
                'where'     => ['public'  => 0],
                'params'    => ['orderby' => 'order, created desc', 'limit' => (!empty($this->options->limit)) ? $this->options->limit : 50]
            ];
            $this->options->feeds = Posts::gets($args);

            if(have_posts($this->options->feeds)) {
                foreach ($this->options->feeds as $key => $feed) {
                    $feed->slogan = Posts::getMeta($feed->id, 'feedback_slogan', true);
                    $this->options->feeds[$key] = $feed;
                }
            }
        }
        else {
            $this->options->feeds = [
                (object)[
                    'id'        => 1,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Hoàng Thùy Yến',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Nhân sự',
                    'slogan'    => 'Chất lượng và uy tín',
                ],
                (object)[
                    'id'        => 2,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Cao Yến Vy',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                    'slogan'    => 'Chất lượng và uy tín',
                ],
                (object)[
                    'id'        => 3,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'NGuyễn Văn Cường',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                    'slogan'    => 'Nhà cung cấp uy tín',
                ],
            ];
        }
    }
    function css() { include_once('assets/feedback-style-7.css'); }
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
    static function addMetabox() {
        Metabox::add('admin_feedback_customer_slogan', 'Tiêu đề', 'widget_feedback_style_7::sloganBox', ['module' => 'post_customer-feedback','content'=>'leftt']);
    }
    static function sloganBox($object) {
        $feedback_slogan =  (have_posts($object)) ? Posts::getMeta($object->id, 'feedback_slogan', true) : [];
        $FormBuilder = new FormBuilder();
        $FormBuilder->add('feedback_slogan', 'text', ['label' => 'Tiêu đề'], $feedback_slogan)->html(false);
    }
    static function sloganSave($feedback_id, $module) {
        if($module == 'post' && Admin::getPostType() == 'customer-feedback') {
            $feedback_slogan = InputBuilder::Post('feedback_slogan');
            Posts::updateMeta($feedback_id, 'feedback_slogan', $feedback_slogan);
        }
    }
}
Widget::add('widget_feedback_style_7');
widget_feedback_style_7::addMetabox();
add_action('save_object', 'widget_feedback_style_7::sloganSave', 10, 2);


