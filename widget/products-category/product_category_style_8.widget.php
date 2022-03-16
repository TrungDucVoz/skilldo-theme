<?php
class widget_product_category_style_8 extends widget {
    function __construct() {
        parent::__construct('widget_product_category_style_8', 'Danh Mục Sản Phẩm (style 8)', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
        $this->tags = ['product_category'];
        $this->author = 'SKDSoftware Dev Team';
    }
    function form( $left = [], $right = []) {
        $right[] = ['field' => 'titleRight', 'label' =>'Tiêu đề trái', 'type' => 'text'];
        $options = [];
        if(class_exists('ProductCategory')) {
            $options = ProductCategory::gets(['mutilevel' => 'option', 'params' => ['select' => 'id, name, level']]);
        }
        $left[] = ['field' => 'pr_cate_id', 'label' =>'Danh mục sản phẩm', 'type' => 'repeater', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Images'), 'col' => 6],
            ['name' => 'cateID', 'type' => 'select', 'label' => __('Danh mục'), 'col' => 6, 'options' => $options],
        ]];

        $left[] = ['field' => 'galleries', 'label' =>'Hình ảnh cột phải', 'type' => 'repeater', 'fields' => [
            ['name' => 'image', 'type' => 'image', 'label' => __('Images'), 'col' => 6],
            ['name' => 'name', 'type' => 'text', 'label' => __('Alt'), 'col' => 6],
            ['name' => 'url', 'type' => 'text', 'label' => __('Liên kết'), 'col' => 12],
        ]];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_product_category_style_8');
        echo $box['before'];
        ?>
        <div class="box-content" style="overflow:inherit;">
            <div class="row">
                <div class="col-md-9">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                    <?php if(have_posts($this->options->categories)) {?>
                    <?php foreach ($this->options->categories as $key => $val): ?>
                        <div class="grid-catalog__cell col-xs-6 col-sm-4 col-md-4">
                            <?php echo $this->item($val);?>
                        </div>
                    <?php endforeach ?>
                    <?php } ?>
                </div>
                <div class="col-md-3 grid-catalog">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
                    <div class="row">
                        <?php if(have_posts($this->options->galleries)) {?>
                            <?php foreach ($this->options->galleries as $key => $val): ?>
                                <div class="grid-catalog__cell col-xs-6 col-sm-4 col-md-4">
                                    <div class="item">
                                        <div class="img">
                                            <a href="<?= Url::permalink($val['url']);?>">
                                                <?php Template::img($val['image'], $val['name'], ['lazy' => 'default']);?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
        echo $box['after'];
    }
    function item($category) {
        ?>
        <div class="item">
            <div class="img">
                <a href="<?= Url::permalink($category->slug);?>" class="">
                    <?php Template::img($category->image, $category->name, ['lazy' => 'default']);?>
                </a>
            </div>
        </div>
        <?php
    }
    function css() { include_once('assets/product-category-style-8.css'); }
    function default() {
        if(!isset($this->options->per_row))         $this->options->per_row = 5;
        if(!isset($this->options->per_row_tablet))  $this->options->per_row_tablet = 3;
        if(!isset($this->options->per_row_mobile))  $this->options->per_row_mobile = 2;
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
            $this->options->categories = [];
            if(!empty($this->options->pr_cate_id)) {
                $listID = [];
                foreach ($this->options->pr_cate_id as $item) {
                    $listID[] = $item['cateID'];
                }
                $categories = ProductCategory::gets(['where_in' => ['field' => 'id', 'data' => $listID], 'select' => 'id, slug, name']);

                foreach ($this->options->pr_cate_id as $item) {
                    foreach ($categories as $category) {
                        if($category->id == $item['cateID']) {
                            $category->image = $item['image'];
                            $this->options->categories[] = $category;
                        }
                    }
                }
            }
        }
    }
}

Widget::add('widget_product_category_style_8');
