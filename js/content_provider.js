let products = [];
const PARAMS = ["gender", "category"];
let menButton = document.getElementById('men-button');
let womenButton = document.getElementById('women-button');
let categorySelect=document.getElementById('category-select');
let productBox = document.getElementById('product-box');
let loadMoreButton=document.getElementById('load-more-button');


loadMoreButton.addEventListener("click", () => {
    loadProducts(getURLParams(PARAMS));
});


loadProducts(getURLParams(PARAMS));




categorySelect.addEventListener('change', function () {
    let value = this.options[this.selectedIndex].value;
    updateURLParams("category", value, "7stars category");
    emptyProductBox();
    loadProducts(getURLParams(PARAMS));
});

function loadingCircle(rotate, text, visible) {
    let i = loadMoreButton.querySelector("i");
    let span = loadMoreButton.querySelector("span");
    if(rotate) {
        i.classList.add("fa-spin");
        loadMoreButton.setAttribute("disabled", "disabled");
        loadMoreButton.style.background = "grey";
    } else {
        i.classList.remove("fa-spin");
        loadMoreButton.removeAttribute("disabled");
        loadMoreButton.style.background = "#e7ab3c";
    }
    if(status !== undefined) {
        loadMoreButton.style.visibility = visible;
    }
    span.innerText = text;


}




function getNumLoadedProducts() {
    return document.querySelectorAll('#product-box .products-list').length;
}




function getURLParams(keys) {
    let url = new URLSearchParams(window.location.search);
    let result = [];
    for (let key of keys) {
        let value = url.get(key);
        if(value) {
            result.push({[key]: value});
        }
    }
    return result;
}

function updateURLParams(key, value, title) {
    let url = new URLSearchParams(window.location.search);
    url.set(key, value);
    history.pushState(null, title, "?" + url.toString());
}

function loadProducts(products) {
    loadingCircle(true, " Loading", "visible");
    let productBox = document.getElementById("product-box");
    let box = "";
    loadProductsDB(products).then(data => {
            if(data.length < 9) {
                loadingCircle(false, " Load more" , "hidden");
            } else {
                loadingCircle(false, " Load more");
            }

                for(let d of data) {
                    box += `<div class="products-list col-lg-3 col-md-4 col-sm-6 col-12" >
                        <a href="productView.php?id=${d.id}">
                            <div class="products-item" >
                                <img src="${d.image.substr(3, d.image.length)}" alt="">
                                <div class="products-text">
                                    <p class="products-category">${d.category}</p>
                                    <a href="product-view.php?id=${d.id}">
                                        <h5>${d.description}</h5>
                                    </a>
                                    <p class="products-price">${d.price.toLocaleString('us')} PKR <span>${d.oldPrice}</span></p>
                                </div>
                            </div>
                        </a>
                    </div>`;
                    console.log(d.oldPrice);
                }

                productBox.innerHTML += box;
            }

        );

}

async function loadProductsDB(data) {
    let formData = new FormData();
    formData.append('counter', getNumLoadedProducts());
    for(let d of data) {
        let key = Object.keys(d)[0];
        let value = Object.values(d)[0];
        console.log(key, value);
        formData.append(Object.keys(d)[0], Object.values(d)[0]);
    }

    let response = await fetch("controllers/main_page.php",
        {method: 'post',
            body: formData});
    let jsonData = await response.json();
    return jsonData;
}

function emptyProductBox() {
    let productBox = document.getElementById("product-box");
    productBox.innerHTML = "";
}


/*
function ifViewLoadContent()
{
    console.log("scrolling");
    let elem = productBox;
    var top_of_element = $(elem).offset().top;
    var bottom_of_element = $(elem).offset().top + $(elem).outerHeight();
    var bottom_of_screen = $(window).scrollTop() + window.innerHeight;
    var top_of_screen = $(window).scrollTop();

    if((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
        loadProducts(getURLParams(PARAMS));
        window.removeEventListener("scroll", ifViewLoadContent);
    }
    else {
    }
}*/

//window.addEventListener('scroll', ifViewLoadContent);