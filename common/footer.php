<!--<?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?>-->

<footer>
    <h3 class="sr-only sr-only-focusable">Boston College footer</h3>
    <div id="bc-footer">
        <div class="container">
            <div class="row">
                <div class="bc-img col-md-3 col-sm-12 col-xs-12">
                    <a href="https://www.bc.edu/content/bc-web.html"><img src="https://www.bc.edu/etc/designs/bc-web/images/logo-footer.png" class="footer-logo" alt="Boston College"></a>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <nav class="bc-links">
                        <ul>
                            <li><a href="https://www.bc.edu/sites/accessibility.html">Accessibility</a></li>
                            <li><a href="https://www.bc.edu/bc-web/resources/emergency-r.html">Emergency</a></li>
                            <li><a href="https://www.bc.edu/bc-web/about/maps-and-directions.html">Maps</a></li>
                            <li><a href="https://www.bc.edu/bc-web/resources/directories-r.html">Directories</a></li>
                            <li><a href="https://www.bc.edu/a-z/directories/contact.html">Contact</a></li>
                        </ul>
                    </nav>
                    <p class="copyright">Copyright &copy; 2017 Trustees of Boston College</p>
                </div>
            </div>
        </div>
    </div>

    <?php fire_plugin_hook('public_footer', ['view' => $this]); ?>
</footer>

</body>
</html>

