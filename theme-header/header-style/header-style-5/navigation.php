<div class="navigation-header">
    <nav class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
            <div class="collapse navbar-collapse" id="navbar-main" data-hover="dropdown" data-animations="fadeInUp fadeInRight fadeInUp fadeInLeft" aria-expanded="true">
                <ul class="nav navbar-nav <?= option::get('nav_position');?>">
                    <?php echo ThemeMenu::render(['theme_location' => 'nav-header', 'walker' => 'store_bootstrap_nav_menu']);?>
                </ul>
            </div>
        </div>
    </nav>
</div>