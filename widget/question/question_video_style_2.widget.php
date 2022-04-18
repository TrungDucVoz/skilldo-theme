<?php
class widget_question_video_2 extends widget {
    function __construct() {
        parent::__construct('widget_question_video_2', 'Question & Videos 2', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array($this, 'css'), 10);
        $this->tags = ['video', 'question'];
        $this->author = 'Huyền Trang';
        $this->heading = false;
    }
    function form($left = [], $right = []) {
        if(!class_exists('video_gallery')) {
            $left[] = ['field' => 'gallery', 'label' => 'Nguồn dữ liệu', 'type' => 'gallery'];
        }
        $left[] = ['field' => 'question_limit', 'label' => 'Số câu hỏi hiển thị', 'type' => 'number', 'value' => 6];
        parent::form($left, $right);
    }
    function widget() {
        ob_start();
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="question-box-2">
                    <div class="slick-initialized ">
                        <div class="innerWrap" role="listbox">
                            <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($item); } ?>
                        </div>
                    </div>
                </div>
                <script defer>
                    $(function() {
                        $('.js_question_title').click(function() {
                            let id = $(this).attr('data-id');
                            let itemDetail = $('#js_show_answer' + id + '');
                            if (document.getElementById('js_show_answer' + id).style.display === "none") {
                                $('.excerpt2').slideUp();
                                itemDetail.slideDown('normal', function() {});
                            } else {
                                itemDetail.slideUp();
                            }
                        });
                    })
                </script>
            </div>
            <div class="col-md-6">
                <div class="box-content list-videos" style="position: relative">
                    <div id="widget_videos_list_<?= $this->id; ?>" class="owl-carousel">
                        <?php foreach ($this->options->galleries as $key => $val) : echo $this->item($val); endforeach; ?>
                    </div>
                    <script defer>
                        $(function() {
                            let config = {
                                infinite: true,
                                vertical: true,
                                verticalScrolling: true,
                                dots: false,
                                autoplay: true,
                                autoplaySpeed: 3000,
                                speed: 700,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                responsive: [
                                    { breakpoint: 1000, settings: { slidesToShow: 3 } },
                                    { breakpoint: 600, settings: { slidesToShow: 1, vertical: false } }
                                ]
                            };
                            let sliderList = $("#widget_videos_list_<?= $this->id; ?>");
                            sliderList.slick(config);
                        });
                    </script>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_question_video_2');
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }
    function itemQuestion($item) {
        ?>
        <div class="item list">
            <div class=" title">
                <h3 class="acc-head show-class">
                    <div class="plus-main"><i class="fal fa-plus-circle"></i></div>
                    <div class="title-po"> <a class="js_question_title" data-id='<?= $item->id ?>'><?= Str::words(Str::clear($item->title), 15); ?></a></div>
                </h3>
                <p id="js_show_answer<?= $item->id ?>" class="excerpt2 data<?= $item->id ?>" style="display: none"><?= Str::words(Str::clear($item->content), 50); ?></p>
            </div>
        </div>
        <?php
    }
    function item($item) {
        ?>
        <div class="video-section-outer">
            <div class="video-img">
                <a href="<?php echo $item->url; ?>" data-fancybox>
                    <?php Template::img($item->image); ?>
                    <div class="mfp-video play-now"> <i class="icon fa fa-play"></i> <span class="ripple"></span> </div>
                </a>
            </div>
            <div class="video-title">
                <p class="heading"><a href="<?php echo $item->url; ?>" data-fancybox><?php echo $item->title; ?></a></p>
                <?php if (!empty($item->excerpt)) { ?><div class="description"><?php echo Str::clear($item->excerpt); ?></div><?php } ?>
            </div>
        </div>
        <?php
    }
    function language() {
        $language_current = Language::current();
        if (Language::hasMulti() && Language::default() != $language_current) {
            if (isset($this->options->{'question_title_' . $language_current})) $this->options->question_title = $this->options->{'question_title_' . $language_current};
        }
    }
    function css() {
        include_once('assets/question-video-style-2.css');
    }
    function default() {
        if($this->name == 'Câu hỏi & feedback') $this->name = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->question_limit)) $this->options->question_limit = 6;
        if(!isset($this->options->box))   $this->options->box = 'container';

        if(Plugin::isActive('question-answer')) {
            $args           = [
                'post_type' => QA_KEY,
                'params' => ['orderby' => 'order, created desc', 'limit'   => (!empty($this->options->question_limit)) ? $this->options->question_limit : 50]
            ];
            $this->options->questions = Posts::gets($args);
        }
        else {
            $this->options->questions = [
                (object)[
                    'id' => 1,
                    'title'     => 'What are some random questions to ask?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 2,
                    'title'     => 'Do you include common questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 3,
                    'title'     => 'Can I use this for 21 questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 4,
                    'title'     => 'Are these questions for girls or for boys?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 5,
                    'title'     => 'What is the next skill that you\'d like to learn really well?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 6,
                    'title'     => 'How would you describe someone who is wealthy?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
            ];
        }


        if (!class_exists('video_gallery') && !isset($this->options->gallery)) {
            $this->options->galleries = (object)[
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
            $this->options->galleries = [];
            if(!empty($this->options->gallery)) {
                $galleries =  Posts::gets(['post_type' => 'video-gallery', 'params' => ['limit' => 20]]);
                foreach ($galleries as &$item) {
                    $item->url = Posts::getMeta($item->id, 'video_url', true);
                    $this->options->galleries[] = $item;
                }
            }
            else {
                $galleries =  Gallery::getsItem((isset($this->options->gallery->gallery)) ? $this->options->gallery->gallery : []);
                if(have_posts($galleries)) {
                    foreach ($galleries as &$item) {
                        if ($item->type == 'youtube') {
                            $item->url = $item->value;
                            $item->image = Template::imgLink($item->value);
                        }
                        if ($item->type == 'image') {
                            $item->url = Gallery::getItemMeta($item->id, 'url', true);
                            $item->image = $item->value;
                        }
                        $item->title = Gallery::getItemMeta($item->id, 'title', true);
                        $this->options->galleries = $item;
                    }
                }
            }
        }

        $this->language();
    }
}
Widget::add('widget_question_video_2');
