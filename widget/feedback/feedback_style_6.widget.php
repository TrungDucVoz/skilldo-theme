<?php
class widget_feedback_style_6 extends widget {
    function __construct() {
        parent::__construct('widget_feedback_style_6', 'Feedback (style 6)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tabs = ['feedback'];
        $this->author = 'SKD Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'feedback_background', 'label' =>'Màu nền đánh giá', 'type' => 'color'];
        $left[] = ['field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 3, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = [ 'field' => 'feedback_content_color', 'label' =>'Màu text đánh giá', 'type' => 'color', 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = [ 'field' => 'feedback_name_color', 'label' =>'Màu tên', 'type' => 'color', 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = [ 'field' => 'feedback_office_color', 'label' =>'Màu nghề nghiệp', 'type' => 'color', 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $right[] = [ 'field' => 'banner_img', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = [ 'field' => 'url', 'label' =>'Liên kết banner', 'type' => 'text'];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'tab', 'options' => [
            'text_img' => 'Đánh giá - Hình ảnh',
            'img_text' => 'Hình ảnh - Đánh giá',
        ], 'value' => 'img_text'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_feedback_style_6');
        echo $box['before'];
        ?>
        <div class="row-flex-center <?php echo $this->options->position;?>">
            <div class="feedback-image">
                <?php Template::img($this->options->banner_img, $this->name, ['lazy' => 'default']);?>
            </div>
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
        </div>
        <style>
            :root {
                --fbs6-feedback-bg:<?php echo ($this->options->feedback_background) ? $this->options->feedback_background : 'rgb(251, 239, 239)';?>;
                --fbs6-feedback-content:<?php echo ($this->options->feedback_content_color) ? $this->options->feedback_content_color : '#000';?>;
                --fbs6-feedback-name:<?php echo ($this->options->feedback_name_color) ? $this->options->feedback_name_color : '#000';?>;
                --fbs6-feedback-office:<?php echo ($this->options->feedback_office_color) ? $this->options->feedback_office_color : '#000';?>;
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
                    slidesToShow: 1,
                    slidesToScroll: 1,
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
            <div class="feedback-content">
                <?php echo Str::clear($item->excerpt);?>
            </div>
            <div class="info">
                <div class="avatar">
                    <?php Template::img($item->image, $item->title);?>
                </div>
                <div class="title">
                    <p class="feedback-name"><?= $item->title;?></p>
                    <p class="feedback-office"><?= $item->content;?></p>
                </div>

            </div>
        </div>
        <?php
    }
    function default() {
        if($this->name == 'Feedback (style 6)') $this->name = 'ĐÁNH GIÁ KHÁCH HÀNG';
        if(!isset($this->options->position)) $this->options->position = 'img_text';
        if(!isset($this->options->speed)) $this->options->speed = 3;
        if(!isset($this->options->time))  $this->options->time = 2;
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->banner_img))   $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/650x300';
        if(!isset($this->options->url))   $this->options->url = '';
        if(Plugin::isActive('customer-feedback')) {
            $args = [
                'post_type' => FEEDBACK_POST_TYPE,
                'where'     => ['public'  => 0],
                'params'    => ['orderby' => 'order, created desc', 'limit' => (!empty($this->options->limit)) ? $this->options->limit : 50]
            ];
            $this->options->feeds = Posts::gets($args);
        }
        else {
            $this->options->feeds = [
                (object)[
                    'id'        => 1,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Hoàng Thùy Yến',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Nhân sự',
                ],
                (object)[
                    'id'        => 2,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Cao Yến Vy',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                ],
                (object)[
                    'id'        => 3,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'NGuyễn Văn Cường',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                ],
            ];
        }
    }
    function css() { include_once('assets/feedback-style-6.css'); }
}
Widget::add('widget_feedback_style_6');

