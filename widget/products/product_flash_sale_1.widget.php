<?php
class widget_product_flash_sale_1 extends widget {
    function __construct() {
        parent::__construct('widget_product_flash_sale_1', 'Sản phẩm (Flash Sale)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
    }
    function form( $left = [], $right = []) {
        if(class_exists('Promotions_manager')) {
            $promotions = Promotions::getsByRun();
            if(have_posts($promotions)) {
                $promotionsOption = [];
                foreach ($promotions as $promotion) {
                    $promotionsOption[$promotion->id] = $promotion->name;
                }
                $left[] = [
                    'field'     => 'promotion',
                    'label'     => 'Chương trình khuyến mãi', 'type' => 'select',
                    'options'   => $promotionsOption
                ];
            }
            else {
                $left[] = ['field' => '', 'type' => 'html', 'before' => '<div><div class="clearfix"></div>'.notice('error', 'Bạn chưa có chương trình khuyến mãi nào.'),'after' => '</div>'];
            }
        }
        else {
            $left[] = ['field' => 'time_sale', 'label' =>'Thời gian kết thúc khuyến mãi', 'type' => 'datetime', 'data-time-format' => 'hh:ii'];
            $left[] = ['field' => 'pr_categoryId', 		'label' =>'Danh mục sản phẩm', 'type' => 'product_categories'];
            $left[] = ['field' => 'pr_status', 'label' => 'Loại sản phẩm', 'type' => 'select', 'options' => ['Sản phẩm mới','Sản phẩm yêu thích','Sản phẩm bán chạy','Sản phẩm nổi bật','Sản phẩm khuyến mãi']];
        }
        $left[] = ['field' => 'display', 'type' => 'widget_product_flash_sale_1::inputDisplay'];
        $right[] = ['field' => 'icon', 'type' => 'image', 'label'=> 'Icon Flash Sale'];
        $right[] = ['field' => 'limit', 'type' => 'number', 'value' => 10, 'label'=> 'Số sản phẩm lấy ra', 'note'=>'Để 0 để lấy tất cả (không khuyên dùng)', ];
        $right[] = ['field' => 'per_row', 		'label' =>'Số sản phẩm trên 1 hàng', 			'type' => 'col', 'value' => 4, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'per_row_tablet','label' =>'Số sản phẩm trên 1 hàng - tablet', 	'type' => 'col', 'value' => 3, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'per_row_mobile','label' =>'Số sản phẩm trên 1 hàng - mobile', 	'type' => 'col', 'value' => 2, 'args' => array('min'=>1, 'max' => 5)];
        parent::form($left, $right);
    }
    function widget() {
        $flashSale = $this->getData();
        if($flashSale['time'] <= time()) return false;
        $box = $this->container_box('widget_product_flash_sale product-slider-horizontal');
        $icon = Path::theme().'widget/products/assets/flash.png';
        if(!empty($this->options->icon)) $icon = Template::imgLink($this->options->icon);
        echo $box['before']; ?>
        <div class="box_content">
            <div class="header-title">
                <h2 class="header"><img src="<?php echo $icon;?>" alt="Flash sale"><?= $this->name;?></h2>
                <div class="adv_product hidden-xs">
                    <div class="cd countdown<?= $this->id;?>">
                        <div class="count days">
                            <div class="cd_item"></div><div class="dv">Ngày</div>
                        </div>
                        <div class="count hours">
                            <div class="cd_item"></div><div class="dv">Giờ</div>
                        </div>
                        <div class="count minutes">
                            <div class="cd_item"></div><div class="dv">Phút</div>
                        </div>
                        <div class="count seconds">
                            <div class="cd_item"></div><div class="dv">Giây</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="widget_product_content_<?= $this->id;?>">
                <div class="box-content">
                    <?php if($this->options->display['type'] == 0) { ?>
                        <div class="arrow_box" id="widget_product_btn_<?= $this->id;?>">
                            <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                            <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
                        </div>
                        <div id="widget_product_list_<?= $this->id;?>" class="owl-carousel">
                            <?php $this->displayHorizontal($flashSale['products']);?>
                        </div>
                        <style>
                            .product-slider-horizontal #widget_product_list_<?= $this->id;?> .item { margin-right: <?php echo $this->options->display['margin']/2;?>px; margin-left: <?php echo $this->options->display['margin']/2;?>px;}
                        </style>
                    <?php }?>
                    <?php if($this->options->display['type'] == 1) { ?>
                        <div id="widget_product_list_<?= $this->id;?>" class="list-item-product row">
                            <?php $this->displayList($flashSale['products'], $this->options);?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        $this->script($flashSale['time']);
        echo $box['after'];
    }
    function getData() {
        $data = ['time' => time(), 'products' => []];
        if(class_exists('Promotions_manager')) {
            if(!empty($this->options->promotion)) {
                $promotion = Promotions::get($this->options->promotion);
                if(have_posts($promotion)) {
                    $data['time'] = $promotion->time_end;
                    if($promotion->time_end > time()) {
                        $data['products'] = Product::gets([
                            'where_in' => ['field' => 'id', 'data' => array_keys(unserialize($promotion->object_parent))],
                            'limit' => (!empty($this->options->limit)) ? $this->options->limit : 20
                        ]);
                    }
                }
            }
        }
        else {
            $data['time'] = strtotime($this->options->time_sale);
            $args = [
                'where'  => ['public' => 1, 'trash' => 0],
                'params' => ['orderby' => 'order, created desc', 'limit' => (!empty($this->options->limit)) ? $this->options->limit : 50]
            ];
            if(!empty($this->options->pr_categoryId)) {
                $args['where_category'] = ProductCategory::get($this->options->pr_categoryId);
            }
            if($this->options->pr_status >= 1 && $this->options->pr_status <= 3) {
                $status = 'status'.$this->options->pr_status;
                $args['where'][$status] = 1;
            }
            $data['products'] = Product::gets($args);
        }
        return $data;
    }
    function displayHorizontal($products) {
        if($this->options->display['rows'] == 1) {
            foreach ($products as $key => $val):
                echo scmc_template('loop/item_product', array('val' => $val));
            endforeach;
        }
        if($this->options->display['rows'] == 2) {
            $row_key = 0;
            foreach ($products as $key => $val):
                if($row_key == 0) echo '<div class="item_product_row">';
                echo scmc_template('loop/item_product', array('val' => $val));
                $row_key++;
                if($row_key == 2) { echo '</div>'; $row_key = 0; }
            endforeach;
            if($row_key < 2) echo '</div>';
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
    function css() { include_once('assets/product-flash-sale-1.css'); }
    function script($milliseconds) {
        ?>
        <script defer>
            $(function(){
                $.ajaxSetup({
                    beforeSend: function(xhr, settings) {
                        if (settings.data.indexOf('csrf_test_name') === -1) {
                            settings.data += '&csrf_test_name=' + encodeURIComponent(getCookie('csrf_cookie_name'));
                        }
                    }
                });
                let display = <?php echo $this->options->display['type'];?>;
                let pr_config = {
                    infinite: true,
                    dots:false,
                    autoplay: true,
                    autoplaySpeed: <?= $this->options->display['time']*1000;?>,
                    speed: <?= $this->options->display['speed']*1000;?>,
                    slidesToShow: <?= $this->options->per_row;?>,
                    slidesToScroll: <?= $this->options->per_row;?>,
                    responsive: [
                        { breakpoint: 1000, settings: { slidesToShow: <?= $this->options->per_row_tablet;?>, slidesToScroll: <?= $this->options->per_row_tablet;?>, } },
                        { breakpoint: 600, settings: { slidesToShow: <?= $this->options->per_row_mobile;?>, slidesToScroll: <?= $this->options->per_row_mobile;?>, } }
                    ]
                };
                function product_flash_sale_slider(id, config) {
                    if(display === 1) return false;
                    let productList = $("#widget_product_list_"+id);
                    let productBtnNext = $('#widget_product_btn_' + id + ' .next');
                    let productBtnPrev = $('#widget_product_btn_'+ id +' .prev');
                    productList.slick(config);
                    productBtnNext.click(function() {productList.slick('slickNext');return false;});
                    productBtnPrev.click(function() {productList.slick('slickPrev');return false;});
                }
                product_flash_sale_slider(<?php echo $this->id;?>, pr_config);
                function makeTimer<?= $this->id;?>() {
                    let endTime = <?= (int)$milliseconds; ?>;
                    let now = new Date();
                    now = (Date.parse(now) / 1000);
                    let timeLeft = endTime - now;
                    if (timeLeft <= 0 ){
                        $(".adv_product .countdown<?= $this->id;?>").html("<div class='end-sale'>Hết khuyến mãi</div>");
                        $(".adv_product .box-content-text<?= $this->id; ?>").html("");
                    }
                    let days = Math.floor(timeLeft / 86400);
                    let hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                    let minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
                    let seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
                    if (days<"10") { days = "0" + days}
                    if (hours < "10") { hours = "0" + hours; }
                    if (minutes < "10") { minutes = "0" + minutes; }
                    if (seconds < "10") { seconds = "0" + seconds; }

                    $(".adv_product .countdown<?= $this->id;?> .days .cd_item").html(days);
                    $(".adv_product .countdown<?= $this->id;?> .hours .cd_item").html(hours);
                    $(".adv_product .countdown<?= $this->id;?> .minutes .cd_item").html(minutes);
                    $(".adv_product .countdown<?= $this->id;?> .seconds .cd_item").html(seconds);
                }
                setInterval(function() { makeTimer<?= $this->id;?>(); }, 1000);
            });
        </script>
        <?php
    }
    function default() {
        if(!isset($this->options->pr_categoryId)) $this->options->pr_categoryId = 0;
        if(!isset($this->options->pr_status)) $this->options->pr_status = 0;
        if(empty($this->options->time_sale)) $this->options->time_sale = 0;
        if(empty($this->options->display)) $this->options->display = [];
        if(!isset($this->options->display['type'])) $this->options->display['type'] = 0;
        if(!isset($this->options->display['margin'])) $this->options->display['margin'] = 15;
        if(!isset($this->options->display['time'])) $this->options->display['time'] = 3;
        if(!isset($this->options->display['speed'])) $this->options->display['speed'] = 0.9;
        if(!isset($this->options->display['rows'])) $this->options->display['rows'] = 1;

        if(!isset($this->options->limit)) $this->options->limit = 10;
        if(!isset($this->options->per_row)) $this->options->per_row = 4;
        if(!isset($this->options->per_row_tablet)) $this->options->per_row_tablet = 3;
        if(!isset($this->options->per_row_mobile)) $this->options->per_row_mobile = 2;

        if(!isset($this->options->box))   $this->options->box = 'container';
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

Widget::add('widget_product_flash_sale_1');