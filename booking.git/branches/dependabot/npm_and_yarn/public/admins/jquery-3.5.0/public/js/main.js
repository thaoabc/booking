$(function() {
    $(".slide-text--title").textyle({
        duration: 500,
        delay: 200,
        easing: 'linear',
        callback: function() {
            $(this).css({
                transform: 'translateY(0px) rotateY(360deg)'
            });
        }
    });
    $(".slide-text--desc").textyle();
    $(".slide-text--desc2").textyle();
});

// Back to top
// , scrollMenuHide() 
window.onscroll = function() { scrollFunction(), scrollMenuHide() }; 

function scrollFunction() {
    if (window.pageYOffset > 450) {
        document.getElementById("back-to-top").style.display = "block";
    } else {
        document.getElementById("back-to-top").style.display = "none";
    }
};

// document.getElementById("back-to-top").addEventListener("click", backToTop);
// function backToTop() {
//     window.scrollTo(0, 0);
// };

var prevScrollpos = window.pageYOffset;
function scrollMenuHide() {
  var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("navbar").style.top = "0";
    } else {
      document.getElementById("navbar").style.top = "-50px";
    }
    prevScrollpos = currentScrollPos;
}
  

// Scroll Down Navabar Hide
// function scrollMenuHide() {
//   var prevScrollpos = window.pageYOffset;
//   var currentScrollPos = window.pageYOffset;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("navbar").style.top = "0";
//   } else {
//     document.getElementById("navbar").style.top = "-50px";
//   }
//   prevScrollpos = currentScrollPos;
// }

// 
// var modal = document.getElementById('id01');

//   // When the user clicks anywhere outside of the modal, close it
//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }

// // 
// var prevScrollpos = window.pageYOffset;
// window.onscroll = function() {
//     var currentScrollPos = window.pageYOffset;
//     if (prevScrollpos > currentScrollPos) {
//         document.getElementById("navbar").style.top = "0";
//     } else {
//         document.getElementById("navbar").style.top = "-50px";
//     }
//     prevScrollpos = currentScrollPos;
// }
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

$(".col1").click(function(){
  $("#col1").toggle(500);
});
$(".col2").click(function(){
  $("#col2").toggle(500);
});
$(".col3").click(function(){
  $("#col3").toggle(500);
});

// ===================================

// Slide top Animation

// var getImage = document.querySelectorAll(".sb-slider li a img");
// console.log(getImage);
// for (let i = 0; i < getImage.length; i++) {
//   console.log(getImage[0]);
//   if (getImage[0]) {
//     console.log("OK");
//     // $(function() {
//     //   $(".slide-text--title").textyle({
//     //     duration: 500,
//     //     delay: 200,
//     //     easing: 'linear',
//     //     callback: function() {
//     //       $(this).css({
//     //         transform: 'translateY(0px) rotateY(360deg)'
//     //       });
//     //     }
//     //   });
//     //   $(".slide-text--desc").textyle();
//     // });
//   }

// }

// Hover Over 

var getClass1 = document.getElementsByClassName("list__services-stt-1");
var getClass2 = document.getElementsByClassName("list__services-stt-2");

function hoverOver() {
  // console.log(getClass2);
  getClass2[0].style.transform = "scale(0.9)";
  getClass2[0].style.backgroundColor = "#f7f7f7";
  getClass1[0].style.zIndex = "10";
  for (let i = 0; i < getClass2.length; i++) {
    getClass2[i].style.boxShadow = "0px 1px 5px rgba(0, 0, 0, 0.08)";
  }
  
}

function hoverOut() {
  // console.log(getClass2);
  getClass2[0].style.transform = "scale(1)";
  getClass2[0].style.backgroundColor = "";
  getClass1[0].style.zIndex = "1";
  for (let i = 0; i < getClass2.length; i++) {
    getClass2[i].style.boxShadow = "0px 10px 15px rgba(0, 0, 0, 0.08)";
  }
}

// #ffc10e
//  #01923e
