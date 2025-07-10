$(function(){
    const $slider = $('#slider');

    // Step 1: Save the original slider HTML *before* initializing
    const originalHtml = $slider.html();
    $slider.data('originalHtml', originalHtml);

    $('.header-name').on('mouseenter', function () {
        const slideIndex = $('.header-name').index(this);

        // Step 3a: Stop and wipe the current slider
        $('#slider').data('nivo:vars', null);
        $('#slider').remove(); // remove the slider div completely

        // Step 3b: Re-insert the original slider HTML
        const newSlider = $('<div id="slider" class="nivoSlider"></div>').html(originalHtml);
        $('.main-slider').html(newSlider); // insert it into the DOM

        // Step 3c: Re-initialize with desired startSlide
        $('#slider').nivoSlider({
            startSlide: slideIndex,
            prevText: '',
            nextText: ''
        });
    });
});
