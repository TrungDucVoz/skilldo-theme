<?php
class widget_email_style_3 extends widget {

    function __construct() {
        parent::__construct('widget_email_style_3', 'Email (style 3)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['email'];
        $this->author = 'SKDSoftware Dev Team';
        $this->heading = false;
    }

    function form( $left = [], $right = []) {
        $left[] = [ 'field' => 'headingColor', 'label' =>'Màu tiêu đề', 'type' => 'color' ];
        $left[] = [ 'field' => 'description', 'label' =>'Mô tả', 'type' => 'text' ];
        $left[] = [ 'field' => 'banner', 'label' =>'Banner', 'type' => 'image' ];
        $right[] = [ 'field' => 'icon', 'label' =>'Icon', 'type' => 'image' ];
        $right[] = [ 'field'=> 'position', 'label' =>'Vị trí', 'type' => 'tab', 'options' => ['text_img' => 'Fom - Hình ảnh', 'img_text' => 'Hình ảnh - Form',]];
        parent::form($left, $right);
    }

    function widget() {
        $box = $this->container_box('widget_email_style_3');
        echo $box['before'];
        ?>
        <div class="box-content email-box <?php echo $this->options->position;?>">
            <div class="email-box-form">
                <div class="email-box-heading">
                    <div class="img"><?php echo Template::img($this->options->icon);?></div>
                    <div class="heading"><span><?php echo $this->name;?></span></div>
                </div>
                <div class="description"><?php echo $this->options->description;?></div>
                <form method="post" class="form email-register-form">
                    <div class="form-group">
                        <div class="input">
                            <input name="email" type="text" placeholder="Nhập email" class="form-control input-lg" required>
                            <input name="action" type="hidden" value="ajax_email_register">
                            <input name="form_key" type="hidden" value="email_register">
                        </div>
                        <div class="button">
                            <button type="submit" class="btn">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="email-box-banner" style="background-image: url('<?php echo Template::imgLink($this->options->banner);?>')"></div>
        </div>
        <style>
            :root {
                --email3-heading-color:<?php echo ($this->options->headingColor) ? $this->options->headingColor : '#000';?>;
            }
        </style>
        <?php
        echo $box['after'];
    }

    function default() {
        if($this->name == 'Email (style 3)') $this->name = 'SUBSCRIBE TO OUR NEWSLETTER';
        if(!isset($this->options->position)) $this->options->position = 'text_img';
        if(!isset($this->options->description)) $this->options->description = '<p>Để lại thông tin của bạn</p>';
        if(!isset($this->options->box))    $this->options->box = 'container';
        if(!isset($this->options->banner)) $this->options->banner = Url::base().Path::theme('widget/email/assets/email-style-3-bg.png');
        if(empty($this->options->icon)) $this->options->icon = Url::base().Path::theme('widget/email/assets/email-style-3-icon.png');
        if(!isset($this->options->box_size)) {
            $this->options->box_size['padding'] = ['top' => '20', 'left' => 0, 'bottom' => 40, 'right' => 0];
        }
    }

    function css() { include_once('assets/email-style-3.css'); }
}

Widget::add('widget_email_style_3');
