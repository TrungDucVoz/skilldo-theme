<?php
class widget_item_working_process extends widget {
    function __construct() {
        parent::__construct('widget_item_working_process', 'Item (Quy Trình)', ['container' => true, 'position'  => 'right']);
        add_action('theme_custom_css', array( $this, 'css'), 10);
    }
    function form( $left = [], $right = []) {
        $left[] = array('field' => 'title_2', 'type' => 'text', 'label'=>'Tiêu đề 2');
        $left[] = array('field' => 'note', 'type' => 'textarea', 'label'=>'Mô tả');
        $left[] = array('field' => 'item', 'type' => 'item_working_process', 'arg' => ['number' => 3]);
        parent::form($left, $right);
    }
    function widget() {
        $box    = $this->container_box('widget_item_working_process');
        echo $box['before'];
        
        if($option->title_2 != ''){?> <div class="header-name"><span><?php echo $option->title_2; ?></span></div> <?php }
        if($this->name != ''){?><div class="header-title">
            <div class="header-wraper">
                <div class="header-rl">
                    <h3 class="header"><?= $this->name;?></h3>
                    <div class="header-bar"><span></span><span></span><span></span><span></span></div>
                </div>
            </div>
        </div><?php } ?>
        <div class="text-center">
            <span class="note"><?php echo $option->note; ?></span>
        </div>
        <div class="working_process__row">
            <div class="working_process_box" id="working_process_<?= $this->id;?>">
                <?php foreach ($option->item as $key => $item) { ?>
                <div class="working_process_item item<?php echo $key;?> <?php echo ($key == 0) ? 'active' : '';?>" data-aos-delay="<?php echo $key*300;?>" data-aos="<?php echo $item['animate'];?>" data-aos-duration="2000" aria-hidden="false" tabindex="0" style="">
                    
                    <div class="working_process_item__circle">
                        <p class="num"><?php echo $item['number'];?></p>
                    </div>
                    <div class="border">
                        <div class="text">
                            <a href="<?php echo $item['url'];?>" tabindex="0">
                                <p class="big"><?php echo $item['title'];?></p>
                            </a>
                            <p class="small"><?php echo $item['description'];?></p>
                            <a href="<?php echo $item['url'];?>" class='read-more' tabindex="0">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <script defer>
                $(function(){
                    let config = {
                         infinite: true,
                         dots:false,
                         slidesToShow: 6,
                         slidesToScroll: 6,
                         responsive: [
                             {
                                 breakpoint: 1000,
                                 settings: {
                                     slidesToShow: 6,
                                     slidesToScroll: 6,
                                 }
                             },
                             {
                                 breakpoint: 600,
                                 settings: {
                                     slidesToShow: 2,
                                     slidesToScroll: 2,
                                 }
                             }
                         ]
                     };
                    // $('#working_process_').slick(config);
                });
            </script>
        </div>
        <?php echo $box['after'];
    }
    function language($option) {
        $language_current = Language::current();
        if(Language::hasMulti() && Language::default() != $language_current) {
            foreach ($option->item as $key => &$item) {
                if(isset($item['title_'.$language_current])) $item['title'] = $item['title_'.$language_current];
                if(isset($item['description_'.$language_current])) $item['description'] = $item['description_'.$language_current];
            }
        }
        return $option;
    }
    function css() { include_once('css/style-item-working-process.css'); }
}

Widget::add('widget_item_working_process');

function _form_item_working_process($param, $value = []) {
    if(!have_posts($value)) $value = [];
    $value_default = array( 'number' => '', 'title' => '', 'url' => '', 'animate' => '', 'description' => '' );
    //Số Lượng item
    $number = (isset($param->arg['number'])) ? (int)$param->arg['number'] : 1;
    $output = '';
    $Form = new FormBuilder();
    for ( $i = 0; $i <= $number; $i++ ) {
        if(!isset($value[$i]) || !is_array($value[$i])) $value[$i] = array();
        $value[$i] = array_merge($value_default, $value[$i]);
        $output .= '<label for="name" class="control-label">Item '.($i+1).'</label>';
        $output .= '<div class="stote_wg_item">';
        $Form->add($param->field.'['.$i.'][number]', 'number', [ 'label' => 'Số thứ tự',
            'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
        ], $value[$i]['number']);
        $Form->add($param->field.'['.$i.'][title]', 'text', [ 'label' => 'Tiêu đề',
            'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
        ], $value[$i]['title']);

        $Form->add($param->field.'['.$i.'][description]', 'text', [ 'label' => 'Mô tả',
            'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
        ], $value[$i]['description']);

        if(Language::hasMulti()) {
            foreach (Language::list() as $lang_key => $lang_val) {
                if($lang_key == Language::default()) continue;
                $value[$i]['title_'.$lang_key] = (!empty($value[$i]['title_'.$lang_key])) ? $value[$i]['title_'.$lang_key] : '';
                $value[$i]['description_'.$lang_key] = (!empty($value[$i]['description_'.$lang_key])) ? $value[$i]['description_'.$lang_key] : '';
                $Form->add($param->field.'['.$i.'][title_'.$lang_key.']', 'text', [ 'label' => 'Tiêu đề ('.$lang_val['label'].')',
                    'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                ], $value[$i]['title_'.$lang_key]);
                $Form->add($param->field.'['.$i.'][description_'.$lang_key.']', 'text', [ 'label' => 'Mô tả ('.$lang_val['label'].')',
                    'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
                ], $value[$i]['description_'.$lang_key]);
            }
        }

        $Form->add($param->field.'['.$i.'][url]', 'text', ['label' => 'Liên kết',
            'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
        ], $value[$i]['url']);

        $Form->add($param->field.'['.$i.'][animate]', 'select', ['label' => 'Hiệu ứng hiển thị',
            'options' => animate_css_option(),
            'after' => '<div class="col-md-4"><div class="form-group group">', 'before' => '</div></div>'
        ], $value[$i]['animate']);
        $output .= $Form->html();
        $output .= '</div>';
    }
    return $output;
}