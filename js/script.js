$(function() {

    $(window).scroll(function() {
        if ($(window).scrollTop() >= 30) {
            $("header").addClass("fixed");
            $("body").addClass("fixed");
        } else {
            $("header").removeClass("fixed");
            $("body").removeClass("fixed");
        }
    });

    var windowWidth = $(window).width();

    $('.banner_list').mousemove(function(event){
      var moveX = (($(window).width() / 2) - event.pageX) * 0.02;
      var moveY = (($(window).height() / 2) - event.pageY) * 0.02;

      $('.banner_list .banner_img .bannercircleicon1, .banner_list .banner_img .bannercircleicon2, .banner_list .banner_img .bannercircleicon3, .banner_list .banner_img .bannercircleicon4, .banner_list .banner_img .bannercircleicon5, .banner_list .banner_img .bannercircleicon6').css('margin-right', moveX + 'px');

      $('.banner_list .banner_img .bannercircleicon1, .banner_list .banner_img .bannercircleicon2, .banner_list .banner_img .bannercircleicon3, .banner_list .banner_img .bannercircleicon4, .banner_list .banner_img .bannercircleicon5, .banner_list .banner_img .bannercircleicon6').css('margin-top', moveY + 'px');

      $('.banner_list .banner_img .bannerplusicon1, .banner_list .banner_img .bannerplusicon2, .banner_list .banner_img .bannerplusicon3, .banner_list .banner_img .bannerplusicon4, .banner_list .banner_img .bannerplusicon5, .banner_list .banner_img .bannerplusicon6').css('margin-right', -moveX + 'px');

      $('.banner_list .banner_img .bannerplusicon1, .banner_list .banner_img .bannerplusicon2, .banner_list .banner_img .bannerplusicon3, .banner_list .banner_img .bannerplusicon4, .banner_list .banner_img .bannerplusicon5, .banner_list .banner_img .bannerplusicon6').css('margin-top', -moveY + 'px');
    });

    $(document).on('click', '.navopen_icon', function(event) {
        // event.preventDefault();
        $(".nav_info").slideToggle();
    });


    $(".input-field input,.input-field textarea").focus(function() {
        $(this).parent().addClass("is-active is-completed");
    });

    $(".input-field input,.input-field textarea").focusout(function() {
        if ($(this).val() === "")
            $(this).parent().removeClass("is-completed");
        $(this).parent().removeClass("is-active");
    });

    $(".trustus_direct_list ul li .trustus_direct_listinner").hover(function() {
        $(this).parents(".trustus_direct_list").find("ul li").removeClass('active');
    }, function() {
        $(this).parents(".trustus_direct_list").find("ul li:first-child").addClass('active');
    });

    $(".theideasolution_info ul li .theideasolution_listview").hover(function() {
        $(this).parents(".theideasolution_info").find("ul li").removeClass('active');
    }, function() {
        $(this).parents(".theideasolution_info").find("ul li:first-child").addClass('active');
    });

    $(".creatingopportunities_list .creatingopportunities_listview .creatingopportunities_listinner").hover(function() {
        $(this).parents(".creatingopportunities_list").find(".swiper-container .swiper-wrapper .swiper-slide .creatingopportunities_listinner").removeClass('active');
    }, function() {
        $(this).parents(".creatingopportunities_list").find(".swiper-container .swiper-wrapper .swiper-slide:first-child .creatingopportunities_listinner").addClass('active');
    });


    $(".careertheideasolution_info ul li .theideasolution_listview").hover(function() {
        $(this).parents(".careertheideasolution_info").find("li").removeClass('active');
    }, function() {
        $(this).parents(".careertheideasolution_info").find("li:first-child").addClass('active');
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $(".ourteam_details").hide();
            $(".topmanagement_details").hide();
            $('.ourteam_slider').slick('slickPlay');
            $("body").removeClass('popupoverlay');
        }
    });

    function animation(){
        var target = 0 - parseInt($('.aboutus_section_txt .banner_txtbg').width()) / 8;
        $('.aboutus_section_txt .banner_txtbg').stop().animate({"margin-top": target}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target2 = 0 - parseInt($('.banner_list .banner_img .banner_locationicon').width()) / 8;
        $('.banner_list .banner_img .banner_locationicon').stop().animate({"margin-top": target2}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target3 = 0 - parseInt($('.freshproducesupply_info .freshproducesupply_inner .freshproducesupply_bg').width()) / 8;
        $('.freshproducesupply_info .freshproducesupply_inner .freshproducesupply_bg').stop().animate({"margin-top": target3}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target3 = 0 - parseInt($('.creatingopportunities_info .creatingopportunities_bg').width()) / 8;
        $('.creatingopportunities_info .creatingopportunities_bg').stop().animate({"margin-top": target3}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target4 = 0 - parseInt($('.puttheirfaith_info .puttheirfaith_bg').width()) / 8;
        $('.puttheirfaith_info .puttheirfaith_bg').stop().animate({"margin-top": target4}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target5 = 0 - parseInt($('.theinceptionjourney_info .theinceptionjourney_bg').width()) / 8;
        $('.theinceptionjourney_info .theinceptionjourney_bg').stop().animate({"margin-top": target5}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target6 = 0 - parseInt($('.ourstandpoint_info .freshproducesupply_inner .freshproducesupply_bg').width()) / 8;
        $('.ourstandpoint_info .freshproducesupply_inner .freshproducesupply_bg').stop().animate({"margin-top": target6}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target7 = 0 - parseInt($('.careerbanner_info .careerbanner_cont .careerbanner_bg').width()) / 8;
        $('.careerbanner_info .careerbanner_cont .careerbanner_bg').stop().animate({"margin-top": target7}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

        var target8 = 0 - parseInt($('.topmanagement_info .topmanagement_bg').width()) / 8;
        $('.topmanagement_info .topmanagement_bg').stop().animate({"margin-top": target8}, 1000, function(){
            $(this).animate({"margin-top": 0}, 1000, function(){
                animation();
            });
        });

    }
    
    animation();

    
    wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // default
        offset: 0, // default
        mobile: false, // default
        live: true // default
    })
    wow.init();

});