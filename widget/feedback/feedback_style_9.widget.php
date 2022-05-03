<?php
class widget_feedback_style_9 extends widget {
    function __construct() {
        parent::__construct('widget_feedback_style_9', 'Feedback (style 9)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        add_action('theme_custom_script', array( $this, 'script'), 10);
        $this->tabs = ['feedback'];
        $this->author = 'Nhật Anh';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'feedbackNameColor', 'label' =>'Màu tên', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackOfficeColor','label' =>'Màu chức vụ', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackTextColor', 'label' => 'Màu chữ đánh giá', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackStarColor', 'label' => 'Màu ngôi sao', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'feedbackBorderColor', 'label' => 'Màu viền', 'type' => 'color', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_feedback_style_9');
        echo $box['before'];
        ?>
        <div class="feedback-content-box">
            <div class="box-content swiper" id="feedback_list_<?= $this->id;?>" data-speed="<?= $this->options->speed;?>" data-time="<?= $this->options->time;?>" data-id="<?= $this->id;?>">
                <div class="feedback-heading">
                    <?php echo ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                    <div class="arrow-box">
                        <div class="arrow-feedback prev"><i class="fa-thin fa-angle-left"></i></div>
                        <div class="arrow-feedback next"><i class="fa-thin fa-angle-right"></i></div>
                    </div>
                </div>

                <div class="list-feedback-box swiper-wrapper">
                    <?php foreach ($this->options->feeds as $key => $val) { $this->item($val); } ?>
                </div>
            </div>
        </div>
        <style>
            .js_widget_feedback_style_9_<?php echo $this->id;?> {
                --fbs-name-color:<?php echo (!empty($this->options->feedbackNameColor)) ? $this->options->feedbackNameColor : '#00085c';?>;
                --fbs-office-color:<?php echo (!empty($this->options->feedbackOfficeColor)) ? $this->options->feedbackOfficeColor : '#555555';?>;
                --fbs-text-color:<?php echo (!empty($this->options->feedbackTextColor)) ? $this->options->feedbackTextColor : '#555555';?>;
                --fbs-start-color:<?php echo (!empty($this->options->feedbackStarColor)) ? $this->options->feedbackStarColor : '#ff9d00';?>;
                --fbs-border-color:<?php echo (!empty($this->options->feedbackBorderColor)) ? $this->options->feedbackBorderColor : '#ff9d00';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function item($item) {
        ?>
        <div class="testimonial-block swiper-slide">
            <div class="inner-box" style="background-image:url('views/theme-store/widget/feedback/assets/widget-pattern-9.png')">
                <div class="quote-icon flaticon-quote"><i class="fa-solid fa-quote-right"></i></div>
                <div class="border-layer"></div>
                <div class="author-info-box">
                    <div class="box-inner">
                        <div class="author-image">
                            <img width="70" height="70" src="<?= Template::imgLink($item->image);?>" class="attachment-nitech_70x70 size-nitech_70x70 wp-post-image" alt="" loading="lazy">                                    </div>
                        <div class="rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <div class="author-name"><?= $item->title?>  -  <span><?= $item->content?></span></div>
                    </div>
                </div>
                <div class="text"><?= $item->excerpt?></div>
            </div>
        </div>
        <?php

    }
    function default() {
        if($this->name == 'Feedback (style 9)') $this->name = 'ĐÁNH GIÁ KHÁCH HÀNG';
        if(!isset($this->options->speed)) $this->options->speed = 1;
        if(!isset($this->options->time))  $this->options->time = 3;
        if(!isset($this->options->box))   $this->options->box = 'container';
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
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'     => 'Hoàng Thùy Yến',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Nhân sự',
                    'slogan'    => 'Chất lượng và uy tín',
                ],
                (object)[
                    'id'        => 2,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'     => 'Cao Yến Vy',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                    'slogan'    => 'Chất lượng và uy tín',
                ],
                (object)[
                    'id'        => 3,
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'     => 'NGuyễn Văn Cường',
                    'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'content'   => 'Design',
                    'slogan'    => 'Nhà cung cấp uy tín',
                ],
            ];
        }
        if(empty($this->options->widgetBackground['color'])) {
            $this->options->widgetBackground['color'] = 'rgb(2, 12, 87)';
        }
        if(!isset($this->options->box_size['padding'])) {
            $this->options->box_size['padding'] = ['top' => 0, 'bottom' => 20, 'left' => 0, 'right' => 0];
        }
    }
    function css() { include_once('assets/feedback-style-9.css'); }
    function script() { include_once('assets/feedback-script-9.js'); }
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
Widget::add('widget_feedback_style_9');


