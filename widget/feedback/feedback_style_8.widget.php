<?php
class widget_feedback_style_8 extends widget {
    function __construct() {
        parent::__construct('widget_feedback_style_8', 'Feedback (style 8)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        add_action('theme_custom_script', array( $this, 'script'), 10);
        $this->tabs = ['feedback'];
        $this->author = 'Nhật Anh';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'feedbackContentBackground', 'label' =>'Màu nền đánh giá', 'type' => 'background'];
        $left[] = ['field' => 'feedbackContentColor', 'label' =>'Màu chữ đánh giá', 'type' => 'color'];
        $left[] = ['field' => 'feedbackNavColor', 'label' =>'Màu phân trang đánh giá', 'type' => 'color'];
        $left[] = ['field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 1, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        $right[] = ['field' => 'feedbackBackground', 'label' =>'Màu nền dưới đánh giá', 'type' => 'background'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_feedback_style_8');
        echo $box['before'];
        ?>
        <div class="feedback-content-box">
            <?php echo ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
            <div class="box-content" style="overflow: inherit">
                <div id="feedback_list_<?= $this->id;?>" class="owl-carousel list-feedback-box" data-speed="<?= $this->options->speed;?>" data-time="<?= $this->options->time;?>" data-id="<?= $this->id;?>">
                    <?php foreach ($this->options->feeds as $key => $val) { $this->item($val); } ?>
                </div>
            </div>
        </div>
        <style>
            :root {
                --fbs8-content-color:<?php echo (!empty($this->options->feedbackContentColor)) ? $this->options->feedbackContentColor : '#72726c';?>;
                --fbs8-nav-color:<?php echo (!empty($this->options->feedbackNavColor)) ? $this->options->feedbackNavColor : '#cabbad';?>;
            }
            .js_widget_feedback_style_8_<?php echo $this->id;?>.widget_feedback_style_8 .box-content {
                <?php echo $this->backgroundRender($this->options->feedbackBackground);?>
            }
            .js_widget_feedback_style_8_<?php echo $this->id;?>.widget_feedback_style_8 .list-feedback-box .feedback-content {
                <?php echo $this->backgroundRender($this->options->feedbackContentBackground);?>
            }
        </style>
        <?php
        echo $box['after'];
    }
    function item($item) {
        ?>
        <div class="item-feedback">
            <div class="image">
                <img width="638" height="434" src="<?= Template::imgLink($item->image);?>" class="attachment-638x434 size-638x434 wp-post-image lazy-loaded" alt="" sizes="(max-width: 638px) 100vw, 638px" data-srcset="" srcset="">
            </div>
            <div class="feedback-content">
                <span class="text"><?=$item->excerpt?></span>
            </div>
        </div>
        <?php

    }
    function default() {
        if($this->name == 'Feedback (style 8)') $this->name = 'ĐÁNH GIÁ KHÁCH HÀNG';
        if(!isset($this->options->speed)) $this->options->speed = 1;
        if(!isset($this->options->time))  $this->options->time = 3;
        if(!isset($this->options->box))   $this->options->box = 'full';
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

        if(empty($this->options->feedbackBackground['color'])) {
            $this->options->feedbackBackground['color'] = '#F4F0ED';
        }
    }
    function css() { include_once('assets/feedback-style-8.css'); }
    function script() { include_once('assets/feedback-script-8.js'); }
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
Widget::add('widget_feedback_style_8');


