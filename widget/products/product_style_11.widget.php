<?php
class widget_product_style_11 extends widget {
    function __construct() {
        parent::__construct('widget_product_style_11', 'Sản phẩm (style 11)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        add_action('theme_custom_script', array($this, 'script'), 10);
        $this->tags = ['products'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form($left = [], $right = []) {
        $left[] = [
            'field' => 'pr_cate_id1', 'label' =>'Danh mục sản phẩm', 'type' => 'product_categories',
            'after' => '<div class="col-md-6 form-group group" id="box_pr_categoryId1">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'pr_status1', 'label' => 'Loại sản phẩm', 'type' => 'select', 'options' => ['Sản phẩm mới','Sản phẩm yêu thích','Sản phẩm bán chạy','Sản phẩm nổi bật','Sản phẩm khuyến mãi'],
            'after' => '<div class="col-md-6 form-group group" id="box_pr_status1">', 'before'=> '</div>'
        ];

        $left[] = ['field' => 'title2', 'type' => 'text', 'label' => 'Tiêu đề 2'];

        $left[] = [
            'field' => 'pr_cate_id2', 'label' =>'Danh mục sản phẩm', 'type' => 'product_categories',
            'after' => '<div class="col-md-6 form-group group" id="box_pr_categoryId2">', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'pr_status2', 'label' => 'Loại sản phẩm', 'type' => 'select', 'options' => ['Sản phẩm mới','Sản phẩm yêu thích','Sản phẩm bán chạy','Sản phẩm nổi bật','Sản phẩm khuyến mãi'],
            'after' => '<div class="col-md-6 form-group group" id="box_pr_status2">', 'before'=> '</div>'
        ];

        $left[] = ['field' => 'display', 'type' => 'widget_product_style_1::inputDisplay'];
        $right[] = ['field' => 'limit', 'type' => 'number', 'value' => 10, 'label'=> 'Số sản phẩm lấy ra', 'note'=>'Để 0 để lấy tất cả (không khuyên dùng)', ];
        $right[] = ['field' => 'pr_per_row', 		'label' =>'Số sản phẩm trên 1 hàng', 			'type' => 'col', 'value' => 3, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'pr_per_row_tablet','label' =>'Số sản phẩm trên 1 hàng - tablet', 	'type' => 'col', 'value' => 3, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'pr_per_row_mobile','label' =>'Số sản phẩm trên 1 hàng - mobile', 	'type' => 'col', 'value' => 2, 'args' => array('min'=>1, 'max' => 5)];

        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_product_style_11 widget_product product-slider-horizontal');
        echo $box['before'];
        ?>
        <div id="product_style_11_content_<?= $this->id;?>" class="widget_product_box js_product_style_11_data" data-category1="<?= $this->options->pr_cate_id1;?>" data-category2="<?= $this->options->pr_cate_id2;?>" data-run="false" data-id="<?= $this->id;?>" data-options="<?php echo htmlentities(json_encode($this->options));?>">
            <div class="row">
                <div class="col-md-6 border-right js_product_style_11_box_1">
                    <div class="header-title"><h3 class="header"><?php Template::img(Url::base().Path::theme('widget/products/assets/icon-hot.png'));?> <?= $this->name;?></h3></div>
                    <div class="box-content">
                        <?php $this->loading();?>
                        <?php if($this->options->display['type'] == 0) { ?>
                            <div class="arrow_box">
                                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                            </div>
                            <div class="owl-carousel list-product"></div>
                        <?php }?>
                        <?php if($this->options->display['type'] == 1) { ?>
                            <div id="widget_product_list1_<?= $this->id;?>" class="list-product row"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 js_product_style_11_box_2">
                    <div class="header-title"><h3 class="header"><?php Template::img(Url::base().Path::theme('widget/products/assets/icon-hot.png'));?> <?= $this->options->title2;?></h3></div>
                    <div class="box-content">
                        <?php $this->loading();?>
                        <?php if($this->options->display['type'] == 0) { ?>
                            <div class="arrow_box">
                                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                            </div>
                            <div class="owl-carousel list-product"></div>
                        <?php }?>
                        <?php if($this->options->display['type'] == 1) { ?>
                            <div id="widget_product_list2_<?= $this->id;?>" class="list-product row"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->options->display['type'] == 0) { ?>
        <style>
            #product_style_11_content_<?= $this->id;?> .item {
                margin-right: <?php echo $this->options->display['margin']/2;?>px;
                margin-left: <?php echo $this->options->display['margin']/2;?>px;
            }
            #product_style_11_content_<?= $this->id;?> .slick-list {
                margin-right: -<?php echo $this->options->display['margin']/2;?>px;
                margin-left: -<?php echo $this->options->display['margin']/2;?>px;
            }
        </style>
        <?php } ?>
        <?php
        echo $box['after'];
    }
    function displayHorizontal($products) {
        if($this->options->display['rows'] == 1) {
            foreach ($products as $key => $val):
                echo scmc_template('loop/item_product', array('val' => $val));
            endforeach;
        }
        if($this->options->display['rows'] == 2) {
            $rowKey = 0;
            foreach ($products as $key => $val):
                if($rowKey == 0) echo '<div class="item_product_row">';
                echo scmc_template('loop/item_product', array('val' => $val));
                $rowKey++;
                if($rowKey == 2) { echo '</div>'; $rowKey = 0; }
            endforeach;
            if($rowKey < 2) echo '</div>';
        }
    }
    function displayList($products) {
        $this->options->per_row_mobile = ($this->options->per_row_mobile == 5)?15:(12/$this->options->per_row_mobile);
        $this->options->per_row_tablet = ($this->options->per_row_tablet == 5)?15:(12/$this->options->per_row_tablet);
        $this->options->per_row        = ($this->options->per_row == 5)?15:(12/$this->options->per_row);
        foreach ($products as $key => $val): ?>
            <div class="col-xs-<?php echo $this->options->per_row_mobile;?> col-sm-<?php echo $this->options->per_row_tablet;?> col-md-<?php echo $this->options->per_row;?> col-lg-<?php echo $this->options->per_row;?>">
                <?php echo scmc_template('loop/item_product', array('val' =>$val));?>
            </div>
        <?php endforeach;
    }
    function loading() {
        ?>
        <div class="wg-loading text-center">
            <div class="row">
                <div class="col-xs-6 col-sm-4">
                    <?php $this->itemLoading();?>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?php $this->itemLoading();?>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?php $this->itemLoading();?>
                </div>
            </div>
        </div>
        <?php
    }
    function itemLoading() {
        ?>
        <div class="product--item-load">
            <div class="picture"></div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 big"></div>
                <div class="col-xs-4 col-sm-4 col-md-4 empty big"></div>
                <div class="col-xs-2 col-sm-2 col-md-2 big"></div>
                <div class="col-xs-4 col-sm-4 col-md-4"></div>
                <div class="col-xs-8 col-sm-8 col-md-8 empty"></div>
                <div class="col-xs-6 col-sm-6 col-md-6"></div>
                <div class="col-xs-6 col-sm-6 col-md-6 empty"></div>
                <div class="col-xs-12 col-sm-12 col-md-12"></div>
            </div>
        </div>
        <?php
    }
    function css() { include_once('assets/product-style-11.css'); }
    function script() { include_once('assets/product-script-11.js'); }
    function default() {
        if(!isset($this->options->title2))  $this->options->title2 = 'SẢN PHẨM BÁN CHẠY';
        if(!isset($this->options->pr_cate_id1))  $this->options->pr_cate_id1 = 0;
        if(!isset($this->options->pr_status1))      $this->options->pr_status1 = 0;
        if(!isset($this->options->pr_cate_id2))  $this->options->pr_cate_id2 = 0;
        if(!isset($this->options->pr_status2))      $this->options->pr_status2 = 0;
        if(empty($this->options->display)) $this->options->display = [];
        if(!isset($this->options->display['type'])) $this->options->display['type'] = 0;
        if(!isset($this->options->display['margin'])) $this->options->display['margin'] = 15;
        if(!isset($this->options->display['time'])) $this->options->display['time'] = 3;
        if(!isset($this->options->display['speed'])) $this->options->display['speed'] = 0.7;
        if(!isset($this->options->display['rows'])) $this->options->display['rows'] = 1;
        if(!isset($this->options->limit)) $this->options->limit = 10;
        if(!isset($this->options->per_row)) $this->options->per_row = 3;
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 3;
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 2;
        if(!isset($this->options->box))   $this->options->box = 'container';
    }
    static function loadProduct($ci, $model) {
        $result['status']   = 'error';
        $result['message']  = 'Lấy dữ liệu thất bại';
        if(InputBuilder::post()) {
            $widgetID          = (int)InputBuilder::post('widgetId');
            $categoryID         = (int)InputBuilder::post('categoryId');
            $widgetData = Widget::get($widgetID);
            if(have_posts($widgetData)) {
                $slug    =  Url::permalink(URL_PRODUCT);
                $widget = new widget_product_style_11();
                $widget->options = (object)unserialize($widgetData->options);
                $widget->default();
                $args = [
                    'where'  => ['public' => 1, 'trash' => 0],
                    'params' => ['orderby' => 'order, created desc', 'limit' => (!empty($widget->options->limit)) ? $widget->options->limit : 50]
                ];
                if(!empty($categoryID)) {
                    $args['where_category'] = ProductCategory::get($categoryID);
                    if(have_posts($args['where_category'])) $slug = Url::permalink($args['where_category']->slug);
                }
                $products = Product::gets($args);
                $result['item'] = '';
                $widget->id = $widgetID;
                ob_start();
                if($widget->options->display['type'] == 0) $widget->displayHorizontal($products);
                if($widget->options->display['type'] == 1) $widget->displayList($products);
                $result['item'] = ob_get_contents();
                ob_clean();
                ob_end_flush();
                $result['status']   = 'success';
                $result['slug']     = $slug;
            }
        }
        echo json_encode( $result );
    }
    static function inputDisplay($param, $value = []) {

        if(!is_array($value)) $value = [];
        if(!isset($value['type']))   $value['type'] = 0;
        if(!isset($value['margin'])) $value['margin'] = 15;
        if(!isset($value['time']))   $value['time'] = 3;
        if(!isset($value['speed']))  $value['speed'] = 0.7;
        if(!isset($value['rows']))   $value['rows'] = 1;

        $Form = new FormBuilder();

        ob_start();
        ?>
        <div class="js_input_tab_display">
            <ul class="input-tabs with-indicator" style="margin-bottom: 5px;">
                <li class="tab <?php echo ($value['type'] == 0) ? 'active' : '';?>" style="width:calc(100%/2)" data-tab="#display_slider">
                    <label for="display_type_0">
                        <input class="display_type" id="display_type_0" type="radio" name="display[type]" value="0" <?php echo ($value['type'] == 0) ? 'checked' : '';?>> Sản phẩm chạy ngang
                    </label>
                </li>
                <li class="tab <?php echo ($value['type'] == 1) ? 'active' : '';?>" style="width:calc(100%/2)" data-tab="#display_list">
                    <label for="display_type_1">
                        <input class="display_type" id="display_type_1" type="radio" name="display[type]" value="1" <?php echo ($value['type'] == 1) ? 'checked' : '';?>> Sản phẩm danh sách
                    </label>
                </li>
                <div class="indicator" style="width:calc(100%/2);"></div>
            </ul>
            <div class="row">
                <div class="tab-content">
                    <div class="<?php echo ($value['type'] == 0) ? 'active in' : '';?> tab-pane fade" id="display_slider">
                        <?php $Form->add('display[margin]', 'number', ['label' => 'Khoảng cách các item', 'value' => 15, 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'], $value['margin']);?>
                        <?php $Form->add('display[time]', 'number', ['label' => 'Thời gian tự động chạy', 'value' => 3, 'step'=> '0.01', 'after' => '<div class="builder-col-6 col-md-6 form-group group">', 'before'=> '</div>'], $value['time']);?>
                        <?php $Form->add('display[speed]', 'number', ['label' => 'Thời gian hoàn thành chạy', 'value' => 0.7, 'step'=> '0.01', 'after' => '<div class="builder-col-12 col-md-6 form-group group">', 'before'=> '</div>'], $value['speed']);?>
                        <?php $Form->add('display[rows]', 'tab', ['label' => 'Số hàng', 'options' => [1 => '1 hàng', 2 => '2 hàng'], 'after' => '<div class="builder-col-12 col-md-6 form-group group">', 'before'=> '</div>'], $value['rows']);?>
                        <?php $Form->html(false);?>
                    </div>
                    <div class="<?php echo ($value['type'] == 1) ? 'active in' : '';?> tab-pane fade" id="display_list"></div>
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
Widget::add('widget_product_style_11');
Ajax::client('widget_product_style_11::loadProduct');
