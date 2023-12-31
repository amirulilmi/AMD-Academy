$(document).ready(function () {
  $("#online").off("click");
  $("#online").click(function (e) {
    e.preventDefault();
    $("#online").addClass("border-black border-b-2 ");
    $("#offline").removeClass("border-black border-b-2 ");
  });

  $("#offline").off("click");
  $("#offline").click(function (e) {
    e.preventDefault();
    $("#offline").addClass("border-b-2 border-black");
    $("#online").removeClass("border-b-2 border-black");
  });

  $("#showHide").off("click");
  $("#showHide").click(function (e) {
    e.preventDefault();
    $("#content").fadeToggle(500);
    if ($("#cb").prop("checked")) {
      $("#cb").prop("checked", false);
      $("#showHide").html("Show More");
    } else {
      $("#showHide").html("Show Less");
      $("#cb").prop("checked", true);
    }
  });

  $(".card-slider").slick({
    dots: false,
    infinite: false,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    touchmove: false,
    autoplay: false,
    autoplaySpeed: 2000,
    arrows: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          prevArrow:
            '<span class="priv_arrow rotate-180"><svg class="p-4 w-full h-full" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.26396 0.652144C1.13521 0.780635 1.03306 0.933258 0.96336 1.10128C0.893663 1.2693 0.857788 1.44941 0.857788 1.63131C0.857788 1.81321 0.893663 1.99333 0.96336 2.16134C1.03306 2.32936 1.13521 2.48199 1.26396 2.61048L6.65285 7.99937L1.26396 13.3883C1.00427 13.6479 0.858376 14.0002 0.858376 14.3674C0.858376 14.7347 1.00427 15.0869 1.26396 15.3466C1.52365 15.6063 1.87587 15.7522 2.24313 15.7522C2.61039 15.7522 2.9626 15.6063 3.22229 15.3466L9.59729 8.97159C9.72605 8.8431 9.8282 8.69047 9.8979 8.52246C9.96759 8.35444 10.0035 8.17432 10.0035 7.99242C10.0035 7.81052 9.96759 7.63041 9.8979 7.46239C9.8282 7.29437 9.72605 7.14175 9.59729 7.01326L3.22229 0.638255C2.69452 0.110477 1.80563 0.110477 1.26396 0.652144Z" fill="white"/></svg></span>',
          nextArrow:
            '<span class="next_arrow "><svg class="p-4 w-full h-full" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.26396 0.652144C1.13521 0.780635 1.03306 0.933258 0.96336 1.10128C0.893663 1.2693 0.857788 1.44941 0.857788 1.63131C0.857788 1.81321 0.893663 1.99333 0.96336 2.16134C1.03306 2.32936 1.13521 2.48199 1.26396 2.61048L6.65285 7.99937L1.26396 13.3883C1.00427 13.6479 0.858376 14.0002 0.858376 14.3674C0.858376 14.7347 1.00427 15.0869 1.26396 15.3466C1.52365 15.6063 1.87587 15.7522 2.24313 15.7522C2.61039 15.7522 2.9626 15.6063 3.22229 15.3466L9.59729 8.97159C9.72605 8.8431 9.8282 8.69047 9.8979 8.52246C9.96759 8.35444 10.0035 8.17432 10.0035 7.99242C10.0035 7.81052 9.96759 7.63041 9.8979 7.46239C9.8282 7.29437 9.72605 7.14175 9.59729 7.01326L3.22229 0.638255C2.69452 0.110477 1.80563 0.110477 1.26396 0.652144Z" fill="white"/></svg></span>',
        },
      },
    ],
  });

  $(".slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    focusOnSelect: false,
    // asNavFor: '.slider-nav'
  });

  $("a[data-slide]").off("click");
  $("a[data-slide]").click(function (e) {
    e.preventDefault();
    var slideno = $(this).data("slide");
    $(".slider-for").slick("slickGoTo", slideno - 1);
  });
});
