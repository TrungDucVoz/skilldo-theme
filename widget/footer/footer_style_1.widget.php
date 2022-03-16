<?php
class widget_footer_style_1 extends widget {
    function __construct() {
        parent::__construct('widget_footer_style_1', 'Footer style 1');
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['footer'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'row_1_content', 'label' => 'Nội dung', 'type' => 'wysiwyg'];
        $right[] = ['field' => 'row_2_title', 'label' => 'Tiêu đề 2', 'type' => 'text'];
        $right[] = ['field' => 'row_2_menu', 'label' => 'Menu cột 2', 'type' => 'menu'];
        $right[] = ['field' => 'row_3_title', 'label' => 'Tiêu đề 3', 'type' => 'text'];
        $right[] = ['field' => 'row_3_menu', 'label' => 'Menu cột 3', 'type' => 'menu'];
        $right[] = ['field' => 'row_4_title', 'label' => 'Tiêu đề 4', 'type' => 'text'];
        $right[] = ['field' => 'row_4_map', 'label' => 'Mã map', 'type' => 'textarea'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_footer_style_1');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="row_1 col-sm-12 col-md-3">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <?php echo $this->options->row_1_content;?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-sm-6 col-md-2">
                <?php ThemeWidget::heading($this->options->row_2_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <ul> <?php ThemeMenu::render(['theme_id' => $this->options->row_2_menu, 'walker' => 'store_bootstrap_nav_menu_footer']);?> </ul>
            </div>
            <div class="col-sm-6 col-md-2">
                <?php ThemeWidget::heading($this->options->row_3_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <ul> <?php ThemeMenu::render(['theme_id' => $this->options->row_3_menu, 'walker' => 'store_bootstrap_nav_menu_footer']);?> </ul>
            </div>
            <div class="col-sm-12 col-md-3">
                <?php ThemeWidget::heading($this->options->row_4_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <?php echo $this->options->row_4_map;?>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function css() {
        ?>
        <style>
            footer .widget_footer_style_1 ul li a { display: block;  padding: 5px 0; transition: all 0.5s; }
            footer .widget_footer_style_1 ul li a i { margin-right: 10px; }
            footer .widget_footer_style_1 ul li a:hover { padding-left: 20px; }
            footer .widget_footer_style_1 iframe { width:100%; height: 300px; }
            @media(max-width: 1024px) {
                footer .widget_footer_style_1 .row_1 { margin-bottom: 20px; }
            }
        </style>
        <?php
    }
    function default() {
        if(!isset($this->options->row_1_content))  $this->options->row_1_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
        if(!isset($this->options->row_2_title))  $this->options->row_2_title = 'Tiêu đề cột 2';
        if(!isset($this->options->row_2_menu))  $this->options->row_2_menu = 0;
        if(!isset($this->options->row_3_title))  $this->options->row_3_title = 'Tiêu đề cột 3';
        if(!isset($this->options->row_3_menu))  $this->options->row_3_menu = 0;
        if(!isset($this->options->row_4_title))  $this->options->row_4_title = 'Tiêu đề cột 4';
        if(!isset($this->options->row_4_map))  $this->options->row_4_map = '';
        if(!isset($this->options->box))  $this->options->box = 'container';
        $this->language();
    }
    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            $this->options->row_2_title = (isset($this->options->{'row_2_title_'.$current})) ? $this->options->{'row_2_title_'.$current} : $this->options->row_2_title;
            $this->options->row_3_title = (isset($this->options->{'row_3_title_'.$current})) ? $this->options->{'row_3_title_'.$current} : $this->options->row_3_title;
            $this->options->row_4_title = (isset($this->options->{'row_4_title_'.$current})) ? $this->options->{'row_4_title_'.$current} : $this->options->row_4_title;
            $this->options->row_1_content = (isset($this->options->{'row_1_content_'.$current})) ? $this->options->{'row_1_content_'.$current} : $this->options->row_1_content;
        }
    }
}
Widget::add('widget_footer_style_1');