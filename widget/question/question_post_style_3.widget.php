<?php
class widget_question_post_style_3 extends widget {
    function __construct() {
        parent::__construct('widget_question_post_style_3', 'Câu hỏi và bài viết (style 3)', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array($this, 'css'), 10);
        $this->tags = ['question', 'post'];
        $this->author = 'Huyền Trang';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'post_cate_id', 'label' => 'Danh mục item', 'type' => 'cate_post_categories'];
        $left[] = ['field' => 'post_limit', 'type' => 'number', 'value' => 5, 'label' => 'Số Item lấy ra'];
        $left[] = ['field' => 'post_run', 'type' => 'number', 'value' => 5, 'label' => 'Số Item chạy'];
        $left[] = ['field' => 'question_title', 'label' => 'Tiêu đề bên trái', 'type' => 'text'];
        $left[] = ['field' => 'question_limit', 'label' =>'Số câu hỏi hiển thị', 'type' => 'number', 'value' => 6];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_question_post_style_3 post');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="col-md-4 question-box">
                <?php ThemeWidget::heading($this->options->question_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-ques-container">
                    <div class="panel-group" id="question-<?= $this->id;?>" role="tablist" aria-multiselectable="true">
                        <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($key, $item); } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="post-list-box">
                    <?php if (have_posts($this->options->posts)) {
                        $postMain = $this->options->posts[0]; unset($this->options->posts[0]); ?>
                        <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                        <div class="row">
                            <div class="col-md-6 post-main"><?php $this->item($postMain); ?></div>
                            <div class="col-md-6 post-list">
                                <div class="box-content" style="padding-bottom: 10px;">
                                    <div id="widget_post_list_<?= $this->id; ?>">
                                        <?php foreach ($this->options->posts as $key => $val) { $this->item($val); } ?>
                                    </div>
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
                                            slidesToShow: <?php echo $this->options->post_run;?>,
                                            slidesToScroll: 1,
                                            responsive: [
                                                {
                                                    breakpoint: 1000,
                                                    settings: { slidesToShow: 4 }
                                                },
                                                {
                                                    breakpoint: 600,
                                                    settings: { slidesToShow: 3 }
                                                }
                                            ]
                                        };
                                        let sliderList = $("#widget_post_list_<?= $this->id; ?>");
                                        sliderList.slick(config);
                                    });
                                </script>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="xemthem">
                        <a href="<?php echo Url::permalink($this->options->slug);?>" class="btn btn-effect-default btn-theme">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function itemQuestion($key, $item) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="question_heading_<?php echo $key;?>">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#question-<?= $this->id;?>" href="#question_group_<?php echo $key;?>" aria-expanded="true" aria-controls="question_group_<?php echo $key;?>">
                        <div class="plus-main"><i class="fal fa-plus-circle"></i></div>
                        <div class="title-po"><?= str_word_cut(Str::clear($item->title), 15); ?></div>
                    </a>
                </h4>
            </div>
            <div id="question_group_<?php echo $key;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question_heading_<?php echo $key;?>">
                <div class="panel-body">
                    <?= str_word_cut(Str::clear($item->content), 50); ?>
                </div>
            </div>
        </div>
        <?php
    }
    function item($item) {
        ?>
        <div class="item">
            <div class="img">
                <a href="<?php echo Url::permalink($item->slug); ?>" class="effect-hover-zoom">
                    <?php Template::img($item->image, $item->title); ?>
                </a>
            </div>
            <div class="title">
                <p class="header"><a href="<?= Url::permalink($item->slug); ?>"><?= $item->title; ?></a></p>
                <div class="description"><?php echo Str::limit(Str::clear($item->excerpt), 200); ?></div>
            </div>
        </div>
        <?php
    }
    function css() {
        include_once('assets/question-post-style-3.css');
    }
    function default() {
        if($this->name == 'Câu hỏi và bài viết (style 3)') $this->name = 'BLOG';
        if(!isset($this->options->question_title)) $this->options->question_title = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->question_limit))   $this->options->question_limit = 10;
        if(!isset($this->options->post_limit))   $this->options->post_limit = 10;
        if(!isset($this->options->post_run))   $this->options->post_run = 5;
        $this->options->slug = 'tin-tuc';
        if(Plugin::isActive('question-answer')) {
            $args           = [
                'post_type' => QA_KEY,
                'params' => ['orderby' => 'order, created desc', 'limit'   => $this->options->limit_ques]
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
                (object)[
                    'id' => 7,
                    'title'     => 'Do you include common questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'id' => 8,
                    'title'     => 'Can I use this for 21 questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
            ];
        }

        if(!isset($this->options->post_cate_id)) {
            $this->options->posts = Posts::gets(['post_type' => 'post']);
        }
        else {
            $args  = ['post_type' => 'post','params' => ['orderby' => 'order, created desc', 'limit'   => $this->options->post_limit]];
            if($this->options->post_cate_id != 0) {
                $args['where_category'] = PostCategory::get($this->options->post_cate_id);
                if(have_posts($args['where_category'])) {
                    $this->options->slug = $args['where_category']->slug;
                }
            }
            $this->options->posts = Posts::gets($args);
        }
    }
}
Widget::add('widget_question_post_style_3');