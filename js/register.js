let usernameInput = document.getElementById("username");
let searchBtn = document.getElementById("search");
let err_text = document.getElementById("err-text");

usernameInput.addEventListener('keyup', () => {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {  
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            console.log(xhr.responseText)
            if (xhr.responseText.trim() === "User already exist") {
                err_text.style.display = "flex";
                err_text.innerHTML = xhr.responseText;
            } else {
                err_text.style.display = "none";
            }
        }
    };

    xhr.open("GET", "../functions/register_function.php?keyword=" + usernameInput.value, true);
    xhr.send();
});