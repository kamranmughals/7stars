
//Registration fields
const inputName = document.getElementById('name');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');
const inputButton = document.getElementById('register-btn');
let inputFields = [inputName, inputPassword, inputEmail];
let dangerBox = document.getElementById('danger-box');

//add event listeners
//input fields
for (let field of inputFields) {
    field.addEventListener("change", fieldValidation);
}
//submit button
inputButton.addEventListener('click', formValidationOnSubmit);




function fieldValidation() {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let message = "";
    let msgBox = document.getElementById(this.id + "-error");
    let valid = true;
    if (this.value === "") {
        message = this.id.charAt(0).toUpperCase() + this.id.slice(1) + " field is required";
        valid = false;
    } else if (this.id === "password" && (this.value.length >= 1  && this.value.length < 6)) {
        message = "Password should be at least 6 characters!";
        valid = false;
    } else if (this.id === "email" && !re.test(this.value)) {
        message = "Email is invalid!";
        valid = false;
    } else if (this.id === "email" && re.test(this.value)) {
        checkEmailDuplication(this.value, this, msgBox);
    }
    if (valid) {
        msgBox.innerText = "";
        this.classList.remove("is-invalid", "border-danger");
        this.classList.add("is-valid", "border-success");
    } else {
        msgBox.innerText = message;
        this.classList.remove("is-valid" ,"border-success");
        this.classList.add("is-invalid", "border-danger");
    }
}

function checkEmailDuplication(email,element, msgBox) {
    let formData = new FormData();
    formData.append('mail', email);
    fetch("controllers/authenticator.php", {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
           if(data) {
               msgBox.innerText = "Email already exists!";
               element.classList.remove("is-valid" ,"border-success");
               element.classList.add("is-invalid", "border-danger");
           } else {
               msgBox.innerText = "";
               element.classList.add("is-valid" ,"border-success");
               element.classList.remove("is-invalid", "border-danger");
           }

        });
}

function formValidationOnSubmit() {
    let changeEvent = new Event('change');
    let counter = 0;
    for (let input of inputFields) {
        if(input.classList.contains('is-valid')) {
            counter++;
        } else if(!input.classList.contains('is-invalid')) {
            input.dispatchEvent(changeEvent);
        }

    }
    if(counter === 3) {
        console.log("form submit", counter);
        postFormData(inputFields.map(value => value.id), inputFields.map(value=>value.value), this.id);
    } else {
        console.log("form is not submitted", counter);
    }
}

function postFormData(keys, values, inputKey) {
    let formData = new FormData();
    formData.append(inputKey, inputKey);
    for (let i=0; i<values.length; i++) {
        formData.append(keys[i], values[i]);
    }
    console.log(keys, values);
    fetch("controllers/authenticator.php", {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if(data) {
                dangerBox.style.display = "none";
                window.location.href = "index.php";
            } else {
                dangerBox.style.display = "block";
            }
    })  .catch( err => dangerBox.style.display = "block");
}




