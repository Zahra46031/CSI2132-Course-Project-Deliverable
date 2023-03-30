var button1;
var button2;
var button3;
var button4;
var button5;
var button6;
var button7;
var img = new Image();
var query = "";
img.src = 'C:\Users\Owner\Dropbox\PC\Desktop\hotel-room.jpg';

function changeText(option) {
    button1 = document.getElementsByClassName("dropbtn")[0];
    button1.innerHTML = option;
  }
  
  function changeText2(option) {
    button2 = document.getElementsByClassName("dropbtnend")[0];
    button2.innerHTML = option;
  }
  function changeText3(option) {
    button3 = document.getElementsByClassName("dropbtnArea")[0];
    button3.innerHTML = option;
  }
  function changeText4(option) {
    button4 = document.getElementsByClassName("dropbtnHotelChain")[0];
    button4.innerHTML = option;
  }
  function changeText5(option) {
    button5 = document.getElementsByClassName("dropbtnCapacity")[0];
    button5.innerHTML = option;
  }
  function changeText6(option) {
    button6 = document.getElementsByClassName("dropbtnHotelRating")[0];
    button6.innerHTML = option;
  }
  function changeText7(option) {
    button7 = document.getElementsByClassName("dropbtnHotelPrice")[0];
    button7.innerHTML = option;
  }
