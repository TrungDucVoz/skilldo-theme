<?php
class widget_footer_style_5 extends widget {
    function __construct() {
        parent::__construct('widget_footer_style_5', 'Footer style 5');
        add_action('theme_custom_css', [$this, 'css'], 10);
        $this->tags = ['footer'];
        $this->author = 'Ngọc Diệp';
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'row_1_content', 'label' => 'Nội dung', 'type' => 'wysiwyg'];$left[] = ['field' => 'row_2_title', 'label' => 'Tiêu đề 2', 'type' => 'text'];
        $left[] = ['field' => 'row_2_description', 'label' => 'Mô tả', 'type' => 'text'];
        $left[] = ['field' => 'row_3_title', 'label' => 'Tiêu đề 3', 'type' => 'text'];
        $left[] = ['field' => 'row_3_description', 'label' => 'Mô tả 3', 'type' => 'text'];
        $left[] = ['field' => 'row_4_title', 'label' => 'Tiêu đề 4', 'type' => 'text'];
        $left[] = ['field' => 'row_4_description', 'label' => 'Mô tả 4', 'type' => 'text'];
        $left[] = [ 'field' => 'list_item', 'type' => 'repeater', 'label' => 'Item', 'fields' => [
            ['name' => 'image', 'type' => 'image',  'label' => __('Hình ảnh'), 'col' => 6],
            ['name' => 'title', 'type' => 'text',  'label' => __('Tiêu đề'), 'col' => 6, 'language' => true],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 6],
        ]
        ];
        $list_social = get_theme_social();
        foreach ($list_social as $key => $field) {
            $right[] = ['field' => 'footer_'.$field['field'].'_icon', 'label' => 'Icon '.$field['label'], 'type' => 'image'];
        }
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_footer_style_5');
        echo $box['before'];
        ?>
        <style>
            :root{
                --border-color-footer: <?php echo Option::get('footer_text_color', '#fff');?>;
            }
        </style>
        <div class="row-footer">
            <div class="col-footer">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <?php echo $this->options->row_1_content;?>

            </div>
            <div class="col-footer">
                <?php ThemeWidget::heading($this->options->row_2_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->row_2_description;?></div>
                <div class="box-social">
                    <?php
                    $social = get_theme_social();
                    foreach ($social as $key => $field) {
                        if(empty($this->options->{'footer_'.$field['field'].'_icon'})) continue;
                        ?>
                        <a href="<?php echo get_option($field['field']);?>" class="effect-filter">
                            <?php Template::img($this->options->{'footer_'.$field['field'].'_icon'}, $field['label']);?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-footer widget_email">
                <?php ThemeWidget::heading($this->options->row_3_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->row_3_description;?></div>
                <form method="post" class="form email-register-form">
                    <div class="form-group">
                        <div class="input">
                            <input name="email" type="text" placeholder="<?php echo __('Email của bạn');?>..." class="form-control input-lg" required>
                            <input name="action" type="hidden" value="ajax_email_register">
                            <input name="form_key" type="hidden" value="email_register">
                        </div>
                        <div class="button">
                            <button type="submit" class="btn"><i class="far fa-envelope"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-footer">
                <?php ThemeWidget::heading($this->options->row_4_title, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="description"><?php echo $this->options->row_4_description;?></div>
                <?php if ($this->options->list_item): ?>
                    <div class="list-item">
                        <?php foreach ($this->options->list_item as $key => $item): ?>
                            <div class="img">
                                <a href="<?php echo Template::imgLink($item['image']);?>" title="<?php echo $item['title'] ?>" class="effect-hover-zoom" data-fancybox="group">
                                    <?php Template::img($item['image'], $item['title']);?>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function css() {
        ?>
        <style>
            footer .widget_footer_style_5 {
                text-align: center;
            }
            footer .widget_footer_style_5 .row-footer{
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-gap: 50px;
            }
            footer .widget_footer_style_5 .row-footer .col-footer{
                position: relative;
            }
            footer .widget_footer_style_5 .row-footer .col-footer:before{
                position: absolute;
                content: '';
                width: 1px;
                border-right: 1px dashed var(--border-color-footer);
                height: 75%;
                top: 50%;
                left: -25px;
                transform: translateY(-50%);
            }
            footer .widget_footer_style_5 .row-footer .col-footer:first-of-type::before{display: none;}
            footer .widget_footer_style_5 .description{
                margin-bottom: 5px;
            }
            footer .widget_footer_style_5 .box-social a img{
                margin-right: 7px;
                margin-bottom: 7px;
            }
            footer .widget_footer_style_5 .box-social a:last-of-type img{
                margin-right: 0px;

            }
            footer .widget_footer_style_5 .box-social a img{
                height: 40px;
            }
            footer .widget_footer_style_5 .widget_email .form-group {
                overflow: hidden;
                border-bottom: 1px solid var(--border-color-footer);
                display: grid;
                grid-template-columns: auto 50px;
                grid-gap: 5px;
            }
            footer .widget_footer_style_5 .widget_email .form-group .input .form-control {
                border:0;
                height: 40px;
                line-height: 40px;
                border-radius: 0px;
                margin-bottom: 0;
                float: left;
                width: 100%;
                padding: 0 20px;
                outline: none;
                font-size: 14px;
                box-shadow: none;
                background-color: transparent;
                padding-left: 0;
                padding-right: 0;
            }
            footer .widget_footer_style_5 .widget_email .form-group .input .form-control::-webkit-input-placeholder {
                color: var(--border-color-footer);
                font-style: italic;
            }
            footer .widget_footer_style_5 .widget_email .form-group .button {}
            footer .widget_footer_style_5 .widget_email .form-group .button button {
                width:100%;
                height: 40px;
                line-height: 40px;
                padding: 0;
                border-radius: 0px;
                text-align: center;
                color: var(--border-color-footer);
                border: 0;
                width: 100%;
                text-align: center;
                background-color: transparent;
            }
            footer .widget_footer_style_5 .widget_email .form-group .button button:focus{
                outline: none;
            }
            footer .widget_footer_style_5 .list-item{
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                grid-gap: 5px;
            }
            footer .widget_footer_style_5 .list-item .img {
                position: relative;
                display: block;
                width: 100%;
                padding-top: 100%;
                height: inherit;
                border-radius: 0px;
                overflow: hidden;
            }
            footer .widget_footer_style_5 .list-item .img a {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }
            footer .widget_footer_style_5 .list-item .img a img {
                min-height: 100%;
                min-width: 100%;
                position: relative;
                display: inherit;
                transition: all .5s ease-in-out;
                object-fit: cover;
            }
            @media(max-width: 1000px) {
                footer .widget_footer_style_5 .row-footer{ grid-template-columns: repeat(2, 1fr); }
                footer .widget_footer_style_5 .row-footer .col-footer:nth-of-type(2n+1)::before{
                    display: none;
                }
            }
            @media(max-width: 600px) {
                footer .widget_footer_style_5 .row-footer{ grid-template-columns: repeat(1, 1fr); }
                footer .widget_footer_style_5 .row-footer .col-footer:before{
                    display: none!important;
                }
            }
        </style>
        <?php
    }
    function default() {
        if($this->name == 'Footer style 5') $this->name = 'LIÊN HỆ';
        if(!isset($this->options->row_1_content))  $this->options->row_1_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
        if(!isset($this->options->row_2_title))  $this->options->row_2_title = 'MẠNG XÃ HỘI';
        if(!isset($this->options->row_2_description))  $this->options->row_2_description = 'Bấm theo dõi để nhận tin';
        if(!isset($this->options->row_3_title))  $this->options->row_3_title = 'ĐĂNG KÍ NHẬN TIN';
        if(!isset($this->options->row_3_description))  $this->options->row_3_description = 'Nhập thông tin để nhập khuyến mãi';
        if(!isset($this->options->row_4_title))  $this->options->row_4_title = 'INSTAGRAM';
        if(!isset($this->options->row_4_description))  $this->options->row_4_description = 'Theo dõi để xem mẫu mới';
        if(empty($this->options->list_item)) {
            $this->options->list_item    = [];
            $this->options->list_item[0] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                'title'         =>  'Tiêu đề item 1',
            ];

            $this->options->list_item[1] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                'title'         =>  'Tiêu đề item 2',
            ];
            $this->options->list_item[2] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                'title'         =>  'Tiêu đề item 3',
            ];
            $this->options->list_item[3] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                'title'         =>  'Tiêu đề item 4',
            ];
            $this->options->list_item[4] = [
                'image'         =>  'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/200x200',
                'title'         =>  'Tiêu đề item 5',
            ];
        }
        else{
            foreach ($this->options->list_item as $key => $value) {
                if(!isset($value['image'])) $value['image'] = '';
                if(!isset($value['title'])) $value['title'] = '';
            }
        }

        $social = get_theme_social();
        foreach ($social as $key => $field) {
            if(!isset($this->options->{'footer_'.$field['field'].'_icon'})) {
                switch ($field['field']) {
                    case "social_facebook":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_facebook-128.png';
                        break;
                    case "social_twitter":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_twitter-128.png';
                        break;
                    case "social_youtube":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_youtube-128.png';
                        break;
                    case "social_instagram":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn2.iconfinder.com/data/icons/social-media-applications/64/social_media_applications_3-instagram-128.png';
                        break;
                    case "social_pinterest":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn1.iconfinder.com/data/icons/logotypes/32/pinterest-128.png';
                        break;
                    case "social_zalo":
                        $this->options->{'footer_'.$field['field'].'_icon'} = 'https://cdn1.iconfinder.com/data/icons/logos-brands-in-colors/2500/zalo-seeklogo.com-128.png';
                        break;
                    default: $this->options->{'footer_'.$field['field'].'_icon'} = '';
                }

            }
        }
        $this->language();
    }

    function language() {
        $current = Language::current();
        if(Language::hasMulti() && Language::default() != $current) {
            $this->options->row_2_title = (isset($this->options->{'row_2_title_'.$current})) ? $this->options->{'row_2_title_'.$current} : $this->options->row_2_title;
            $this->options->row_2_description = (isset($this->options->{'row_2_description_'.$current})) ? $this->options->{'row_2_description_'.$current} : $this->options->row_2_description;
            $this->options->row_3_title = (isset($this->options->{'row_3_title_'.$current})) ? $this->options->{'row_3_title_'.$current} : $this->options->row_3_title;
            $this->options->row_3_description = (isset($this->options->{'row_3_description_'.$current})) ? $this->options->{'row_3_description_'.$current} : $this->options->row_3_description;
            $this->options->row_4_title = (isset($this->options->{'row_4_title_'.$current})) ? $this->options->{'row_4_title_'.$current} : $this->options->row_4_title;
            $this->options->row_4_description = (isset($this->options->{'row_4_description_'.$current})) ? $this->options->{'row_4_description_'.$current} : $this->options->row_4_description;
            $this->options->row_1_content = (isset($this->options->{'row_1_content_'.$current})) ? $this->options->{'row_1_content_'.$current} : $this->options->row_1_content;
            foreach ($this->options->list_item as $key => &$item) {
                if(isset($item['title_'.$current])) $item['title'] = $item['title_'.$current];
            }
        }
    }
}
Widget::add('widget_footer_style_5');