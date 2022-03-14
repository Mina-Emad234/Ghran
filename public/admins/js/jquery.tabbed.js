/*
 * Tabbed jQuery Plugin
 * http://nathansearles.com/tabbed/
 *
 * Copyright (c) 2010 Nathan Searles
 * Dual licensed under the MIT and GPL licenses.
 * Uses the same license as jQuery, see:
 * http://docs.jquery.com/License
 *
 * @version 0.2
 */
if(typeof jQuery != "undefined") {
    jQuery(function($) {
        $.fn.extend({
            tabbed: function(options) {
                var settings = $.extend({}, $.fn.tabbed.defaults, options);
                return this.each(
                    function() {
                        if($.fn.jquery < "2.3.2") {
                            return;
                        }
                        var $t = $(this);
                        var o = $.metadata ? $.extend({}, settings, $t.metadata()) : settings;
//			var tabs = $t.find("> ul li"); // OLD: By the developer
                        var tabs = "."+o.tabs+" li"; // EDIT: My fix
                        var tabcontent = "."+o.tabcontent;
                        var activeTab = 0, height = 0;
                        $(tabcontent,$t).hide();
                        $(tabcontent,$t).css({
                            "position":"absolute"
                        }); // NEW: After hide all .tabContent set "position" to "absolute" to serve fadeOut/FadeIn Effects
//                      $(tabcontent,$t).css({"width":$(tabcontent,$t).parent().width()+"px"}); // NEW: Because of position: absolute; set the width: to its parent width
                        $(tabcontent,$t).parent().css({
                            "position":"relative"
                        }); // NEW: Because of position: absolute; set the width: to its parent width
                        $("li:first",$t).addClass("active");
                        $(tabcontent+":first",$t).parent().css({
                            "height":$(tabcontent+":first",$t).outerHeight()
                            });// NEW: Set .tabContent parent height because of position:absolute
                        $(tabcontent+":first",$t).show();

                        $(tabs,$t).bind("click",function() {
                            if ($(this).hasClass("active")) {
                                return false;
                            }
                            $(tabs,$t).removeClass("active");
                            $(this,$t).addClass("active");
                            //							$(tabcontent,$t).hide(); // OLD: By the developer
                            $(tabcontent,$t).fadeOut(o.fadeOutSpeed); // EDIT: Hide by fadeOut
                            activeTab = $(this,$t).find("a").attr("href");
                            $(activeTab,$t).fadeIn(o.fadInSpeed,function(){
                                removeFilter(this)
                                }); //EDIT: New variable "fadeInSpeed"
                            height = $(activeTab,$t).outerHeight();
                            $(activeTab,$t).parent().css({
                                "height":height
                            });
                            return false;
                        });
                    }
                    );
            }
        });
        $.fn.tabbed.defaults = {
            tabs: "tabs", // NEW: class of tabs ul
            tabcontent: "tabcontent", // class of tab content
            fadInSpeed: 700, // EDIT: speed of fadeIn
            fadOutSpeed: 700 // NEW: speed of fadeOut
        };
    });
    function removeFilter(element) {
        /* Fix for IE crap */
        if(element.style.removeAttribute){
            element.style.removeAttribute('filter');
        }
    }
}
