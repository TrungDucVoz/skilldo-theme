$(function () {
    let widgetLoad = [], categoryId, widgetId, data_item = [];
    if('IntersectionObserver' in window) {
        let productListWidget = document.querySelectorAll('.js_product_style_11_data');
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    let id = entry.target.getAttribute('data-id');
                    if (typeof widgetLoad[id] == 'undefined') {
                        widgetLoad[id] = id;
                        product_style_11_slider_load(entry.target.getAttribute('data-category1'), entry.target.getAttribute('data-category2'), entry.target.getAttribute('data-id'), JSON.parse(entry.target.getAttribute('data-options')));
                    }
                }
            });
        });
        productListWidget.forEach(widget => {
            observer.observe(widget)
        });
    }
    else {
        $('.widget_product_style_11 .js_product_style_11_data').each(function () {
            let options = $(this).data('options');
            product_style_11_slider_load($(this).data('category1'), $(this).data('category2'), $(this).data('id'), options);
        });
    }
    function product_style_11_slider(id, box, options) {
        if(options.display.type === 1) return false;
        let productList     = $('#product_style_11_content_' + id + ' ' + box +' .list-product');
        let productBtnNext  = $('#product_style_11_content_' + id + ' ' + box +' .next');
        let productBtnPrev  = $('#product_style_11_content_' + id + ' ' + box +' .prev');
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
        $('#product_style_11_content_'+ id).attr('data-run', true);
    }
    function product_style_11_slider_load(categoryId1, categoryId2, widgetId, options) {
        let productBox = $('.js_widget_product_style_11_' + widgetId);
        let productList1 = productBox.find('.js_product_style_11_box_1 .list-product');
        let productList2 = productBox.find('.js_product_style_11_box_2 .list-product');
        let productLink = productBox.find('a.more-link');
        let loading     = productBox.find('.wg-loading');
        let runSlick = $('#product_style_11_content_'+ widgetId).attr('data-run');
        options.display.type = parseInt(options.display.type);
        if(options.display.type !== 1 && runSlick == 'true') {
            productList.slick('unslick');
        }
        productList1.html('');
        productList2.html('');
        loading.show();
        if (typeof data_item[widgetId] == 'undefined') data_item[widgetId] = [];
        if (typeof data_item[widgetId][categoryId1] != 'undefined') {
            productList1.html(data_item[widgetId][categoryId1].item);
            productLink.attr('href', data_item[widgetId][categoryId1].url);
            loading.hide();
            product_style_11_slider(widgetId, '.js_product_style_11_box_1', options);
            return false;
        }
        else {
            let data = {
                action  : 'widget_product_style_11::loadProduct',
                widgetId   : widgetId,
                categoryId : categoryId1,
            };
            $.post( ajax , data, function() {}, 'json').done(function(response) {
                loading.hide();
                if(response.status === 'success') {
                    productList1.html(response.item);
                    productLink.attr('href', response.slug);
                    data_item[widgetId][categoryId1] = {
                        item : response.item,
                        url  : response.slug
                    };
                    product_style_11_slider(widgetId, '.js_product_style_11_box_1', options);
                }
            });
        }

        if (typeof data_item[widgetId][categoryId2] != 'undefined') {
            productList2.html(data_item[widgetId][categoryId2].item);
            productLink.attr('href', data_item[widgetId][categoryId2].url);
            loading.hide();
            product_style_11_slider(widgetId, '.js_product_style_11_box_2', options);
            return false;
        }
        else {
            let data = {
                action  : 'widget_product_style_11::loadProduct',
                widgetId   : widgetId,
                categoryId : categoryId2,
            };
            $.post( ajax , data, function() {}, 'json').done(function(response) {
                loading.hide();
                if(response.status === 'success') {
                    productList2.html(response.item);
                    productLink.attr('href', response.slug);
                    data_item[widgetId][categoryId2] = {
                        item : response.item,
                        url  : response.slug
                    };
                    product_style_11_slider(widgetId, '.js_product_style_11_box_2', options);
                }
            });
        }
    }
});
