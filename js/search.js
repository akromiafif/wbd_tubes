let keyword = document.getElementById("keyword");
let searchBtn = document.getElementById("search");
let container = document.getElementById("container");

keyword.addEventListener('keyup', () => {
    console.log(keyword.value);

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
        }
    };
});