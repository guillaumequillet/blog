let dropDownListElmt = document.querySelector("#episodeListDropDown");

if (dropDownListElmt != null) {
	dropDownListElmt.addEventListener("change", e => {
		window.location.href = "index.php?controller=episode&action=show&param=" + e.target.value;
	})
}


// we want to remove default episode menu if javascript is enabled
// let episodeListElmt = document.querySelector("#episodeList");
// episodeList.parentNode.removeChild(episodeListElmt);