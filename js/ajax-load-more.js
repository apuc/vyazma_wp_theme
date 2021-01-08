jQuery(function ($) {

    // AJAX загрузка страниц/записей WP
    $('.btn-loadmore').on('click', function () {
        let _this = $(this);
        _this.html('<i class="fas fa-redo fa-spin"></i> Загрузка...'); // изменение кнопки

        let data = {
            'action': 'loadmore',
            'query': _this.attr('data-param-posts'),
            'page': this_page,
            'tpl': _this.attr('data-tpl')
        }

        console.log(this_page);

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: data,
            type: 'POST',
            success: function (data) {
                if (data) {
                    _this.html('<i class="fas fa-redo"></i> Загрузить ещё');
                    _this.prev().prev().append(data); // где вставить данные
                    this_page++; // увелич. номер страницы +1
                    if (this_page == _this.attr('data-max-pages')) {
                        _this.remove();               // удаляем кнопку, если последняя стр.
                    }
                } else {                              // если закончились посты
                    _this.remove();                   // удаляем кнопку
                }
            }
        });
    });

    $('.btn-setmainid').on('click', function (e) {
        e.preventDefault();
        let _this = $(this);

        let data = {
            'action': 'setmainid',
            'id': _this.attr('data-main-id')
        }

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: data,
            type: 'POST',
            success: function (res) {
                console.log(res);
            }
        });
    });

});
