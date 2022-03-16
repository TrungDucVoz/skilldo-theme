<?php
class widget_brands_partner extends widget {

    function __construct() {
        parent::__construct('widget_brands_partner', 'Đối tác & thương hiệu', [ 'container' => true, 'position' => 'right' ]);
        $this->tags = ['slider'];
        $this->author = 'SKDSoftware Dev Team';
    }

    function form( $left = [], $right = []) {

        $galleries = Gallery::gets();

        $options = [];

        if(option::get('product_brands') == 1) {
            $options['brand'] = 'Thương hiệu sản phẩm';
        }
        foreach ($galleries as $gallery) {
            $options[$gallery->id] = 'Gallery - '.$gallery->name;
        }
        $left[] = ['field' => 'gallery', 'label' =>'Nguồn dữ liệu', 'type' => 'select', 'options' => $options];
        $right[] = ['field' => 'per_row', 		'label' =>'Số sản phẩm trên 1 hàng', 			'type' => 'col', 'value' => 4, 'args' => array('min'=>1, 'max' => 10)];
        $right[] = ['field' => 'per_row_tablet','label' =>'Số sản phẩm trên 1 hàng - tablet', 	'type' => 'col', 'value' => 3, 'args' => array('min'=>1, 'max' => 5)];
        $right[] = ['field' => 'per_row_mobile','label' =>'Số sản phẩm trên 1 hàng - mobile', 	'type' => 'col', 'value' => 2, 'args' => array('min'=>1, 'max' => 5)];

        parent::form($left, $right);
    }

    function widget() {
        ob_start();
        ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
        <div class="box-content" style="position: relative">
            <div class="arrow_box" id="widget_brands_partner_btn_<?= $this->id;?>">
                <div class="prev arrow"><i class="fal fa-chevron-left"></i></div>
                <div class="next arrow"><i class="fal fa-chevron-right"></i></div>
            </div>
            <div id="widget_brands_partner_list_<?= $this->id;?>" class="owl-carousel">
                <?php if($this->options->gallery == 'brand') { $this->brands($this->options); }?>
                <?php if(is_numeric($this->options->gallery)) { $this->partner($this->options); }?>
            </div>
        </div>
        <style>
            .widget_brands_partner .logo-item {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                height: 90px;
                padding:0 10px;
            }
            .widget_brands_partner .logo-item img {
                margin: 0 auto;
                transition: all 0.5s ease-in-out;
            }
        </style>
        <script defer>
            $(function(){
                let config = {
                    items 				:<?= $this->options->per_row;?>,
                    margin				:30,
                    autoplayTimeout		:5000,
                    autoplaySpeed 		:2000,
                    loop				:true, autoplay:true, autoplayHoverPause:true,
                    responsive 			:{ 0:{ items:<?= $this->options->per_row_mobile;?> },  500:{ items:<?= $this->options->per_row_tablet;?> },  1000:{ items:<?= $this->options->per_row;?> } }
                };
                let id = <?= $this->id;?>;
                let sliderList = $("#widget_brands_partner_list_"+id);
                let sliderBtnNext = $('#widget_brands_partner_btn_' + id + ' .next');
                let sliderBtnPrev = $('#widget_brands_partner_btn_' + id + ' .prev');
                let ol = sliderList.owlCarousel(config);
                sliderBtnNext.click(function() { ol.trigger('next.owl.carousel', [1000]); });
                sliderBtnPrev.click(function() { ol.trigger('prev.owl.carousel', [1000]); });
            });
        </script>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        $box = $this->container_box('widget_brands_partner');
        echo $box['before'];
        echo $content;
        echo $box['after'];
    }

    function partner() {
        $galleries = Gallery::getsItem(['where'  => ['group_id' => $this->options->gallery],'params' => ['limit' => 30]]);
        foreach ($galleries as $key => $item) { $url = Gallery::getItemMeta($item->id, 'url', true);  ?>
        <div class="logo-item">
            <a href="<?php echo $url;?>"><?php Template::img($item->value);?></a>
        </div>
        <?php }
    }

    function brands($option) {
        $brands = Brand::gets(['params' => ['limit' => 30]]);
        foreach ($brands as $key => $item) { ?>
            <div class="logo-item">
                <a href="<?php echo Url::permalink($item->slug);?>"><?php Template::img($item->image, $item->name);?></a>
            </div>
        <?php }
    }
}

Widget::add('widget_brands_partner');
