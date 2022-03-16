$(function () {
    let widgetLoad = [], tabId, widgetId, data_item = [];

    if('IntersectionObserver' in window) {
        let productListWidget = document.querySelectorAll('.js_product_style_16_data');
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    let id = entry.target.getAttribute('data-id');
                    if (typeof widgetLoad[id] == 'undefined') {
                        widgetLoad[id] = id;
                        product_style_16_slider_load(entry.target.getAttribute('data-tab'), entry.target.getAttribute('data-id'), JSON.parse(entry.target.getAttribute('data-options')));
                    }
                }
            });
        });
        productListWidget.forEach(widget => {
            observer.observe(widget)
        });
    }
    else {
        $('.widget_product_style_16 .js_product_style_16_data').each(function () {
            let options = $(this).data('options');
            product_style_16_slider_load($(this).data('tab'), $(this).data('id'), options);
        });
    }

    $(document).on('click touch', '.product_style_16_header .product_style_16_category_list li.item a', function() {
        tabId = $(this).attr('data-tab');
        widgetId = $(this).closest('.js_product_style_16_data').attr('data-id');
        $('#product_style_16_header_' + widgetId +' .product_style_16_category_list li.item a').removeClass('active');
        $(this).closest('.js_product_style_16_data').attr('data-tab', tabId);
        $(this).addClass('active');
        product_style_16_slider_load(tabId, widgetId, $(this).closest('.product_style_16_header').data('options'));
        return false;
    });

    function product_style_16_slider(id, options) {
        if(options.display.type === 1) return false;
        let productList     = $('#product_style_16_content_' + id + ' .list-product');
        let productBtnNext  = $('#product_style_16_content_' + id + ' .next');
        let productBtnPrev  = $('#product_style_16_content_' + id + ' .prev');
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
        $('#product_style_16_header_'+ id).attr('data-run', true);
    }

    function product_style_16_slider_load(tabId, widgetId, options) {

        let productBox = $('.js_widget_product_style_16_' + widgetId);

        let productList = productBox.find('.list-product');

        let productLink = productBox.find('a.more-link');

        let loading     = productBox.find('.wg-loading');

        let runSlick = $('#product_style_16_header_'+ widgetId).attr('data-run');

        options.display.type = parseInt(options.display.type);

        if(options.display.type !== 1 && runSlick == 'true') {
            productList.slick('unslick');
        }

        productList.html('');

        loading.show();

        if (typeof data_item[widgetId] == 'undefined') data_item[widgetId] = [];

        if (typeof data_item[widgetId][tabId] != 'undefined') {
            productList.html(data_item[widgetId][tabId].item);
            productLink.attr('href', data_item[widgetId][tabId].url);
            loading.hide();
            product_style_16_slider(widgetId, options);
            return false;
        }
        else {
            let data = {
                action  : 'widget_product_style_16::loadProduct',
                widgetId   : widgetId,
                tabId : tabId,
            };
            $.post( ajax , data, function() {}, 'json').done(function(response) {
                loading.hide();
                if(response.status === 'success') {
                    productList.html(response.item);
                    productLink.attr('href', response.slug);
                    data_item[widgetId][tabId] = {
                        item : response.item,
                        url  : response.slug
                    };
                    product_style_16_slider(widgetId, options);
                }
            });
        }
    }
});