const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');
const inputButton = document.getElementById('login-btn');
const inputFields = [inputEmail, inputPassword];

//submit button
inputButton.addEventListener('click', formValidationOnSubmit);

for (let field of inputFields) {
    field.addEventListener("change", fieldValidation);
}

function fieldValidation() {
    let message = "";
    let msgBox = document.getElementById(this.id + "-error");
    let valid = true;
    if (this.value === "") {
        message = this.id.charAt(0).toUpperCase() + this.id.slice(1) + " field is required";
        valid = false;
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
    if(counter === 2) {
        console.log("form submit", counter);
        postFormData(inputFields.map(value => value.id), inputFields.map(value=>value.value), this.id);
    } else {
        console.log("form is not submitted", counter);
    }
}

async function postFormData(keys, values, inputKey) {
    let formMsg = document.getElementById('form-msg');
    let formData = new FormData();
    formData.append(inputKey, inputKey);
    for (let i=0; i<values.length; i++) {
        formData.append(keys[i], values[i]);
    }

    fetch("controllers/authenticator.php", {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if(!data) {
                formMsg.className = "alert alert-danger";
                formMsg.innerText = "Email or password incorrect!";
            } else {
                formMsg.style.display = "none";
                window.location.href = "index.php";
            }
    }).catch(error => {
        formMsg.className = "alert alert-danger";
        formMsg.innerText = "An error occurred while login! Try again.";
    });
}


