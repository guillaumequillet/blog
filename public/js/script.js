// episode quick selection
let dropDownListElmt = document.querySelector("#episodeListDropDown");

if (dropDownListElmt != null) {
    dropDownListElmt.addEventListener("change", e => {
        window.location.href = "index.php?controller=episode&action=show&param=" + e.target.value;
    })
}