document.addEventListener("DOMContentLoaded", () => {
    console.log("DOMContentLoaded");
    setTimeout(() =>{
        let slider_settings = $("#slider_settings").val();
        slider_settings = JSON.parse(slider_settings);
        let auto_play_speed =  slider_settings.auto_play_speed;
        let slide_to_display =  slider_settings.slide_to_display;
        let auto_play =  slider_settings.auto_play;
        if(auto_play=='yes'){
            auto_play = true;
        }else{
            auto_play = false;
        }
        $('.story-slideshow').slick({
            dots: true,
            arrows: true,
            prevArrow : $(".slide_previous"),
            nextArrow : $(".slide_next"),
            infinite: true,
            pauseOnHover: true,
            pauseOnFocus: true,
            pauseOnDotsHover: true,
            slidesToShow: slide_to_display,
            speed: 1000,
            fade: false,
            autoplay: auto_play,
            autoplaySpeed: auto_play_speed,
            cssEase: 'linear',
            responsive: [
                {
                breakpoint: 980,
                settings: {
                    arrows: true,
                }
            }
            ]
        });
    },2000);
      
});
