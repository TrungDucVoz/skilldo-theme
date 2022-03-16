<?php
class widget_question_video extends widget {
    public function __construct() {
        parent::__construct('widget_question_video', 'Câu hỏi & Video', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['question', 'video'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading =  false;
    }
    public function form( $left = [], $right = []) {
        $left[]  = ['field' => 'question_limit', 'label' =>'Số câu hỏi hiển thị', 'type' => 'number', 'value' => 6];
        $right[] = ['field' => 'video_img', 'label' =>'Ảnh video', 'type' => 'image', 'value' => ''];
        $right[] = ['field' => 'video_url','label' =>'Url youtube','type' => 'url', 'value' => ''];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_question_video');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="col-md-6 question-box">
                <?php if(!empty($this->name)){?><div class="header-title"><h3 class="header"><?= $this->name;?></h3></div><?php } ?>
                <div class="panel-group" id="question" role="tablist" aria-multiselectable="true">
                    <?php foreach ($this->options->questions as $key => $item) { $this->itemQuestion($key, $item); } ?>
                </div>
            </div>
            <div class="col-md-6 video-box">
                <div class="box-content">
                    <div class="video-section-outer">
                        <div class="video-section">
                            <a href="<?php echo $this->options->video_url;?>" data-fancybox>
                                <?php Template::img($this->options->video_img);?>
                                <div class="mfp-video play-now"><i class="icon fa fa-play"></i><span class="ripple"></span></div>
                            </a>
                        </div>
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
    function css() { include_once('assets/question-video.css'); }
    function default() {
        if($this->name == 'Câu hỏi & Video') $this->name = 'CÂU HỎI THƯỜNG GẶP';
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->video_img)) $this->options->video_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/600x600';;
        if(!isset($this->options->video_url)) $this->options->video_url = '';;
        if(!isset($this->options->question_limit)) $this->options->question_limit = 10;
        if(Plugin::isActive('question-answer')) {
            $args           = [
                'post_type' => QA_KEY,
                'params' => ['orderby' => 'order, created desc', 'limit' => (!empty($this->options->limit)) ? $this->options->limit : 50]
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
}

Widget::add('widget_question_video');