// episode quick selection
let dropDownListElmt = document.querySelector("#episodeListDropDown");

if (dropDownListElmt != null) {
	dropDownListElmt.addEventListener("change", e => {
		window.location.href = "index.php?controller=episode&action=show&param=" + e.target.value;
	})
}

// user admin check
function countArrayElements(array, string) {
	let count = 0;
	array.forEach(e => {
		if (e.value === string)
			count++;
	});
	return count;
}

let formValidateElmt = document.querySelector("#formValidate");
if (formValidateElmt != null) {
	formValidateElmt.addEventListener("click", e => {
		document.querySelector("#errorUser").innerText = "";
		document.querySelector("#errorPassword").innerText = "";
		document.querySelector("#error").innerText = "";

		let fields = document.getElementsByTagName("input");
		let userFieldsFilled = 3 - countArrayElements([fields[0], fields[1], fields[2]], "");
		let pwdFieldsFilled  = 3 - countArrayElements([fields[3], fields[4], fields[5]], "");

		if (userFieldsFilled > 0 && userFieldsFilled < 3) {
			document.querySelector("#errorUser").innerText = "Saisie incomplète des champs.";
			e.preventDefault();
		}

		if (pwdFieldsFilled > 0 && pwdFieldsFilled < 3) {
			document.querySelector("#errorPassword").innerText = "Saisie incomplète des champs.";
			e.preventDefault();
		}

		if (fields[1].value != fields[2].value) {
			document.querySelector("#errorUser").innerText = "Les noms d'utilisateur saisis sont différents.";
			e.preventDefault();
		}

		if (fields[4].value != fields[5].value) {
			document.querySelector("#errorPassword").innerText = "Les mots de passe saisis sont différents.";
			e.preventDefault();
		}


		if (userFieldsFilled === 0 && pwdFieldsFilled === 0) {
			document.querySelector("#error").innerText = "Vous devez modifier le nom d'utilisateur et/ou le mot de passe";
			e.preventDefault();
		}
	});
}
