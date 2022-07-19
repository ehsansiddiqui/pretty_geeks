const inputRed = document.querySelectorAll(".input-box.input-box-red input");
const inputYellow = document.querySelectorAll(".input-box.input-box-forgot input");

function addBorderStyle(inputs, eventType, className = "focus") {
	inputs.forEach((input) => {
		input.addEventListener(eventType, (event) => {
			event.target.parentElement.classList.add(className);
		});
	});
}

function removeBorderStyle(inputs, eventType, className = "focus") {
	inputs.forEach((input) => {
		input.addEventListener(eventType, (event) => {
			event.target.parentElement.classList.remove(className);
		});
	});
}

// Red borders add or remove function
addBorderStyle(inputRed, "focus");
removeBorderStyle(inputRed, "blur");

// Yellow borders add or remove functions
addBorderStyle(inputYellow, "focus", "focus-yellow");
removeBorderStyle(inputYellow, "blur", "focus-yellow");
