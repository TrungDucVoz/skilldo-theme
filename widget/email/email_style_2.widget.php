<?php
class widget_email_style_2 extends widget {

    function __construct() {
        parent::__construct('widget_email_style_2', 'Email (style 2)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['email'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'description', 'label' =>'Mô tả', 'type' => 'textarea' ];
        parent::form($left, $right);
    }

    function widget() {
        $box = $this->container_box('widget_email_style_2');
        echo $box['before'];
        ?>
        <div class="box-content">
            <div class="box-left">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->description;?></div>
            </div>
            <div class="box-right">
                <form method="post" class="form email-register-form">
                    <div class="form-group">
                        <div class="input">
                            <input name="email" type="text" placeholder="Địa chỉ email" class="form-control input-lg" required>
                            <input name="action" type="hidden" value="ajax_email_register">
                            <input name="form_key" type="hidden" value="email_register">
                        </div>
                        <div class="button">
                            <button type="submit" class="btn btn-effect-default btn-blue">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        echo $box['after'];
    }

    function default() {
        if($this->name == 'Email (style 2)') $this->name = 'Sign up to receive promotions';
        if(!isset($this->options->description)) $this->options->description = '<p>Integer pretium molestie nisl, non blandit lectus suscipit in. Vivamus tellus diam, iaculis eget nulla sit amet, tincidunt consectetur sem. Suspendisse laoreet, quam sed faucibus feugiat, tortor velit suscipit orci, sed consectetur ante eros id urna. Mauris luctus nulla ut pharetra tempor.</p>';
        if(!isset($this->options->box))    $this->options->box = 'container';
        if(!isset($this->options->bg_image)) $this->options->bg_image = 'https://cdn.sikido.vn/image/random/'.rand(1,1000);
        if(!isset($this->options->bg_color)) $this->options->bg_color = 'rgba(0,0,0,0.42)';
        if(!isset($this->options->box_size)) {
            $this->options->box_size['padding'] = ['top' => '20', 'left' => 0, 'bottom' => 40, 'right' => 0];
        }
    }

    function css() { include_once('assets/email-style-2.css'); }
}

Widget::add('widget_email_style_2');
