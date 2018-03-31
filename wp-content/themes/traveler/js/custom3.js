(function ($) {
    $(document).ready(function () {
        var $window = $(window);
        $('#btn-booking-now').click(function () {
            $("html, body").animate({scrollTop: $('#hotel-room-box').offset().top}, 1000);
        });

        checkWidth();
        $(window).resize(checkWidth);

        function checkWidth() {
            if ($('#hotel-room-box').length) {
                var windowsize = $window.width();
                if (windowsize < 992) {
                    $(window).scroll(function () {
                        if ($(this).scrollTop() > ($('#hotel-room-box').offset().top - ($('#hotel-room-box').height()))) {
                            $('#btn-booking-now').fadeOut();
                        } else {
                            $('#btn-booking-now').fadeIn();
                        }
                    });
                }
            }
        }

        if ($('.mega-menu').length > 0) {
            $('.mega-menu').each(function (e) {
                if ($(this).find('.current-menu-item').length !== 0) {
                    $(this).parent().addClass('current-menu-ancestor');
                }
            })
        }

        /* Contact form author page*/
        $('.author-contact-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);
            var check = true;
            var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            })
            var checkEmail = ValidateEmail(data[2]['value']);
            if (!check || !checkEmail) {
                if (!checkEmail && data[2]['value'] != '') {
                    t.find('input[name="au_email"]').addClass('error');
                    if (data[0]['value'] == '' || data[3]['value'] == '') {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '<br />' + st_checkout_text.email_validate + '</div>');
                    } else {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.email_validate + '</div>');
                    }
                } else {
                    t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
                }
            } else {
                t.find('#author-message').empty();
                t.find('input[type="submit"]').attr('disabled', 'disabled');
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_contact',
                        data: data,
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        } else {
                            t.find('#author-message').html('<div class="alert alert-danger">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }
        })

        function ValidateEmail(mail) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true)
            }
            return (false)
        }

        $('#author-write-review-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);

            //var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            var check = true;
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            });
            if (!check) {
                t.find('#author-wreview-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
            } else {
                var arr_star = [];
                /*t.find("input[name='au_review_star[]']").each(function () {
                    arr_star.push($(this).data('title') + '|' + $(this).val());
                });*/
                var values = $("input[name='au_review_star[]']")
                    .map(function () {
                        return $(this).data('title') + '|' + $(this).val();
                    }).get();

                t.find('#author-wreview-message').empty();
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_write_review',
                        title: t.find('input[name="au_review_title"]').val(),
                        content: t.find('textarea[name="au_review_content"]').val(),
                        user_id: t.find('input[name="user_id"]').val(),
                        partner_id: t.find('input[name="partner_id"]').val(),
                        star: JSON.stringify(values),
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-wreview-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }


        });


        /**
         * Friendly select
         * Nếu focus vào input text kiểm tra sụ kiện
         * Nếu List location mà có length > 0 thì bắt đầu bắt sự kiện dùng phím để select + phím enter
         */
        /*$('#field-rental-locationid').focusin(function(){
            if($('.st-option-wrapper').length > 0){
                console.log('Focus');
                var li = $('.st-option-wrapper .option');
                var liSelected;
                $(window).keydown(function(e){
                    if(e.which === 40){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.next();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                        }
                    }else if(e.which === 38){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.prev();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').last().addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').last().addClass('active');
                        }
                    }

                });
            }

        });
        $("#field-rental-locationid").on('keyup', function (e) {
            if (e.keyCode == 13) {
                console.log('ENTER111');
                $('.option-wrapper').html('').hide();
                $('#field-rental-checkin').focus();
            }
        });*/

    });
})(jQuery)