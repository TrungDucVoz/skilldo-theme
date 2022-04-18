$(function () {
    let widgetLoad = [], categoryId, widgetId, data_item = [];

    if('IntersectionObserver' in window) {
        let productListWidget = document.querySelectorAll('.js_product_style_13_data');
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    let id = entry.target.getAttribute('data-id');
                    if (typeof widgetLoad[id] == 'undefined') {
                        widgetLoad[id] = id;
                        product_style_13_slider_load(entry.target.getAttribute('data-category'), entry.target.getAttribute('data-id'), JSON.parse(entry.target.getAttribute('data-options')));
                    }
                }
            });
        });
        productListWidget.forEach(widget => {
            observer.observe(widget)
        });
    }
    else {
        $('.widget_product_style_13 .js_product_style_13_data').each(function () {
            let options = $(this).data('options');
            product_style_13_slider_load($(this).data('category'), $(this).data('id'), options);
        });
    }

    $(document).on('click touch', '.product_style_13_header .product_style_13_category_list li.item a', function() {
        categoryId = $(this).attr('data-id');
        widgetId 	= $(this).attr('data-wg');
        $('#product_style_13_header_' + widgetId +' .product_style_13_category_list li.item a').removeClass('active');
        $(this).addClass('active');
        product_style_13_slider_load(categoryId, widgetId, $('#product_style_13_header_'+widgetId).data('options'));
        return false;
    });

    $('.product_style_13_header .js_btn_show_tab').click(function() {
        $(this).closest('.product_style_13_header_left').find('.product_style_13_category_list').toggle();
        return false;
    });

    function product_style_13_slider(id, options) {
        if(options.display.type === 1) return false;
        let productList     = $('#product_style_13_content_' + id + ' .list-product');
        let productBtnNext  = $('#product_style_13_header_' + id + ' .next');
        let productBtnPrev  = $('#product_style_13_header_' + id + ' .prev');
        let config = {
            infinite: true,
            dots:false,
            autoplay: true,
            autoplaySpeed: parseInt(options.display.time)*1000,
            speed: parseFloat(options.display.speed)*1000,
            slidesToShow: parseInt(options.per_row),
            slidesToScroll: parseInt(options.per_row),
            responsive: [
                { breakpoint: 1000, settings: { slidesToShow: parseInt(options.per_row_tablet), slidesToScroll: parseInt(options.per_row_tablet), } },
                { breakpoint: 600, settings: { slidesToShow: parseInt(options.per_row_mobile), slidesToScroll: parseInt(options.per_row_mobile), } }
            ]
        };
        productList.slick(config);
        productBtnNext.click(function() {productList.slick('slickNext');return false;});
        productBtnPrev.click(function() {productList.slick('slickPrev');return false;});
        $('#product_style_13_header_'+ id).attr('data-run', true);
    }

    function product_style_13_slider_load(categoryId, widgetId, options) {

        let productBox = $('#product_style_13_content_' + widgetId);

        let productList = productBox.find('.list-product');

        let productLink = productBox.find('a.more-link');

        let loading     = productBox.find('.wg-loading');

        let runSlick = $('#product_style_13_header_'+ widgetId).attr('data-run');

        options.display.type = parseInt(options.display.type);

        if(options.display.type !== 1 && runSlick == 'true') {
            productList.slick('unslick');
        }

        productList.html('');

        loading.show();

        if (typeof data_item[widgetId] == 'undefined') data_item[widgetId] = [];

        if (typeof data_item[widgetId][categoryId] != 'undefined') {
            productList.html(data_item[widgetId][categoryId].item);
            productLink.attr('href', data_item[widgetId][categoryId].url);
            loading.hide();
            product_style_13_slider(widgetId, options);
            return false;
        }
        else {
            let data = {
                action  : 'widget_product_style_13::loadProduct',
                widgetId   : widgetId,
                categoryId : categoryId,
            };
            $.post( ajax , data, function() {}, 'json').done(function(response) {
                loading.hide();
                if(response.status === 'success') {
                    console.log(response);
                    productList.html(response.item);
                    productLink.attr('href', response.slug);
                    data_item[widgetId][categoryId] = {
                        item : response.item,
                        url  : response.slug
                    };
                    product_style_13_slider(widgetId, options);
                }
            });
        }
    }
});