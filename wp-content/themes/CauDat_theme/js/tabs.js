var itemTabsContent = jQuery('.partner__content');
var navigationTarget = jQuery('.partner__nav li a');

jQuery('.partner__content').css("display", "none");


itemTabsContent.css("display", "none");

navigationTarget.each((index, elemt) => {
    var elemtTarget = jQuery(elemt);
    var anchorSection = jQuery(elemt).attr("data-target");


    itemTabsContent.each((index, elmt) => {
        var contentElement = jQuery(elmt);
        var contentId = contentElement.attr("data-anchor");

        if (elemtTarget.hasClass('active')) {
            anchorSection = jQuery(elemt).attr("data-target");
            if (anchorSection == contentId) {
                contentElement.css("display", "block");
            }
        }
    });

    // CLICK ACTIVE TABS
    elemtTarget.on('click', function (e) {
        e.preventDefault();
        
        // const url = location.href + '?partner=' + anchorSection;
        const url = new URL(window.location.href);
        url.searchParams.set('partner', anchorSection);
        window.history.replaceState(null, null, url);

        jQuery(this).closest('.partner__nav').find('li a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery(this).closest('.partner').find('.partner__content').css('display', 'none');

        itemTabsContent.each((index, elmt) => {
            var contentElement = jQuery(elmt);
            var contentId = contentElement.attr("data-anchor");

            if (anchorSection == contentId) {
                contentElement.css("display", "block");
            }
        });

        setCurrentLabel ();
    })
});


function setCurrentLabel () {
    var currentLabel = jQuery('.partner__nav li a.active').text();
    jQuery('.current-label').html(currentLabel);
}

jQuery('.current-label').click(function () {
    jQuery('.partner__nav').toggleClass('partner__nav--open');
})

//setCurrentLabel ();


// tabs form page my account

var activeTab = jQuery('.tabs-form-account li a.active').attr('href');
jQuery(activeTab).fadeIn();

jQuery('.tabs-form-account li a').click(function (e) {
    e.preventDefault();

    jQuery('.tabs-form-account li a').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('.form-page-account').hide();

    var activeTab = jQuery(this).attr('href');
    jQuery(activeTab).fadeIn();

});