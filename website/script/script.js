searchForm = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
}
window.onscroll = () =>{
    searchForm.classList.remove('active');
    if(window.scrollY > 80){
        document.querySelector('.header .header-2').classList.add('active');
    } else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}
window.onload = () =>{
    if(window.scrollY > 80){
        document.querySelector('.header .header-2').classList.add('active');
    } else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
    fadeOut();
}
function loader(){
    document.querySelector('.loader-container').classList.add('active');
}
function fadeOut(){
    setTimeout(loader,1000);
}
document.addEventListener('DOMContentLoaded', function() {
  document.querySelector('.dropbtn').addEventListener('click', function() {
      document.querySelector('.dropdown-content').classList.toggle('show');
  });
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                  openDropdown.classList.remove('show');
              }
          }
      }
  }
});
var swiper = new Swiper(".book-slider", {
    loop:true,
    centeredslides:true,
    autoplay: {
        delay:1500,
        disableOnInteraction:false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      "@1.00": {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      "@1.50": {
        slidesPerView: 4,
        spaceBetween: 50,
      },
    },
  });
  var swiper = new Swiper(".featured-slider", {
    spaceBetween:10,
    loop:true,
    centeredslides:true,
    autoplay: {
        delay:1500,
        disableOnInteraction:false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      "@1.00": {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      "@1.50": {
        slidesPerView: 4,
        spaceBetween: 50,
      },
    },
  });
  var swiper = new Swiper(".arrivals-slider", {
    spaceBetween:10,
    loop:true,
    centeredslides:true,
    autoplay: {
        delay:2000,
        disableOnInteraction:false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
      },
      "@1.00": {
        slidesPerView: 2,
      },
      "@1.50": {
        slidesPerView: 3,
      },
    },
  });
  var swiper = new Swiper(".reviews-slider", {
    spaceBetween:10,
    grabCursor:true,
    loop:true,
    centeredslides:true,
    autoplay: {
        delay:2000,
        disableOnInteraction:false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
      },
      "@1.00": {
        slidesPerView: 2,
      },
      "@1.50": {
        slidesPerView: 3,
      },
    },
  });
  var swiper = new Swiper(".blog-slider", {
    spaceBetween:10,
    grabCursor:true,
    loop:true,
    centeredslides:true,
    autoplay: {
        delay:2000,
        disableOnInteraction:false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
      },
      "@1.00": {
        slidesPerView: 2,
      },
      "@1.50": {
        slidesPerView: 3,
      },
    },
  });