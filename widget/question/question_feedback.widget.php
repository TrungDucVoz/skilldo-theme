<?php
class widget_question_feedback extends widget {
    public function __construct() {
        parent::__construct('widget_question_feedback', 'Câu hỏi & feedback', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['feedback', 'question'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function check() {
        if(class_exists('Question_Answer') == false || !class_exists(' Customer_feedback') == false) {
            return false;
        }
        return true;
    }
    function form( $left = [], $right = []) {
        if($this->check() == false) {
            if(!class_exists('Question_Answer')) {
                $left[] = [ 'field' => '', 'type' => 'html', 'before' => '<div><div class="clearfix"></div>'.notice('error', 'Để sử dụng widget bạn cần cài đặt plugin Question & Answer'),'after' => '</div>'];
            }
            if(!class_exists('Customer_feedback')) {
                $left[] = [ 'field' => '', 'type' => 'html', 'before' => '<div>'.notice('error', 'Để sử dụng widget bạn cần cài đặt plugin Customer feedback'),'after' => '</div>'];
            }
        }
        else {
            $left[] = ['field' => 'question_limit', 'label' =>'Số câu hỏi hiển thị', 'type' => 'number', 'value' => 6];
            $left[] = ['field' => 'feedback_title', 'label' =>'Tiêu đề phải', 'type' => 'text'];
            $left[] = ['field' => 'time',  'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
            $left[] = ['field' => 'speed','label' =>'Time hoàn thành chạy','type' => 'number', 'value' => 3,'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'];
        }
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_question_feedback');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="col-md-6 question-box">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="panel-group" id="question" role="tablist" aria-multiselectable="true">
                    <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($key, $item); } ?>
                </div>
            </div>
            <div class="col-md-6 feedback-box">
                <?php ThemeWidget::heading($this->options->feedback_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="box-content">
                    <div class="arrow_box" id="feedback_btn_<?= $this->id;?>">
                        <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                        <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                    </div>
                    <div id="feedback_list_<?= $this->id;?>" class="owl-carousel">
                        <?php foreach ($this->options->feeds as $key => $val) { $this->itemFeed($val); } ?>
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
                            responsive 			:{ 0:{ items:1 },  500:{ items:2 },  1000:{ items:2 } }
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
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function itemFeed($item) {
        ?>
        <div class="item">
            <div class="avatar" data-aos="fade-top" data-aos-duration="500">
                <?php Template::img($item->image, $item->title);?>
            </div>
            <div class="title" data-aos="fade-up" data-aos-duration="800">
                <h3 class="feedback-name"><?= $item->title;?></h3>
                <p class="feedback-office"><?= $item->content;?></p>
                <div class="feedback-content"><?php echo Str::clear($item->excerpt);?></div>
            </div>
        </div>
        <?php
    }
    function itemQuestion($key, $item) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="question_heading_<?php echo $key;?>">
                <div class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#question" href="#question_group_<?php echo $key;?>" aria-expanded="true" aria-controls="question_group_<?php echo $key;?>">
                        <div class="plus-main"><i class="fal fa-plus-circle"></i></div>
                        <div class="title-po"><?= str_word_cut(Str::clear($item->title), 15); ?></div>
                    </a>
                </div>
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
        if($this->name == 'Câu hỏi & feedback') $this->name = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->feedback_title)) $this->options->feedback_title = 'Ý KIẾN KHÁCH HÀNG';
        if(!isset($this->options->question_limit)) $this->options->question_limit = 6;
        if(!isset($this->options->time))  $this->options->time = 2;
        if(!isset($this->options->speed))  $this->options->speed = 3;
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
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Hoàng Thùy Yến',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'excerpt'   => 'Nhân sự',
                ],
                (object)[
                    'image'     => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                    'title'     => 'Cao Yến Vy',
                    'content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'excerpt'   => 'Design',
                ],
            ];
        }

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
    }
    function css() { include_once('assets/question-feedback.css'); }
}

Widget::add('widget_question_feedback');