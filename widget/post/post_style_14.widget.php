<?php
class widget_post_style_14 extends widget {

    function __construct() {
        parent::__construct('widget_post_style_14', 'Bài viết (style 14)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['post', 'product'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {
        $left[] = ['field' => 'data', 'type' => 'widget_post_style_14::inputData'];
        parent::form($left, $right);
    }

    public function widget() {
        $box = $this->container_box('widget_post_style_14 post');
        echo $box['before'];
        if(have_posts($this->options->objects)) { ?>
            <div class="post-list swiper" id="post_style_14_<?php echo $this->id;?>">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                <div class="project-block-list swiper-wrapper">
                    <?php foreach ($this->options->objects as $key => $val) { $this->item($val); } ?>
                </div>
            </div>
            <style>
                .js_widget_post_style_14_<?php echo $this->id;?> {
                    --post13-txt-color:<?php echo (!empty($this->options->postTextColor)) ? $this->options->postTextColor : '#000';?>;
                    --post13-heading-color:<?php echo (!empty($this->options->postHeadingColor)) ? $this->options->postHeadingColor : '#000';?>;
                    --post13-des-color:<?php echo (!empty($this->options->postDesColor)) ? $this->options->postDesColor : '#687385';?>;
                }
            </style>
            <script>
                $(function () {
                    let swiper = new Swiper("#post_style_14_<?php echo $this->id;?>", {
                        slidesPerView: 3,
                        spaceBetween: 0,
                        loop: true,
                        breakpoints : {
                            0: { slidesPerView: 1 },
                            1000: { slidesPerView: 3 },
                        }
                    });
                    swiper.on('slideChange', function () {
                        $("img[loading='lazy']").Lazy();
                        console.log('slide changed');
                    });
                })
            </script>
        <?php }
        echo $box['after'];
    }

    public function item($item) {
        ?>
        <div class="project-block swiper-slide">
            <div class="inner-box">
                <div class="pattern-layer" style="background-image:url('views/theme-store/widget/post/assets/post-pattern-14.png')"></div>
                <div class="image">
                    <a href="<?= Url::permalink($item->slug);?>">
                        <?php Template::img($item->image, $item->title, ['lazy' => 'default']);?>
                    </a>
                    <div class="content-box">
                        <div class="content-inner">
                            <h3><?= $item->title;?></h3>
                        </div>
                    </div>
                </div>
                <div class="overlay-box">
                    <div class="overlay-inner">
                        <div class="overlay-image">
                            <a href="<?= Url::permalink($item->slug);?>">
                                <?php Template::img($item->image, $item->title, ['lazy' => 'default']);?>
                            </a>
                        </div>
                        <h3><a href="<?= Url::permalink($item->slug);?>"><?= $item->title;?></a></h3>
                        <a href="<?= Url::permalink($item->slug);?>" class="read-more btn btn-effect-default btn-theme">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function css() { include_once('assets/post-style-14.css'); }

    public function default() {
        if(!isset($this->options->box))   $this->options->box = 'container';
        if(!isset($this->options->data)) {
            $this->options->data = ['type' => 0, 'postCateId' => 0];
        }

        $this->options->objects = [];

        if($this->options->data['type'] == 0) {

            $args = [
                'post_type' => 'post',
                'params' => ['orderby' => 'order, created desc', 'limit'   => 10]
            ];

            if(!empty($this->options->data['postCateId'])) {
                $args['where_category'] = PostCategory::get($this->options->data['postCateId']);
            }

            $this->options->objects = Posts::gets($args);
        }

        if($this->options->data['type'] == 1) {

            $args = [
                'where'  => ['public' => 1, 'trash' => 0],
                'params' => ['orderby' => 'order, created desc', 'limit' => 10]
            ];

            if(!empty($this->options->data['postCateId'])) {
                $args['where_category'] = ProductCategory::get($this->options->data['postCateId']);
            }

            $this->options->objects = Product::gets($args);
        }
    }

    static function inputData($param, $value = []) {

        if(!is_array($value)) $value = [];
        if(!isset($value['postCateId']))   $value['postCateId'] = 0;
        if(!isset($value['productCateId'])) $value['productCateId'] = 0;
        if(!isset($value['productStatus'])) $value['productStatus'] = 0;
        if(!isset($value['type'])) $value['type'] = 0;

        $Form = new FormBuilder();

        ob_start();
        ?>
        <div class="js_input_tab_display">
            <ul class="input-tabs with-indicator" style="margin-bottom: 5px;">
                <li class="tab <?php echo ($value['type'] == 0) ? 'active' : '';?>" style="width:calc(100%/2)" data-tab="#display_slider">
                    <label for="display_type_0">
                        <input class="display_type" id="display_type_0" type="radio" name="data[type]" value="0" <?php echo ($value['type'] == 0) ? 'checked' : '';?>> Bài viết
                    </label>
                </li>
                <?php if(class_exists('sicommerce')) { ?>
                <li class="tab <?php echo ($value['type'] == 1) ? 'active' : '';?>" style="width:calc(100%/2)" data-tab="#display_list">
                    <label for="display_type_1">
                        <input class="display_type" id="display_type_1" type="radio" name="data[type]" value="1" <?php echo ($value['type'] == 1) ? 'checked' : '';?>> Sản phẩm
                    </label>
                </li>
                <?php } ?>
                <div class="indicator" style="width:calc(100%/2);"></div>
            </ul>
            <div class="row">
                <div class="tab-content">
                    <div class="<?php echo ($value['type'] == 0) ? 'active in' : '';?> tab-pane fade" id="display_slider">
                        <?php $Form->add('data[postCateId]', 'cate_post_categories', ['label' => 'Danh mục tin tức'], $value['postCateId']);?>
                        <?php $Form->html(false);?>
                    </div>
                    <div class="<?php echo ($value['type'] == 1) ? 'active in' : '';?> tab-pane fade" id="display_list">
                        <?php $Form->add('data[productCateId]', 'product_categories', ['label' => 'Danh mục sản phẩm'], $value['productCateId']);?>
                        <?php $Form->add('data[productStatus]', 'select', ['label' => 'Loại sản phẩm', 'options' => ['Sản phẩm mới','Sản phẩm yêu thích','Sản phẩm bán chạy','Sản phẩm nổi bật','Sản phẩm khuyến mãi']], $value['productCateId']);?>
                        <?php $Form->html(false);?>
                    </div>
                </div>
                <script defer>
                    $('.js_input_tab_display li .display_type').click(function () {
                        let tabID = $(this).closest('li').attr('data-tab');
                        let tabBox = $(this).closest('.js_input_tab_display').find('.tab-content .tab-pane');
                        tabBox.removeClass('active').removeClass('in');
                        $(tabID).addClass('active').addClass('in');
                        $('.input-tabs .tab.active').each(function(){
                            let inputBox = $(this).closest('.input-tabs');
                            inputTabsAnimation(inputBox, $(this));
                        });
                    });
                </script>
            </div>
        </div>
        <?php
        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }
}

Widget::add('widget_post_style_14');
