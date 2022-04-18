<?php
class widget_content extends widget {
    function __construct(){
        parent::__construct('widget_content', 'Nội dung', ['container' => true, 'position' => 'right']);
        $this->tags = ['tien-ich'];
        $this->author = 'SKD Team';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'content', 'label' => 'Nội dung', 'type' => 'wysiwyg'];
        $left[] = ['field' => 'width', 'label' => 'Độ rộng', 'type' => 'number'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_content');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
        <div class="boxContent">
            <div class="content"><?php echo $this->options->content; ?></div>
        </div>
        <style>
            .js_widget_content_<?php echo $this->id;?>.widget_content .boxContent {
                width:<?php echo (empty($this->options->width)) ? '100%' : $this->options->width.'px';?>;
                max-width:100%;
                margin: 0 auto;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function default() {
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->content))   $this->options->content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
    }
}
Widget::add('widget_content');
