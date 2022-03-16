<?php
class widget_map_style_1 extends widget {
    function __construct(){
        parent::__construct('widget_map_style_1', 'Map & Nội dung', ['container' => true, 'position' => 'right']);
        add_action('theme_custom_css', array($this, 'css'), 10);
        $this->tags = ['tien-ich'];
        $this->author = 'Huyền Trang';
    }
    function form($left = [], $right = []) {
        $left[] = ['field' => 'content', 'label' => 'Nội dung', 'type' => 'wysiwyg'];
        $left[] = ['field' => 'borderColor', 'label' => 'Màu viền', 'type' => 'color'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_map_style_1');
        echo $box['before'];
        ?>
        <div class="boxContent">
            <div class="maps"><?php echo option::get('maps_embed'); ?></div>
            <div class="content">
                <?php if ($this->name != '') { ?><div class="header-title"><p class="header"><?= $this->name; ?></p></div><?php } ?>
                <div class="br"><?php echo $this->options->content; ?></div>
            </div>
        </div>
        <style>
            :root {
                --map1-border-color:<?php echo (!empty($this->options->borderColor)) ? $this->options->borderColor : 'var(--theme-color)';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }
    function css(){
        include_once('assets/map-style-1.css');
    }
    function default() {
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->content))   $this->options->content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
    }
}
Widget::add('widget_map_style_1');
