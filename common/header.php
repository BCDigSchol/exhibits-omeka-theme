<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>"/>
    <?php endif; ?>

    <!-- Will build the page <title> -->
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Will fire plugins that need to include their own files in <head> -->
    <?php fire_plugin_hook('public_head', ['view' => $this]); ?>


    <!-- Need to add custom and third-party CSS files? Include them here -->
    <?php
    queue_css_url('https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700');
    queue_css_file('style');
    echo head_css();
    ?>

    <!-- Need more JavaScript files? Include them here -->
    <?php
    queue_js_file('lib/bootstrap.min');
    queue_js_file('globals');
    echo head_js();
    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php echo body_tag(['id' => @$bodyid, 'class' => @$bodyclass]); ?>
<?php fire_plugin_hook('public_body', ['view' => $this]); ?>
<div id="bclib-header" class="hide-search">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-6 col-xxs">
                <a href="https://library.bc.edu" title="Go to Boston College Libraries" class="bclib-header-logo">
                    <img src="https://library.bc.edu/theme/img/title_295x30_transparent_whitetext.png" id="fakebctitle" alt="Boston College Library Logo">
                    <p>Boston College Libraries</p>
                </a>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-6 col-xxs header-right">
                <div class="col-md-7 col-sm-7 col-xs-7 col-xxs link-wrapper">
                    <ul class="bclib-header-links">
                        <li><a href="https://bc.edu">BC Home</a></li>
                        <li><a href="https://www.bc.edu/bc-web/about/mission.html">Mission</a></li>
                        <li>
                            <a href="https://libguides.bc.edu/feedback"><span class="fa fa-commenting-o" aria-hidden="true"></span>
                                Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 col-xxs input-wrapper">
                    <div class="pull-right">
                        <form action="https://www.bc.edu/bc-web/search.html">
                            <div class="input-group" id="bclib-header-form">
                                <label for="bclib-header-search" class="accessibility-text">Search the Library</label>
                                <input type="hidden" ie="UTF-8"/>
                                <input type="text" id="bclib-header-search" class="form-control" name="q" placeholder="Search bc.edu">
                                <span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i><span class="accessibility-text">Submit Search</span></button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<header role="banner">
    <div class="container">
        <?php fire_plugin_hook('public_header', ['view' => $this]); ?>
        <h1 class="site-title text-center"><?php echo link_to_home_page(theme_logo()); ?></h1>
        <h5 class="text-center"><?php echo __('A Sample Omeka Theme'); ?></h5>
    </div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="primary-navigation">
                <?php echo public_nav_main_bootstrap(); ?>

                <form class="navbar-form navbar-right" role="search" action="<?php echo public_url(''); ?>search">
                    <?php echo search_form(['show_advanced' => false]); ?>
                </form>
            </div>
        </div>
    </nav>
</header>
<main id="content" role="main">
    <div class="container">
        <?php fire_plugin_hook('public_content_top', ['view' => $this]); ?>
