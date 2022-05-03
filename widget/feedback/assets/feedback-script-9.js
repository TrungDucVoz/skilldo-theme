$(function(){
    $('.widget_feedback_style_9 .swiper').each(function () {
        let id = $(this).data('id');
        let speed = parseInt($(this).data('speed'));
        let timer = parseInt($(this).data('time'));
        const swiper = new Swiper("#feedback_list_"+id, {
            autoplay: {
                delay: timer*1000
            },
            slidesPerView: 2,
            speed:speed*1000,
            loop: true,
            spaceBetween: 30,
            breakpoints : {
                0: {slidesPerView: 1},
                768: {slidesPerView: 2},
            }
        });

        $("#feedback_list_" + id + " .next").click(function () {
            swiper.slideNext();
        });
        $("#feedback_list_" + id + " .prev").click(function () {
            swiper.slidePrev();
        })
    });
});