<?php
class widget_menu_tags extends widget {
    function __construct() {
        parent::__construct('widget_menu_tags', 'Menu Tags', [ 'container' => true, 'position' => 'right' ]);
        add_action('theme_custom_css', array( $this, 'css'), 10);
    }
    function form( $left = [], $right = []) {
        $left[] = ['field' => 'menuID', 'label' => 'Menu', 'type' => 'menu'];
        parent::form($left, $right);
    }
    function widget() {
        $box = $this->container_box('widget_menu_tags');
        $menus = ThemeMenu::getData($this->options->menuID);
        echo $box['before'];
        ?>
        <div class="row menu_tags_box">
            <div class="menu_tags_title">
                <?php ThemeWidget::heading($this->name, (isset($this->options->heading)) ? $this->options->heading : [], '.js_'.$this->key.'_'.$this->id);?>
            </div>
            <div class="menu_tags_list">
                <ul>
                    <?php foreach ($menus as $menu) { ?>
                        <li><a href="<?php echo Url::permalink($menu->slug);?>"><?php echo $menu->name;?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php
        echo $box['after'];
    }
    function css() {
        ?>
        <style>
            .menu_tags_box .header-title {
                margin: 0;
            }
            .menu_tags_box .header-title .header {
                color:#fff; margin: 0; text-align: left;
            }
            .menu_tags_title {
                float: left; width: 180px;
                text-align: left;
                display: flex;
                justify-content: center;
                flex-direction: column;
                height: 55px;
            }
            .menu_tags_list {
                float: left; width: calc(100% - 180px);
                text-align: left;
                display: flex;
                justify-content: center;
                flex-direction: column;
                height: 55px;
            }
            .menu_tags_box ul {
                list-style: none; margin-bottom: 0;
                display: flex;
                overflow-x: auto;
                -ms-scroll-snap-type: x proximity;
                scroll-snap-type: x proximity;
                gap: 1rem;
            }
            .menu_tags_box ul li {
                display: inline-block;
                scroll-snap-stop: normal;
                scroll-snap-align: start;
                flex: 0 0 auto;
            }
            .menu_tags_box ul li a {
                display: block; padding:5px 30px; border-radius: 20px;
                background-color: #fff;
                color:#000;
                transition: background-color 0.5s;
            }
            .menu_tags_box ul li a:hover {
                background-color: var(--theme-color);
                color:#fff;
            }

            @media (max-width: 768px) {
                .menu_tags_title {
                    width: 100px; padding-left: 10px;
                }
                .menu_tags_list {
                    width: calc(100% - 100px);
                }
                .menu_tags_box .header-title .header {
                    font-size: 13px;
                }
            }
        </style>
        <?php
    }
}
Widget::add('widget_menu_tags');