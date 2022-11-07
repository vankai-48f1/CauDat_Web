var itemTabsContent = jQuery('.partner__content');
var navigationTarget = jQuery('.partner__nav li a');

var url = new URL(window.location.href);
var valueUrl = url.searchParams.get('partner');

// visible tab in param url
itemTabsContent.css("display", "none");
jQuery('.partner__content[data-anchor=' + valueUrl + ']').css('display', 'block');

// CLICK ACTIVE TABS
jQuery('.partner__nav li a').on('click', function (e) {
    e.preventDefault();
    var valueTarget = jQuery(this).attr("data-target");

    // const url = location.href + '?partner=' + anchorSection;
    const url = new URL(window.location.href);
    url.searchParams.set('partner', valueTarget);
    window.history.replaceState(null, null, url);

    jQuery(this).closest('.partner__nav').find('li a').removeClass('active');
    jQuery(this).addClass('active');
    jQuery(this).closest('.partner').find('.partner__content').css('display', 'none');

    jQuery('.partner__content[data-anchor=' + valueTarget + ']').css('display', 'block');

    setCurrentLabel();
})



function setCurrentLabel() {
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