<?php
class widget_about_style_4 extends widget {
    function __construct() {
        parent::__construct('widget_about_style_4', 'About (style 4)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['about'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'description', 'label' =>'Mô tả', 'type' => 'wysiwyg' ];
        $left[] = [ 'field' => 'url', 'label' =>'Liên kết', 'type' => 'text'];
        $right[] = ['field' => 'video_img',  'label' =>'Ảnh đại diện video', 'type' => 'image'];
        $right[] = ['field' => 'video_url',  'label' =>'Liên kết youtube', 'type' => 'url'];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'select', 'options' => [
            'text_img' => 'Bài viết - Video',
            'img_text' => 'Video - Bài viết',
        ]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_about_style_4');
        echo $box['before']; ?>
        <div class="row">
            <div class="<?php echo $this->options->position;?> col-md-6 about-content">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
                <div class="button"><a href="<?php echo $this->options->url;?>" class="btn btn-effect-default btn-theme"><?php echo __('XEM THÊM');?></a></div>
            </div>
            <div class="col-md-6 about-video">
                <div class="video-section-outer">
                    <div class="video-section">
                        <a href="<?php echo $this->options->video_url;?>" data-fancybox>
                            <?php Template::img($this->options->video_img);?>
                            <div class="video-btn">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 191.255 191.255" style="enable-background:new 0 0 191.255 191.255;" xml:space="preserve"><path d="M162.929,66.612c-2.814-1.754-6.514-0.896-8.267,1.917s-0.895,6.513,1.917,8.266c6.544,4.081,10.45,11.121,10.45,18.833s-3.906,14.752-10.45,18.833l-98.417,61.365c-6.943,4.329-15.359,4.542-22.512,0.573c-7.154-3.97-11.425-11.225-11.425-19.406V34.262c0-8.181,4.271-15.436,11.425-19.406c7.153-3.969,15.569-3.756,22.512,0.573l57.292,35.723c2.813,1.752,6.513,0.895,8.267-1.917c1.753-2.812,0.895-6.513-1.917-8.266L64.512,5.247c-10.696-6.669-23.661-7-34.685-0.883C18.806,10.48,12.226,21.657,12.226,34.262v122.73c0,12.605,6.58,23.782,17.602,29.898c5.25,2.913,10.939,4.364,16.616,4.364c6.241,0,12.467-1.754,18.068-5.247l98.417-61.365c10.082-6.287,16.101-17.133,16.101-29.015S173.011,72.899,162.929,66.612z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function css() { include_once('assets/about-style-4.css'); }
    function default() {
        if(!isset($this->options->heading))    {
            $this->options->heading = ['style' => 'style11', 'margin_top' => 40, 'margin_bottom' => 30];
        }
        if($this->name == 'About (style 4)') $this->name = 'How We Can Help You Achieve Your Business Goal';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p><p>Mauris egestas eleifend sapien eu malesuada. Phasellus at metus eget sapien tristique accumsan non sit amet augue.</p>';
        if(!isset($this->options->url))         $this->options->url = '';
        if(!isset($this->options->video_img)) $this->options->video_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500';
        if(!isset($this->options->video_url)) $this->options->video_url = '';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->position))    $this->options->position = 'text_img';
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            if(isset($this->options->{'description_'.$current})) $this->options->description = $this->options->{'description_'.$current};
        }
    }
}
Widget::add('widget_about_style_4');