// episode quick selection
let dropDownListElmt = document.querySelector("#episodeListDropDown");

if (dropDownListElmt != null) {
    dropDownListElmt.addEventListener("change", e => {
        window.location.href = "index.php?controller=episode&action=show&param=" + e.target.value;
    })
}

// comment size limitation
let authorElmt  = document.querySelector("#author");
let contentElmt = document.querySelector("#content");

if (authorElmt != null) {
    let availableChars = 30;
    let remainingCharsAuthorElmt = document.querySelector("#remainingCharsAuthor")
    remainingCharsAuthorElmt.innerText = `Caractères disponibles : ${availableChars - authorElmt.value.length} / ${availableChars}`;

    authorElmt.addEventListener("input", e => {
        if (authorElmt.value.length > availableChars) {
            authorElmt.value = authorElmt.value.slice(0, availableChars);
        }
        remainingCharsAuthorElmt.innerText = `Caractères disponibles : ${availableChars - authorElmt.value.length} / ${availableChars}`;
    });
}

if (contentElmt != null) {
    let availableChars = 255;
    let remainingCharsCommentElmt = document.querySelector("#remainingCharsComment")
    remainingCharsCommentElmt.innerText = `Caractères disponibles : ${availableChars - contentElmt.value.length} / ${availableChars}`;

    contentElmt.addEventListener("input", e => {
        if (contentElmt.value.length > availableChars) {
            contentElmt.value = contentElmt.value.slice(0, availableChars);
        }
        remainingCharsCommentElmt.innerText = `Caractères disponibles : ${availableChars - contentElmt.value.length} / ${availableChars}`;
    });
}