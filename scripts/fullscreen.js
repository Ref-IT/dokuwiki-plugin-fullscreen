var origSizeFullscreen = 300;
function addBtnActionFullscreen($btn, props, edid) {
    $btn.click(function() {
        ep.aceWasEnabled = (jQuery('img.ace-toggle[src*="on"]:visible').length > 0);
        if (ep.aceWasEnabled) {
          jQuery('img.ace-toggle[src*="on"]:visible').click();
        }
        jQuery('.editBox').toggleClass('fullscreen');
        if (jQuery('.editBox').is('.fullscreen')) {
          origSizeFullscreen = jQuery('#wiki__text').height();
          jQuery(window).on('resize.fullscreen', function() {
            jQuery('#wiki__text').css('height', jQuery(window).height() - 60);
            jQuery('.pad-iframecontainer').css('height', jQuery(window).height() - 60);
          });
          jQuery('#wiki__text').css('height', jQuery(window).height() - 60);
          jQuery('.pad-iframecontainer').css('height', jQuery(window).height() - 60);
        } else {
          jQuery(window).off('resize.fullscreen');
          jQuery('#wiki__text').css('height', origSizeFullscreen);
          jQuery('.pad-iframecontainer').css('height', origSizeFullscreen);
        }
        if (ep.aceWasEnabled) {
          jQuery('img.ace-toggle[src*="off"]:visible').click();
        }
        return false;
    });
    return true;
}
