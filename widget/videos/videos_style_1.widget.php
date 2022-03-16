<?php
class widget_videos_style_1 extends widget {

    function __construct() {
        parent::__construct('widget_videos_style_1', 'Videos', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['video'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'gallery'];
        }
        $left[] = ['field' => 'display', 'type' => 'widget_videos_style_1::inputDisplay'];
        $right[] = ['field' => 'per_row', 		'label' =>'Số video trên 1 hàng', 			'type' => 'col', 'value' => 4, 'args' => array('min'=>1, 'max' => 10)];
        $right[] = ['field' => 'per_row_tablet','label' =>'Số video trên 1 hàng - tablet', 	'type' => 'col', 'value' => 3, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'per_row_mobile','label' =>'Số video trên 1 hàng - mobile', 	'type' => 'col', 'value' => 2, 'args' => array('min'=>1, 'max' => 5)];

        parent::form($left, $right);
    }

    function widget() {
        ob_start();
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="box-content" style="position: relative" id="video_style_1_content_<?= $this->id;?>">
            <?php if($this->options->display['type'] == 0) { ?>
                <div class="arrow_box">
                    <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                    <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                </div>
                <div class="owl-carousel list-video"><?php $this->displayHorizontal($this->options->galleries);?></div>
                <script defer>
                    $(function(){
                        let config = {
                            infinite: true,
                            dots:false,
                            autoplay: true,
                            autoplaySpeed: <?= $this->options->display['time']*1000;?>,
                            speed: <?= $this->options->display['speed']*1000;?>,
                            slidesToShow: <?= $this->options->per_row;?>,
                            slidesToScroll: 1,
                            responsive: [
                                { breakpoint: 1000, settings: { slidesToShow: <?= $this->options->per_row_tablet;?>} },
                                { breakpoint: 600, settings: { slidesToShow: <?= $this->options->per_row_mobile;?>} }
                            ]
                        };
                        let id = <?= $this->id;?>;
                        let sliderList = $("#video_style_1_content_"+id+' .list-video');
                        let sliderBtnNext = $('#video_style_1_content_' + id + ' .next');
                        let sliderBtnPrev = $('#video_style_1_content_' + id + ' .prev');
                        sliderList.slick(config);
                        sliderBtnNext.click(function() { sliderList.slick('slickNext');return false; });
                        sliderBtnPrev.click(function() { sliderList.slick('slickPrev');return false; });
                    });
                </script>
            <?php }?>
            <?php if($this->options->display['type'] == 1) { ?>
                <div class="list-video row"><?php $this->displayList($this->options->galleries);?></div>
            <?php } ?>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_videos_style_1');
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }

    function displayHorizontal($galleries) {
        if($this->options->display['rows'] == 1) {
            foreach ($galleries as $key => $val):
                echo $this->item($val);
            endforeach;
        }
        if($this->options->display['rows'] == 2) {
            $row_key = 0;
            foreach ($galleries as $key => $val):
                if($row_key == 0) echo '<div class="item_product_row">';
                echo $this->item($val);
                $row_key++;
                if($row_key == 2) { echo '</div>'; $row_key = 0; }
            endforeach;
            if($row_key < 2) echo '</div>';
        }
    }

    function displayList($galleries) {
        $this->options->per_row_mobile = ($this->options->per_row_mobile == 5)?15:(12/$this->options->per_row_mobile);
        $this->options->per_row_tablet = ($this->options->per_row_tablet == 5)?15:(12/$this->options->per_row_tablet);
        $this->options->per_row        = ($this->options->per_row == 5)?15:(12/$this->options->per_row);
        foreach ($galleries as $key => $val): ?>
            <div class="col-xs-<?php echo $this->options->per_row_mobile;?> col-sm-<?php echo $this->options->per_row_tablet;?> col-md-<?php echo $this->options->per_row;?> col-lg-<?php echo $this->options->per_row;?>">
                <?php echo $this->item($val);?>
            </div>
        <?php endforeach;
    }

    function item($item) {
        ?>
        <div class="video-item" data-aos="fade-right" data-aos-duration="500">
            <div class="video-img">
                <a href="<?php echo $item->url;?>" data-fancybox>
                    <?php Template::img($item->image);?>
                    <div class="mfp-video play-now"><i class="icon fa fa-play"></i><span class="ripple"></span></div>
                </a>
            </div>
            <div class="video-title">
                <p class="heading"><a href="<?php echo $item->url;?>" data-fancybox><?php echo $item->title;?></a></p>
            </div>
        </div>
        <?php
    }
    
    function css() { include_once('assets/videos-style-1.css'); }

    function default() {
        if($this->name == 'Videos (Style 1)') $this->name = 'VIDEO';
        if(empty($this->options->display)) $this->options->display = [];
        if(!isset($this->options->display['type'])) $this->options->display['type'] = 0;
        if(!isset($this->options->display['margin'])) $this->options->display['margin'] = 15;
        if(!isset($this->options->display['time'])) $this->options->display['time'] = 3;
        if(!isset($this->options->display['speed'])) $this->options->display['speed'] = 0.7;
        if(!isset($this->options->display['rows'])) $this->options->display['rows'] = 1;
        if(!isset($this->options->per_row)) $this->options->per_row = 4;
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 3;
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 2;
        if(!isset($this->options->box))   $this->options->box = 'container';

        if (!class_exists('video_gallery') && !isset($this->options->gallery)) {
            $galleries = [
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'SEO Services',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Web Design',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Social Engagement',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Content Marketing',
                    'excerpt' => 'Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus cras justo.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'Collect Ideas',
                    'excerpt' => 'Nulla vitae elit libero pharetra augue dapibus. Vivamus sagittis lacus vel augue laoreet.'
                ],
                (object)[
                    'url'     => '',
                    'image'   => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x500',
                    'title'   => 'organize our business projects',
                    'excerpt' => 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.'
                ],
            ];
        }
        else {
            if(empty($this->options->gallery)) {
                $galleries =  Posts::gets(['post_type' => 'video-gallery', 'params' => ['limit' => 20]]);
                foreach ($galleries as &$item) {
                    $item->url = Posts::getMeta($item->id, 'video_url', true);
                }
            }
            else {
                $galleries =  Gallery::getsItem((isset($this->options->gallery)) ? $this->options->gallery : []);
                foreach ($galleries as &$item) {
                    if ($item->type == 'youtube') {
                        $item->url      = $item->value;
                        $item->image    = Template::imgLink($item->value);
                    }
                    if ($item->type == 'image') {
                        $item->url      = Gallery::getItemMeta($item->id, 'url', true);
                        $item->image    = $item->value;
                    }
                    $item->title    = Gallery::getItemMeta($item->id, 'title', true);
                }
            }
        }

        $this->options->galleries = $galleries;
    }

    static function inputDisplay($param, $value = []) {
        if(!is_array($value)) $value = [];
        if(!isset($value['type']))   $value['type']     = 0;
        if(!isset($value['margin'])) $value['margin']   = 15;
        if(!isset($value['time']))   $value['time']     = 3;
        if(!isset($value['speed']))  $value['speed']    = 0.7;
        if(!isset($value['rows']))   $value['rows']     = 1;
        $Form = new FormBuilder();
        ob_start();
        ?>
        <div class="row">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs">
                <li class="active" data-tab="#display_slider">
                    <label for="display_type_0">
                        <input class="display_type" id="display_type_0" type="radio" name="display[type]" value="0" <?php echo ($value['type'] == 0) ? 'checked' : '';?>> Sản phẩm chạy ngang
                    </label>
                </li>
                <li data-tab="#display_list">
                    <label for="display_type_1">
                        <input class="display_type" id="display_type_1" type="radio" name="display[type]" value="1" <?php echo ($value['type'] == 1) ? 'checked' : '';?>> Sản phẩm danh sách
                    </label>
                </li>
            </ul>
            <!-- TAB CONTENT -->
            <div class="tab-content">
                <div class="<?php echo ($value['type'] == 0) ? 'active in' : '';?> tab-pane fade" id="display_slider">
                    <?php $Form->add('display[margin]', 'number', ['label' => 'Khoảng cách giữa các sản phẩm', 'value' => 15], $value['margin']);?>
                    <?php $Form->add('display[time]', 'number', ['label' => 'Thời gian tự động chạy', 'value' => 3, 'step'=> '0.01'], $value['time']);?>
                    <?php $Form->add('display[speed]', 'number', ['label' => 'Thời gian hoàn thành chạy', 'value' => 0.7, 'step'=> '0.01'], $value['speed']);?>
                    <?php $Form->add('display[rows]', 'select', ['label' => 'Số hàng sản phẩm', 'options' => [1 => '1 hàng', 2 => '2 hàng']], $value['rows']);?>
                    <?php $Form->html(false);?>
                </div>
                <div class="<?php echo ($value['type'] == 1) ? 'active in' : '';?> tab-pane fade" id="display_list"></div>
            </div>
            <script defer>
                let tab = $('#widget_product_style_1 .tab-content .tab-pane');

                $('#widget_product_style_1 .nav-tabs li .display_type').click(function () {
                    let idTab = $(this).closest('li').attr('data-tab');
                    tab.removeClass('active');
                    tab.removeClass('in');
                    $(idTab).addClass('active');
                    $(idTab).addClass('in');
                });
            </script>
        </div>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

Widget::add('widget_videos_style_1');
