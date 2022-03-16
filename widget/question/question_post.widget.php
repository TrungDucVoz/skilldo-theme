<?php
class widget_question_post extends widget {
    public function __construct() {
        parent::__construct('widget_question_post', 'Câu hỏi & Bài viêt', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['post', 'question'];
        $this->author = 'SKDSoftware Dev Team';
    }
    public function form( $left = [], $right = []) {
        $left[] = ['field' => 'post_cate_id', 'label' =>'Danh mục item', 'type' => 'cate_post_categories'];
        $right[] = ['field' => 'title2', 'label' =>'Tiêu đề phải', 'type' => 'text'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_question_post');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="col-md-6 post-box post">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-content">
                    <div class="arrow_box" id="widget_post_btn_<?= $this->id;?>">
                        <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                        <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                    </div>
                    <div id="widget_post_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->posts as $key => $val) {
                            $this->itemPost($val);
                        } ?>
                    </div>
                </div>

                <script defer>
                    $(function(){
                        let config = {
                            items 				:2,
                            margin				:30,
                            autoplayTimeout		:2000,
                            autoplaySpeed 		:5000,
                            loop				:true, autoplay:false, autoplayHoverPause:true,
                            responsive 			:{ 0:{ items:1 },  500:{ items:1 },  1000:{ items:2 } }
                        };
                        let ol = $("#widget_post_<?php echo $this->id;?>").owlCarousel(config);
                        $('#widget_post_btn_<?php echo $this->id;?> '+'.next').click(function() {
                            ol.trigger('next.owl.carousel', [1000]);
                        });
                        $('#widget_post_btn_<?php echo $this->id;?> '+' .prev').click(function() {
                            ol.trigger('prev.owl.carousel', [1000]);
                        });
                    });
                </script>
            </div>
            <div class="col-md-6 question-box">
                <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="panel-group" id="question" role="tablist" aria-multiselectable="true">
                    <?php if(have_posts($this->options->questions)) {?>
                        <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($key, $item); } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function itemPost($item) {
        ?>
        <div class="item">
            <div class="img" data-aos="fade-top" data-aos-duration="500">
                <a href="<?php echo Url::permalink($item->slug);?>" class="effect-hover-zoom">
                    <?php Template::img($item->image, $item->title);?>
                </a>
            </div>
            <div class="title" data-aos="fade-up" data-aos-duration="800">
                <p class="header"><a href="<?= Url::permalink($item->slug);?>"><?= $item->title;?></a></p>
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
    function default() {
        if($this->name == 'Câu hỏi & Bài viêt') $this->name = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->title2)) $this->options->title2 = 'BÀI VIẾT';
        if(!isset($this->options->box))   $this->options->box = 'container';

        if(Plugin::isActive('question-answer')) {
            $args           = [
                'post_type' => QA_KEY,
                'params' => ['orderby' => 'order, created desc', 'limit'   => 10]
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
            $args  = ['post_type' => 'post','params' => ['orderby' => 'order, created desc', 'limit'   => 20]];
            if($this->options->post_cate_id != 0) {
                $args['where_category'] = PostCategory::get($this->options->post_cate_id);
                $this->options->post_cate = $args['where_category'];
            }
            $this->options->posts = Posts::gets($args);
        }
    }
    function css() { include_once('assets/question-post.css'); }
}

Widget::add('widget_question_post');