<?php
class widget_footer_style_3 extends widget {
    function __construct() {
        parent::__construct('widget_footer_style_3', 'Footer style 3');
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['footer'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'row_1_content', 'label' => 'Nội dung', 'type' => 'wysiwyg'];
        $right[] = ['field' => 'row_2_title', 'label' => 'Tiêu đề 2', 'type' => 'text'];
        $right[] = ['field' => 'row_2_menu', 'label' => 'Menu cột 2', 'type' => 'menu'];
        $right[] = ['field' => 'row_3_title', 'label' => 'Tiêu đề 3', 'type' => 'text'];
        $right[] = ['field' => 'row_4_title', 'label' => 'Tiêu đề 4', 'type' => 'text'];
        $right[] = ['field' => 'row_4_description', 'label' => 'Mô tả', 'type' => 'textarea'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_footer_style_3');
        echo $box['before'];
        ?>
        <div class="row">
            <div class="row_1 col-sm-12 col-md-3">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <?php echo $this->options->row_1_content;?>
            </div>
            <div class="col-sm-6 col-md-2">
                <?php ThemeWidget::heading($this->options->row_2_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <ul> <?php ThemeMenu::render(['theme_id' => $this->options->row_2_menu, 'walker' => 'store_bootstrap_nav_menu_footer']);?> </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <?php ThemeWidget::heading($this->options->row_3_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="fb-page" data-tabs="timeline,events,messages" data-href="<?php echo option::get('social_facebook');?>" data-width="500" data-height="250" data-hide-cover="false" data-show-facepile="false"></div>
            </div>
            <div class="widget_email col-sm-12 col-md-4">
                <?php ThemeWidget::heading($this->options->row_4_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->row_4_description;?></div>
                <form method="post" class="form email-register-form">
                    <div class="form-group">
                        <div class="input">
                            <input name="email" type="text" placeholder="<?php echo __('Enter your email');?>..." class="form-control input-lg" required>
                            <input name="action" type="hidden" value="ajax_email_register">
                            <input name="form_key" type="hidden" value="email_register">
                        </div>
                        <div class="button"><button type="submit" class="btn btn-effect-default btn-blue"><?php echo __('Gửi');?></button></div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        echo $box['after'];
    }
    function css() {
        ?>
        <style>
            footer .widget_footer_style_3 ul li a {
                display: block;
                padding: 5px 0;
                transition: all 0.5s;
            }
            footer .widget_footer_style_3 ul li a i {
                margin-right: 10px;
            }
            footer .widget_footer_style_3 ul li a:hover {
                padding-left: 20px;
            }
            footer .widget_footer_style_3 .widget_email .description {
                width: 700px; max-width: 100%;
                margin: 10px auto 20px auto;
            }
            footer .widget_footer_style_3 .widget_email .form-group { overflow: hidden; }
            footer .widget_footer_style_3 .widget_email .form-group .input { float: left; width:calc(100% - 100px); padding-right: 10px; margin-bottom: 10px; }
            footer .widget_footer_style_3 .widget_email .form-group .input .form-control {
                border:0;
                height: 50px;
                line-height: 50px;
                border-radius: 8px;
                margin-bottom: 0;
                float: left;
                width: 100%;
                padding: 0 20px;
                outline: none;
                color: #7c7c7c;
                font-size: 15px;
                box-shadow: none;
                background-color: #fff;
            }
            footer .widget_footer_style_3 .widget_email .form-group .button { float: left; width:100px;  }
            footer .widget_footer_style_3 .widget_email .form-group .button button {
                width:100%;
                height: 50px;
                line-height: 50px;
                padding: 0 20px;
                border-radius: 8px;
            }

            @media(max-width: 1024px) {
                footer .widget_footer_style_3 .row_1 {
                    margin-bottom: 20px;
                }
            }
            @media(max-width: 600px) {
                footer .widget_footer_style_3 .widget_email .form-group .input {
                    width:100%; padding-right: 0;
                }
                footer .widget_footer_style_3 .widget_email .form-group .button {
                    width:100%; margin-top: 10px;
                }
            }
        </style>
        <?php
    }
    function default() {
        if(!isset($this->options->row_1_content))  $this->options->row_1_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
        if(!isset($this->options->row_2_title))    $this->options->row_2_title = 'CATEGORIES';
        if(!isset($this->options->row_2_menu))     $this->options->row_2_menu = 0;
        if(!isset($this->options->row_3_title))    $this->options->row_3_title = 'BUY WITH US';
        if(!isset($this->options->row_3_menu))     $this->options->row_3_menu = 0;
        if(!isset($this->options->row_4_title))    $this->options->row_4_title = 'NEWSLETTERS';
        if(!isset($this->options->row_4_description))  $this->options->row_4_description = 'Đăng ký với chúng tôi để có thể nhận được những tin tức khuyến mãi mới nhất.';
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
            $this->options->row_4_description = (isset($this->options->{'row_4_description_'.$current})) ? $this->options->{'row_4_description_'.$current} : $this->options->row_4_description;
        }
    }
}
Widget::add('widget_footer_style_3');