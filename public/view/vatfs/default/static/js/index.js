/**
 * author : 忆云竹 < http://eyunzhu.com/ >
 * e-mail : support@eyunzhu.com
 * github : https://github.com/eyunzhu/vatfs
 * blog   : http://eyunzhu.com
 * QQ群   : 490993740
 **/
function doSearch(kw){
    window.open("/search?kw="+kw)
}
onLoadSwiper1()
onLoadSwiper11()
function onLoadSwiper1() {
    function setCurrentSlide(ele, index) {
        $(".swiper1 .swiper-slide").removeClass("selected");
        ele.addClass("selected");
    }
    var swiper1 = new Swiper('.swiper1', {
        slidesPerView: 5.5,
        paginationClickable: true, //此参数设置为true时，点击分页器的指示点分页器会控制Swiper切换。
        spaceBetween: 10, //slide之间的距离（单位px）。
        freeMode: true, //默认为false，普通模式：slide滑动时只滑动一格，并自动贴合wrapper，设置为true则变为free模式，slide会根据惯性滑动且不会贴合。
        loop: false, //是否可循环
        onTab: function(swiper) {
            var n = swiper1.clickedIndex;
        }
    });
    if (swiper1.slides) {
        swiper1.slides.each(function(index, val) {
            var ele = $(this);
            ele.on("click", function() {
                setCurrentSlide(ele, index);
                swiper2.slideTo(index, 500, false);
            });
        });
    }
    var swiper2 = new Swiper('.swiper2', {
        direction: 'horizontal', //Slides的滑动方向，可设置水平(horizontal)或垂直(vertical)。
        loop: false,
        autoHeight: true, //自动高度。设置为true时，wrapper和container会随着当前slide的高度而发生变化。
        onSlideChangeEnd: function(swiper) { //回调函数，swiper从一个slide过渡到另一个slide结束时执行。
            var n = swiper.activeIndex;
            setCurrentSlide($(".swiper1 .swiper-slide").eq(n), n);
            swiper1.slideTo(n, 500, false);
        }
    });
}
function onLoadSwiper11() {
    function setCurrentSlide(ele, index) {
        $(".swiper11 .swiper-slide").removeClass("selected");
        ele.addClass("selected");
    }
    var swiper11 = new Swiper('.swiper11', {
        slidesPerView: 5.5,
        paginationClickable: true, //此参数设置为true时，点击分页器的指示点分页器会控制Swiper切换。
        spaceBetween: 10, //slide之间的距离（单位px）。
        freeMode: true, //默认为false，普通模式：slide滑动时只滑动一格，并自动贴合wrapper，设置为true则变为free模式，slide会根据惯性滑动且不会贴合。
        loop: false, //是否可循环
        onTab: function(swiper) {
            var n = swiper11.clickedIndex;
        }
    });
    if (swiper11.slides) {
        swiper11.slides.each(function(index, val) {
            var ele = $(this);
            ele.on("click", function() {
                setCurrentSlide(ele, index);
                swiper22.slideTo(index, 500, false);
            });
        });
    }
    var swiper22 = new Swiper('.swiper22', {
        direction: 'horizontal', //Slides的滑动方向，可设置水平(horizontal)或垂直(vertical)。
        loop: false,
        autoHeight: true, //自动高度。设置为true时，wrapper和container会随着当前slide的高度而发生变化。
        onSlideChangeEnd: function(swiper) { //回调函数，swiper从一个slide过渡到另一个slide结束时执行。
            var n = swiper.activeIndex;
            setCurrentSlide($(".swiper11 .swiper-slide").eq(n), n);
            swiper11.slideTo(n, 500, false);
        }
    });
}