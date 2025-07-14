jQuery(document).ready(function () {
    var editorIframe = document.getElementById('elementor-preview-iframe');
    editorIframe.onload = function(){
        jQuery(editorIframe).contents()
            .on('click',
                '.elementor-element[data-element_type="container"],' +
                '.elementor-element[data-element_type="container"] .e-con-inner,' +
                '.elementor-element[data-element_type="container"] .elementor-empty-view .elementor-first-add,' +
                '.elementor-motion-effects-layer', function(e){
                    if( !jQuery("body").hasClass('twbb-sg-sidebar-opened') ) {
                        e.stopPropagation();
                        if (e.target === e.currentTarget) {
                            var parentContainer, targetElement;
                            if (jQuery(this).is('[data-element_type="container"]')) {
                                //for cases when the click is on the container itself
                                parentContainer = jQuery(this);
                            } else {
                                //for other cases when the click is on the container's children
                                parentContainer = jQuery(this).parents('.elementor-element[data-element_type="container"]').first();
                            }
                            targetElement = parentContainer.find('li.elementor-editor-element-setting.elementor-editor-element-edit[title="Edit Container"]').first();
                            targetElement.trigger('click');
                            jQuery('.elementor-component-tab.elementor-panel-navigation-tab.elementor-tab-control-style').trigger('click');
                        }
                    }
                }
            );
    };

    let addElementButtonTarget = '.MuiToolbar-root .MuiBox-root .MuiGrid-root:first-child .MuiStack-root:eq(1) .MuiBox-root:first-child button';
    let siteSettingsElementButtonTarget = '.MuiToolbar-root .MuiBox-root .MuiGrid-root:eq(1) .MuiStack-root:eq(1) .MuiBox-root:eq(1) button';
    let documentSettingsElementButtonTarget = '.MuiToolbar-root .MuiBox-root .MuiGrid-root:eq(1) .MuiStack-root .MuiBox-root button';
    //Close section generation when any button in header is clicked
    window.$e.commands.on('run:before', function (component, command, args) {
        if ( 'panel/global/open' === command ) {
            twbb_close_any_animated_sidebars();
        }
    });
    jQuery(document).on('click', siteSettingsElementButtonTarget + ',' + addElementButtonTarget + ',' + documentSettingsElementButtonTarget,function() {
        twbb_close_any_animated_sidebars();
    });
});

function twbb_close_any_animated_sidebars() {
    if (jQuery(document).find('.twbb-sg-sidebar').hasClass('twbb-animated-sidebar-show')) {
        twbb_animate_sidebar('close', jQuery('.twbb-sg-sidebar'), 522, 'twbb-sg-sidebar-opened', twbb_close_section_generation);
    }
    if (jQuery(document).find(".twbb-customize-layout").hasClass('twbb-animated-sidebar-show')) {
        twbb_animate_sidebar('close', jQuery(document).find(".twbb-customize-layout"), 300, 'twbb-customization-sidebar-opened', theme_Customize.close_customization);
    }
    if( jQuery(document).find(".twbb-website-nav-sidebar-main").hasClass('twbb-animated-sidebar-show') ) {
        twbb_animate_sidebar('close', jQuery('.twbb-website-nav-sidebar-main'), 380, 'twbb-website-navigation-sidebar-opened', twbb_closeWebsiteNavigation);
    }
}

function twbbIframeScale(open, tab_width = null) {
    let mode = elementor.channels.deviceMode.request('currentMode');
    if( open ) {
        if( mode !== 'desktop' ){
            twbbIframeScale(0);
            return;
        }
        let elementor_panel = parseInt(jQuery("#elementor-panel").width());
        if( tab_width === null ) {
            tab_width = elementor_panel;
        }
        let windowWidth = jQuery(window).width();
        let iframeWidth = windowWidth - tab_width;
        let scale = 1;
        if( iframeWidth < windowWidth ) {
            scale = iframeWidth / windowWidth;
        }
        jQuery("#elementor-preview").css({
            "min-width": "unset",
            "overflow": "hidden",
            "width": iframeWidth + 'px',
            "position": "absolute",
            "right": 0,
        });
        let height = 100 / scale;
        jQuery('#elementor-preview-iframe').attr( 'style',
            'scale:' + scale + ';transform-origin: 0 0; min-width: ' + windowWidth + 'px; height: ' + height + 'vh;'
        );
    } else {
        jQuery('#elementor-preview-iframe').removeAttr('style');
        jQuery("#elementor-preview").removeAttr("style");
    }
}

function twbb_animate_sidebar(action, sidebar, sidebar_width, body_class, close_callback_function) {
    if (action === 'open') {
        //close any sidebar if open
        twbb_close_any_animated_sidebars();
        jQuery('.MuiButtonBase-root[aria-label="Add Element"]').removeClass('Mui-selected');
        sidebar.removeClass('twbb-animated-sidebar-hide').addClass('twbb-animated-sidebar-show');

        setTimeout(function() {
            let windowWidth = jQuery(window).width();
            let iframeWidth = windowWidth - parseInt(sidebar_width);
            let panel_open = parseInt(jQuery("#elementor-panel").css('margin-inline-start')) >= 0;

            jQuery('body')
                .removeAttr("style")
                .css('--e-editor-panel-width', sidebar_width + 'px')
                .addClass(body_class);
            jQuery(document).find("#elementor-mode-switcher").hide();
            jQuery(document).find(".ui-resizable-handle.ui-resizable-e").hide();

            if( typeof twbb_options.smart_scale_option !== "undefined" && twbb_options.smart_scale_option !== 'inactive' ) {
                twbbIframeScale(1, parseInt(sidebar_width));
                jQuery("#elementor-preview-iframe").css({
                    "width": `${iframeWidth}px`,
                });
            }
            if( panel_open ) {
                jQuery('#elementor-preview-iframe').css({'transform-origin': '0 0','transition': 'width 0.3s ease-in-out'});
            } else {
                jQuery('#elementor-preview-iframe').css({'transform-origin': '0 0','transition': 'width 0.3s ease-in-out'});
            }
            jQuery("#elementor-editor-wrapper").addClass('twbb-animate-sidebar-open');
        }, 100);
    } else if ( action=== 'close' && sidebar.hasClass("twbb-animated-sidebar-show") ) {
        jQuery("#elementor-preview-iframe").removeAttr("style");
        jQuery("#elementor-preview").removeAttr("style");
        jQuery("body").removeAttr("style");
        jQuery(document).find("#elementor-mode-switcher").show();
        jQuery(document).find(".ui-resizable-handle.ui-resizable-e").show();
        jQuery('.MuiButtonBase-root[aria-label="Add Element"]').addClass('Mui-selected');
        if( typeof close_callback_function === "function" ) {
            close_callback_function();
        }
        setTimeout(function() {
            jQuery("#elementor-editor-wrapper").removeClass('twbb-animate-sidebar-open');
        },500);

        /* do not scale when option is deactive */
        if( typeof twbb_options.smart_scale_option !== "undefined" && twbb_options.smart_scale_option !== 'inactive' ) {
            setTimeout(function() {
                twbbIframeScale(1);
            },500);
        }
    }
}

function changeDefaultWidgetSetting(widgetType, settings) {
    if( typeof window.$e != 'undefined' ) {
        window.$e.commands.on('run:before', function (component, command, args) {
            //Change categories widget default settings only for new added widgets, not for existing ones
            if ('preview/drop' === command) {
                if (typeof args.model != "undefined" && typeof args.model.widgetType != "undefined"
                    && args.model.widgetType === widgetType) {
                    args.model.settings = settings;
                }
            }
        });
    }
}

//TODO: this code is not going to stay here, it will be moved to the widget folder
jQuery( window ).on( "load", function() {
    changeDefaultWidgetSetting("twbb_woocommerce-categories",
        {
            'regulate_image_height': 'yes',
            'category_title_position': 'inside',
            'show_button': 'yes',
            'column_gap': {unit: 'px', size: 0, sizes: Array(0)},
            'row_gap': {unit: 'px', size: 0, sizes: Array(0)},
        });
});

jQuery(window).on('elementor:init', function() {
    if (typeof elementor !== 'undefined' && elementor.helpers && typeof elementor.helpers.scrollToView === 'function') {
        // Backup the original scrollToView function
        let originalScrollToView = elementor.helpers.scrollToView;
        // Override the scrollToView function temporarily
        elementor.helpers.scrollToView = function () {
            // Restore the original function after 2 seconds
            setTimeout(function () {
                elementor.helpers.scrollToView = originalScrollToView;
            }, 2000);
        };
    }
});



