<?php
class widget_product_category_style_1 extends widget {
    function __construct() {
        parent::__construct('widget_product_category_style_1', 'Danh Mục Sản Phẩm (style 1)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['product_category'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $options = [];
        if(class_exists('ProductCategory')) {
            $options = ProductCategory::gets(['mutilevel' => 'option', 'params' => ['select' => 'id, name, level']]);
        }
        $left[] = ['field' => 'pr_cate_id', 'label' =>'Danh mục sản phẩm', 'type' => 'select2-multiple', 'options' => $options];
        $left[] = [
            'field' => 'display_type',
            'type' => 'select', 'options' => array('Loại chạy ngang', 'Loại danh sách'), 'after' => '<div class="col-md-4 form-group group" id="box_display_type"><label for="display_type" class="control-label">Kiểu hiển thị</label>', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'pr_margin', 'type' => 'number', 'value' => 10, 'note' => 'Chỉ áp dụng cho kiểu chạy ngang', 'options' => array('Sản phẩm chạy ngang', 'Danh sách sản phẩm'),
            'after' => '<div class="col-md-4 form-group group"><label for="pr_margin" class="control-label">Khoảng cách giữa các sản phẩm</label>', 'before'=> '</div>'
        ];
        $left[] = [
            'field' => 'limit', 'type' => 'number', 'value' => 10, 'note'=>'Để 0 để lấy tất cả', 'after' => '<div class="col-md-4 form-group group"><label for="pr_margin" class="control-label">Số sản phẩm lấy ra</label>', 'before'=> '</div>'
        ];
        $left[] = ['field' => 'per_row', 'label' =>'Số sản phẩm trên 1 hàng', 'type' => 'col', 'value' => 4, 'args' => ['min'=>1, 'max' => 5]];
        $left[] = ['field' => 'per_row_tablet','label' =>'Số sản phẩm trên 1 hàng - tablet', 'type' => 'col', 'value' => 3, 'args' => ['min'=>1, 'max' => 5]];
        $left[] = ['field' => 'per_row_mobile','label' =>'Số sản phẩm trên 1 hàng - mobile', 'type' => 'col', 'value' => 2, 'args' => ['min'=>1, 'max' => 5]];
        $right[] = [
            'field' => 'time', 'label' =>'Time tự động chạy', 'type' => 'number', 'value' => 2, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        $right[] = [
            'field' => 'speed', 'label' =>'Time hoàn thành chạy', 'type' => 'number', 'value' => 3, 'after' => '<div class="col-md-6 form-group group">', 'before'=> '</div>'
        ];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_product_category_style_1');
        echo $box['before'];
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);
        if(have_posts($this->options->categories)) {
            if ($this->options->display_type == 0) $this->displayHorizontal($this->options->categories);
            if ($this->options->display_type == 1) $this->displayList($this->options->categories);
            ?>
            <script defer>
                $(function () {
                    let product_category_width = $('.widget_product_category_style_1 .item .img').width();
                    $('.widget_product_category_style_1 .item .img').css('height',product_category_width+'px');
                })
            </script>
            <?php
        }
        echo $box['after'];
    }
    function displayHorizontal($categories) {
        ?>
        <div class="box-content" style="position: relative">
            <div class="arrow_box" id="widget_product_btn_<?= $this->id;?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="widget_product_<?= $this->id;?>" class="owl-carousel">
                <?php foreach ($categories as $key => $val): ?>
                    <?php echo $this->item($val);?>
                <?php endforeach ?>
            </div>
        </div>

        <script defer>
            $(function(){

                let config = {
                    items 				:<?= $this->options->per_row;?>,
                    margin				:<?= $this->options->pr_margin;?>,
                    autoplayTimeout		:<?= ($this->options->speed+$this->options->time)*1000;?>,
                    autoplaySpeed 		:<?= $this->options->speed*1000;?>,
                    loop				:true, autoplay:true, autoplayHoverPause:true,
                    responsive 			:{ 0	:{ items:<?= $this->options->per_row_mobile;?> },  500	:{ items:<?= $this->options->per_row_tablet;?> },  1000:{ items:<?= $this->options->per_row;?> } }
                };

                let ol = $("#widget_product_<?= $this->id;?>").owlCarousel(config);

                $('#widget_product_btn_<?= $this->id;?> '+'.next').click(function() {
                    ol.trigger('next.owl.carousel', [1000]);
                });
                $('#widget_product_btn_<?= $this->id;?> '+' .prev').click(function() {
                    ol.trigger('prev.owl.carousel', [1000]);
                });
            });
        </script>
        <?php
    }
    function displayList($categories) {
        $this->options->per_row_mobile = ($this->options->per_row_mobile == 5)?15:(12/$this->options->per_row_mobile);
        $this->options->per_row_tablet = ($this->options->per_row_tablet == 5)?15:(12/$this->options->per_row_tablet);
        $this->options->per_row        = ($this->options->per_row == 5)?15:(12/$this->options->per_row);
        ?>
        <div class="box-content">
            <div id="widget_product_<?= $this->id;?>" class="row">
                <?php foreach ($categories as $key => $val): ?>
                    <div class="col-xs-<?php echo $this->options->per_row_mobile;?> col-sm-<?php echo $this->options->per_row_tablet;?> col-md-<?php echo $this->options->per_row;?> col-lg-<?php echo $this->options->per_row;?>">
                        <?php echo $this->item($val);?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <?php
    }
    function item($category) {
        ?>
        <div class="item">
            <div class="img">
                <a href="<?= Url::permalink($category->slug);?>" class=""><?php Template::img($category->image, $category->name);?></a>
            </div>
            <div class="title">
                <p class="heading"><a href="<?= Url::permalink($category->slug);?>" title="<?php echo $category->name;?>"><?php echo $category->name;?></a></p>
            </div>
        </div>
        <?php
    }
    function css() { include_once('assets/product-category-style-1.css'); }
    function default() {
        if(!isset($this->options->display_type)) $this->options->display_type = 0;
        if(!isset($this->options->pr_margin))       $this->options->pr_margin = 10;
        if(!isset($this->options->limit))           $this->options->limit = 10;
        if(!isset($this->options->per_row))         $this->options->per_row = 5;
        if(!isset($this->options->per_row_tablet))  $this->options->per_row_tablet = 3;
        if(!isset($this->options->per_row_mobile))  $this->options->per_row_mobile = 2;
        if(!isset($this->options->time))               $this->options->time = 2;
        if(!isset($this->options->speed))              $this->options->speed = 3;
        if(!isset($this->options->pr_margin))  $this->options->banner_img = 'https://cdn.sikido.vn/image/random/'.rand(1,1000);
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(!isset($this->options->pr_cate_id) || $this->options->pr_cate_id == '') {
            $this->options->categories = [];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Điện máy - điện gia dụng',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Laptop - máy tính bàn',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Điện thoại - thiết bị di động',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Linh kiện máy tính',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Đồng hồ nam',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Thiết bị mạng an ninh',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Đồ dùng học sinh',
            ];
            $this->options->categories[] = (object)[
                'slug'  => 'san-pham',
                'image' => 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/category',
                'name'  => 'Đồ dùng học sinh',
            ];
        }
        else  {
            $args = ['where' => [], 'limit' => 50, 'params' => ['orderby' => 'order, created desc']];
            if($this->options->limit > 0) $args['limit'] = $this->options->limit;
            $this->options->categories = [];
            if($this->options->pr_cate_id != 0) {
                $this->options->categories = ProductCategory::gets(['where_in' => ['field' => 'id', 'data' => $this->options->pr_cate_id]]);
            }
        }
    }
}

Widget::add('widget_product_category_style_1');
