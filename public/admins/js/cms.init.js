jQuery(function($) {
    $("*").easyTooltip(); // Makes every item has "title" attribute displays using tooltip
    $("#tabbed").tabbed(); // Tabs script
    $(".tableSorter").tablesorter({selectorHeaders:'thead th:not(:first)'}); // Sorter table script

    // SlideUp blocks using blind effect.
    $('a.collapse').click(function(){
        var collapsedBlock = $(this).parent().parent().children(".collapsible");
        collapsedBlock.toggle('blind',300)
    });

    // Fade then SlideUp then remove from DOM function.
    $("a.close").click(function(){
        $(this).hide('fast');
        $(this).parent().fadeTo("slow", 0.00, function(){ //fade
            $(this).slideUp("normal", function() { //slide up
            $(this).remove(); //then remove from the DOM
            });
         });
    });
    $(document).ready(function() {

    });
    // Small twick to fix floating bubble of "count"
    $("span.count").parent().css({"position":"relative"});
 // CKeditor
    $(document).ready(function() {

        CKEDITOR.replace( 'textEditor', {
            language: 'ar',
            disallowedContent : 'img{width,height}',
            customConfig: '../ckeditor/config.js',
            uiColor: '#3592E0',
            codeSnippet_theme: 'atelier-dune.light'
        });
        
    });
});
