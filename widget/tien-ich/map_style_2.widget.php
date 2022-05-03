<?php
class widget_map_style_2 extends widget {
    function __construct(){
        parent::__construct('widget_map_style_2', 'Map & Fanpage', ['container' => true, 'position' => 'right']);
        $this->tags = ['tien-ich'];
        $this->author = 'SKD';
    }
    function form($left = [], $right = []) {
        $left[] = ['field'  => 'map', 'label' => 'Map code', 'type' => 'textarea'];
        $right[] = ['field' => 'title2', 'label' => 'Tiêu đề 2', 'type' => 'text'];
        $right[] = ['field' => 'title3', 'label' => 'Tiêu đề 3', 'type' => 'text'];
        $right[] = ['field' => 'bannerImg', 'label' => 'Ảnh banner', 'type' => 'image'];
        $right[] = ['field' => 'bannerUrl', 'label' => 'Liên kết banner', 'type' => 'text'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_map_style_2');
        echo $box['before'];
        ?>
        <div class="boxContent">
            <div class="map-style-2-heading row row-flex">
                <div class="col-md-4">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                </div>
                <div class="col-md-4">
                    <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                </div>
                <div class="col-md-4">
                    <?php ThemeWidget::heading($this->options->title3, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                </div>
            </div>
            <div class="row row-flex">
                <div class="col-md-4 map-style-2-content">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                    <div class="map-style-2-box maps"><?php echo $this->options->map;?></div>
                </div>
                <div class="col-md-4 map-style-2-content">
                    <?php ThemeWidget::heading($this->options->title2, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                    <div class="map-style-2-box fanpage"><div class="fb-page" data-tabs="timeline,events,messages" data-href="<?php echo option::get('social_facebook');?>" data-width="500" data-height="250" data-hide-cover="false" data-show-facepile="false"></div></div>
                </div>
                <div class="col-md-4 map-style-2-content">
                    <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id); ?>
                    <div class="map-style-2-box banner effect-hover-guong effect-hover-zoom">
                        <a href="<?php echo $this->options->bannerUrl;?>"><?php echo Template::img($this->options->bannerImg);?></a>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .widget_map_style_2 .row-flex {
                display: flex; flex-wrap: wrap;
            }
            .widget_map_style_2 .fanpage {
                background-color: #F5F6F7; height: 100%;
            }

            .widget_map_style_2 .maps, .widget_map_style_2 .maps iframe {
                height: 340px!important;
            }
            .widget_map_style_2 .map-style-2-box {
                box-shadow: 0 0 10px 1px rgba(0,50,82,0.4);
                border-radius: 4px;
                overflow: hidden;
            }
            .widget_map_style_2 .map-style-2-content .header-title {
                display: none;
            }
            @media(max-width: 600px) {
                .widget_map_style_2 .map-style-2-heading { display: none; }
                .widget_map_style_2 .map-style-2-content { margin-bottom: 10px; }
                .widget_map_style_2 .map-style-2-content .header-title {
                    display: block;
                }
                .widget_map_style_2 .fanpage {
                    height: auto;
                }
            }
        </style>
        <?php
        echo $box['after'];
    }
    function default() {
        if($this->name == 'Map & Fanpage')      $this->name = 'CỬA HÀNG';
        if(!isset($this->options->title2))      $this->options->title2 = 'FANPAGE';
        if(!isset($this->options->title3))      $this->options->title3 = 'QUẢNG CÁO';
        if(!isset($this->options->box))         $this->options->box = 'container';
        if(empty($this->options->map))         $this->options->map = Option::get('maps_embed');
        if(!isset($this->options->bannerImg))   $this->options->bannerImg = 'https://cdn.sikido.vn/image/random/'.rand(1,1000).'/500x400';
        if(!isset($this->options->bannerUrl))   $this->options->bannerUrl = '';
    }
}
Widget::add('widget_map_style_2');
