    <script src="<?php echo ASSETS; ?>js/jquery-2.1.4.min.js"></script>

    <script src="<?php echo ASSETS; ?>js/mfn.menu.js"></script>
    <script src="<?php echo ASSETS; ?>js/jquery.plugins.js"></script>
    <script src="<?php echo ASSETS; ?>js/jquery.jplayer.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/animations/animations.js"></script>
    <script src="<?php echo ASSETS; ?>js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/bootstrap/bootstrap.js"></script>

    <script>
        jQuery(window).load(function() {
            var retina = window.devicePixelRatio > 1 ? true : false;
            if (retina) {
                var retinaEl = jQuery("#logo img");
                var retinaLogoW = retinaEl.width();
                var retinaLogoH = retinaEl.height();
                retinaEl.attr("src", "<?php echo ASSETS; ?>images/retina-book.png").width(retinaLogoW).height(retinaLogoH)
            }
        });
    </script>