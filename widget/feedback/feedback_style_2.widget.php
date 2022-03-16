<?php
class widget_feedback_style_2 extends widget {

    function __construct() {
        parent::__construct('widget_feedback_style_2', 'Feedback (style 2)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['feedback'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $left[] = ['field' => 'limit', 'type' => 'number', 'value' => 10, 'label'=> 'Số Item lấy ra', 'note'=>'Để 0 để lấy tất cả', 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        $left[] = ['field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 3, 'after' => '<div class="col-md-4 form-group group">', 'before'=> '</div>'];
        parent::form($left, $right);
    }

    function widget() {
        $box = $this->container_box('widget_feedback_style_2');
        echo $box['before'];
        ?>
        <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="box-content">
            <div class="arrow_box" id="feedback_btn_<?= $this->id;?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="feedback_list_<?= $this->id;?>" class="owl-carousel">
                <?php foreach ($this->options->feeds as $key => $val) { $this->item($val); } ?>
            </div>
        </div>
        <script defer>
            $(function(){
                let config = {
                    items 				:1,
                    margin				:30,
                    autoplayTimeout		:<?= ($this->options->speed+$this->options->time)*1000;?>,
                    autoplaySpeed 		:<?= $this->options->speed*1000;?>,
                    loop				:true, autoplay:true, autoplayHoverPause:true,
                    responsive 			:{ 0:{ items:1 },  500:{ items:1 },  1000:{ items:1 } }
                };
                let ol = $("#feedback_list_<?php echo $this->id;?>").owlCarousel(config);
                $('#feedback_btn_<?php echo $this->id;?> '+'.next').click(function() {
                    ol.trigger('next.owl.carousel', [1000]);
                });
                $('#feedback_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                    ol.trigger('prev.owl.carousel', [1000]);
                });
            });
        </script>
        <?php
        echo $box['after'];
    }

    function item($item) {
        ?>
        <div class="feedback-item">
            <div class="layer1"></div>
            <div class="item">
                <div class="feedback-info">
                    <div class="avatar" data-aos="fade-top" data-aos-duration="500">
                        <?php Template::img($item->image, $item->title);?>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-duration="800">
                        <h3 class="feedback-name"><?= $item->title;?></h3>
                        <p class="feedback-office"><?= $item->content;?></p>
                    </div>
                </div>
                <div class="feedback-content">
                    <blockquote><?php Template::img('https://cdn.shopify.com/s/files/1/0108/7370/0415/files/Untitled-3_90x.png?v=1580904811');?></blockquote>
                    <?php echo Str::clear($item->excerpt);?>
                </div>
            </div>
        </div>
        <?php
    }

    function default() {
        if($this->name == 'Feedback (style 2)') $this->name = 'Ý KIẾN KHÁCH HÀNG';
        if(!isset($this->options->limit)) $this->options->limit = 10;
        if(!isset($this->options->speed)) $this->options->speed = 3;
        if(!isset($this->options->time))  $this->options->time = 2;
        if(!isset($this->options->box))   $this->options->box = 'container';
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

    function css() { include_once('assets/feedback-style-2.css'); }
}

Widget::add('widget_feedback_style_2');
