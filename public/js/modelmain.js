var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(index) {
	// This function will display the specified tab of the form ...
	var tab = document.getElementsByClassName("tab");
	tab[index].style.display = "block";

	// ... and fix the Previous/Next buttons:
	if (index == 0) {
		document.getElementById("prevBtn").style.display = "none";
	} else {
		document.getElementById("prevBtn").style.display = "inline-block";
	}

	if (index < tab.length - 1) {
		// display next button on each slide except last slide
		document.getElementById(
			"nextBtn"
		).innerHTML = `Next <i class="fas fa-long-arrow-alt-right"></i>`;

		// display submit button on second last slide
		if (index == 3) {
			document.getElementById("nextBtn").innerHTML = "Submit";
		}
	} else if (index >= tab.length - 1) {
		// hide Previous/Next buttons in last slide
		document.getElementById("nextBtn").style.display = "none";
		document.getElementById("prevBtn").style.display = "none";
	}

	// ... and run a function that displays the correct step indicator:
	fixStepIndicator(index);
}

function fixStepIndicator(index) {
	// This function removes the "active" class of all steps...
	var i,
		step = document.getElementsByClassName("step");
	for (i = 0; i < step.length; i++) {
		step[i].className = step[i].className.replace(" active", "");
	}

	//... and adds the "active" class to the current step:
	var tab = document.getElementsByClassName("tab");

	if (currentTab < tab.length - 1) {
		step[index].className += " active";
	}

	// hide steps in last tab
	if (currentTab === tab.length - 1) {
		for (i = 0; i < step.length; i++) {
			step[i].style.display = "none";
		}
	}
}

function nextPrev(n) {
	// This function will figure out which tab to display
	var tab = document.getElementsByClassName("tab");

	// Exit the function if any field in the current tab is invalid:
	// if (n == 1 && !validateForm()) return false;
	if (n == 1) {
		document.getElementsByClassName("step")[currentTab].className += " finish";
	}

	// Hide the current tab:
	tab[currentTab].style.display = "none";

	// Increase or decrease the current tab by 1:
	currentTab = currentTab + n;

	// if you have reached the end of the form... :
	if (currentTab >= tab.length) {
		//...the form gets submitted:
		// document.getElementById("regForm").submit();
		// return false;

		// display the currentTab and show greeting message
		tab[currentTab - 1].style.display = "block";
		// x[currentTab - 1].innerHTML = `<h1>Submitted</h1>`;
		tab[currentTab - 1].innerHTML = `<div class="tab">
											<img src="img/tab-vector-5.svg" class="tab-vector" alt="tab-vector" />
											<h1 class="text-center">Submitted</h1>
										</div>`;
		document.getElementById("prevBtn").style.display = "none";
		document.getElementById("nextBtn").style.display = "none";
	}

	// Otherwise, display the correct tab:
	showTab(currentTab);
}

function validateForm() {
	// This function deals with validation of the form fields
	var tab,
		input,
		i,
		valid = true;
	tab = document.getElementsByClassName("tab");
	input = tab[currentTab].getElementsByTagName("input");

	// A loop that checks every input field in the current tab:
	for (i = 0; i < input.length; i++) {
		// If a field is empty...
		if (input[i].value == "") {
			// add an "invalid" class to the field:
			input[i].className += " invalid";

			// and set the current valid status to false:
			valid = false;
		}
	}

	// If the valid status is true, mark the step as finished and valid:
	if (valid) {
		document.getElementsByClassName("step")[currentTab].className += " finish";
	}

	return valid; // return the valid status
}

//get all inputs in 'tab'
const inputRed = document.querySelectorAll(".tab input[type=text]");

// function for add border style
function addBorderStyle(inputs, eventType, className = "focus") {
	inputs.forEach((input) => {
		input.addEventListener(eventType, (event) => {
			event.target.classList.add(className);
		});
	});
}

// function for remove border style
function removeBorderStyle(inputs, eventType, className = "focus") {
	inputs.forEach((input) => {
		input.addEventListener(eventType, (event) => {
			event.target.classList.remove(className);
		});
	});
}

// Red borders add or remove function
addBorderStyle(inputRed, "focus");
addBorderStyle(inputRed, "input");
removeBorderStyle(inputRed, "blur");

// profile image upload
$(document).ready(function () {
	// Prepare the preview for profile picture
	$("#wizard-picture").change(function () {
		readURL(this, "#wizardProfilePreview");
	});

	//Prepare the preview for cover picture
	$("#wizard-cover").change(function () {
		readURL(this, "#wizardCoverPreview");
	});
});

document.getElementById("nextBtn").style.display = "none";

function readURL(input, imgID) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$(imgID).attr("src", e.target.result);

			if (
				$("#wizardProfilePreview").attr("src") !== "img/camera-upload.jpg" &&
				$("#wizardCoverPreview").attr("src") !== "img/cover-upload.jpg") {
				document.getElementById("nextBtn").style.display = "inline-block";
			}
		};
		reader.readAsDataURL(input.files[0]);
	}

}
let stuff_item = document.querySelectorAll(".dropdown-stuff");
let stuffintrested = document.querySelector(".dropdown-intrested");
stuff_item.forEach(item=>{
    item.addEventListener('click',(e)=>{
        let stufftext=e.target.textContent
        stuffintrested.textContent=stufftext
    })
})
