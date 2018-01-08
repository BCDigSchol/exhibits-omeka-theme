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
    if (isset($exhibit_title)) {
        $titleParts[] = strip_formatting($exhibit_title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Will fire plugins that need to include their own files in <head> -->
    <?php fire_plugin_hook('public_head', ['view' => $this]); ?>


    <!-- Need to add custom and third-party CSS files? Include them here -->
    <?php
    queue_css_url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700');
    queue_css_url('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700');
    queue_css_file('style');
    echo head_css();
    ?>

    <!-- Need more JavaScript files? Include them here -->
    <?php
    queue_js_url('https://code.jquery.com/jquery-3.2.1.slim.min.js');
    queue_js_file('lib/bootstrap.min');
    queue_js_file('globals');
    echo head_js(false);
    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php echo body_tag(['id' => @$bodyid, 'class' => @$bodyclass]); ?>
<?php fire_plugin_hook('public_body', ['view' => $this]); ?>
<?php include __DIR__ . '/bclib_header.html'; ?>
<header>
    <div class="container">
        <div class="row">
            <?php fire_plugin_hook('public_header', ['view' => $this]); ?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1><?php echo link_to_home_page(theme_logo()); ?></h1>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo BC\public_nav_main_bootstrap(); ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>

    </div>

</header>
<?php fire_plugin_hook('public_content_top', ['view' => $this]); ?>
