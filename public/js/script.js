let dropDownList = document.querySelector("#episodeListDropDown");

if (dropDownList != null) {
	dropDownList.addEventListener("change", e => {
		window.location.href = "index.php?controller=episode&action=show&param=" + e.target.value;
	})
}