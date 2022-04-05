$(function(){
    $('.widget_feedback_style_8 .owl-carousel').each(function () {
        let id = $(this).data('id');
        let speed = parseInt($(this).data('speed'));
        let timeout = (speed+parseInt($(this).data('time')))*1000;
        let config = {
            items 				:1,
            margin				:30,
            nav                 :false,
            dot                 :false,
            autoplayTimeout		:timeout,
            autoplaySpeed 		:speed*1000,
            loop				:true, autoplay:true, autoplayHoverPause:true,
            responsive 			:{ 0:{ items:1 },  500:{ items:1 },  1000:{ items:1 } }
        };
        let ol = $("#feedback_list_"+id).owlCarousel(config);
        $('#feedback_list_'+id+' .owl-prev').html(`<span class="eltdf-prev-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45.479px" height="15.292px" viewBox="0 4.375 45.479 15.292" enable-background="new 0 4.375 45.479 15.292" xml:space="preserve"><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" x1="44.639" y1="12" x2="0.639" y2="12"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" x1="0.639" y1="12" x2="44.639" y2="12"></line><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" points="7.639,19 0.639,12 7.639,5 "></polyline></svg></span>`);
        $('#feedback_list_'+id+' .owl-next').html(`<span class="eltdf-next-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45.479px" height="15.292px" viewBox="0 4.375 45.479 15.292" enable-background="new 0 4.375 45.479 15.292" xml:space="preserve"><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" x1="0.639" y1="12" x2="44.639" y2="12"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" x1="0.639" y1="12" x2="44.639" y2="12"></line><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" points="37.639,5 44.639,12 37.639,19 "></polyline></svg></span>`);
    });
});