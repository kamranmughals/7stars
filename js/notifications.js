let cartQuantity = document.getElementById('cartQuantity');
let cartPrice = document.getElementById('cartPrice');

loadCartNotifications();
function loadCartNotifications () {
    fetch("controllers/notifications.php", {
        method: 'get'
    }).then(res => res.json())
        .then(data => {
            console.log(data);
            if(data) {
                cartQuantity.innerText = data.quantity;
                cartPrice.innerText = data['total-price'] + " PKR";
            } else {
                cartQuantity.innerText = 0;
                cartPrice.innerText = "0.00 PKR";
            }
        }).catch(error => {
                cartQuantity.innerText = 0;
                cartPrice.innerText = "0.00 PKR"
        });

}