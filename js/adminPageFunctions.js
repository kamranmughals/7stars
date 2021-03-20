function myOrderFunction() {
    var x = document.getElementById("Orders");
    var y = document.getElementById("Products");
    var z = document.getElementById("Users");

    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display="none";
      z.style.display="none";
    } else {
      x.style.display = "none";
    }
}

function myProductFunction() {
    var x = document.getElementById("Products");
    var y = document.getElementById("Orders");
    var z = document.getElementById("Users");

    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display="none";
      z.style.display="none";
    } else {
      x.style.display = "none";
    }
}


function myUserFunction() {
    var x = document.getElementById("Users");
    var y = document.getElementById("Products");
    var z = document.getElementById("Orders");
    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display="none";
      z.style.display="none";
    } else {
      x.style.display = "none";
    }
}

var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("AddProduct");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn = document.getElementById("DeleteProduct");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}


var modal3 = document.getElementById("myModal3");

// Get the button that opens the modal
var btn = document.getElementById("BlockUser");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close3")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal3.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal3) {
    modal3.style.display = "none";
  }
}