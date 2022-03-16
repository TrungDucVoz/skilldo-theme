<?php
class widget_question_post_style_2 extends widget {
    public function __construct() {
        parent::__construct('widget_question_post_style_2', 'Câu hỏi & Bài viết (Style 2)', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['post', 'question'];
        $this->author = 'Ngọc Diệp';
    }
    public function form( $left = [], $right = []) {
        $left[] = ['field' => 'post_cate_id', 'label' =>'Danh mục bài viết', 'type' => 'cate_post_categories'];
        $left[] = ['field' => 'limit_post', 'type' => 'number', 'value' => 10, 'label'=> 'Số bài viết lấy ra', 'note'=>'Để 0 để lấy tất cả',];
        $right[] = ['field' => 'title2', 'label' =>'Tiêu đề phải', 'type' => 'text'];
        $right[] = ['field' => 'limit_ques', 'type' => 'number', 'value' => 10, 'label'=> 'Số câu hỏi lấy ra', 'note'=>'Để 0 để lấy tất cả',];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_question_post_style_2');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="col-md-6 post-box">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-content">
                    <div id="widget_post_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->posts as $key => $val) { $this->itemPost($val); } ?>
                    </div>
                </div>
                <script defer>
                    $(function(){
                        let config = {
                            infinite: true,
                            vertical: true,
                            dots:false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            speed: 3000,
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            responsive: [
                                { breakpoint: 1000, settings: { slidesToShow: 3} },
                                { breakpoint: 600, settings: { slidesToShow: 3} }
                            ]
                        };
                        let sliderList = $("#widget_post_<?php echo $this->id;?>");
                        sliderList.slick(config);
                    });
                </script>
            </div>
            <div class="col-md-6 question-box">
                <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-ques-container">
                    <div class="panel-group" id="question" role="tablist" aria-multiselectable="true">
                        <?php if(have_posts($this->options->questions)) {?>
                            <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($key, $item); } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function(){
                let wh = $('.widget_question_post_style_2 #widget_post_<?php echo $this->id ?>').height();
                $('.widget_question_post_style_2 .question-box .box-ques-container .panel-group').height(wh);
            })
        </script>
        <?php
        echo $box['after'];
    }
    function itemPost($item) {
        ?>
        <div class="item">
            <div class="img">
                <a href="<?php echo Url::permalink($item->slug);?>" class="effect-hover-zoom">
                    <?php Template::img($item->image, $item->title);?>
                </a>
            </div>
            <div class="title">
                <h3 class="header"><a href="<?= Url::permalink($item->slug);?>"><?= $item->title;?></a></h3>
                <p class="description"><?= Str::clear($item->excerpt);?></p>
            </div>
        </div>
        <?php
    }
    function itemQuestion($key, $item) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="question_heading_<?php echo $key;?>">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#question" href="#question_group_<?php echo $key;?>" aria-expanded="true" aria-controls="question_group_<?php echo $key;?>">
                        <div class="plus-main"><i class="fal fa-plus-circle"></i></div>
                        <div class="title-po"><?= Str::clear($item->title); ?></div>
                    </a>
                </h4>
            </div>
            <div id="question_group_<?php echo $key;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question_heading_<?php echo $key;?>">
                <div class="panel-body">
                    <?= Str::clear($item->content); ?>
                </div>
            </div>
        </div>
        <?php
    }
    function css() { include_once('assets/question-post-style-2.css'); }
    function default() {
        if($this->name == 'Câu hỏi & Bài viết (Style 2)') $this->name = 'BLOG';
        if(!isset($this->options->title2)) $this->options->title2 = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->limit_ques))   $this->options->limit_ques = 10;
        if(!isset($this->options->limit_post))   $this->options->limit_post = 10;
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
                    'title'     => 'What are some random questions to ask?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'title'     => 'Do you include common questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'title'     => 'Can I use this for 21 questions?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'title'     => 'Are these questions for girls or for boys?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'title'     => 'What is the next skill that you\'d like to learn really well?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
                (object)[
                    'title'     => 'How would you describe someone who is wealthy?',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                ],
            ];
        }

        if(!isset($this->options->post_cate_id)) {
            $this->options->posts = Posts::gets(['post_type' => 'post']);
        }
        else {
            $args  = ['post_type' => 'post','params' => ['orderby' => 'order, created desc', 'limit'   => $this->options->limit_post]];
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
Widget::add('widget_question_post_style_2');