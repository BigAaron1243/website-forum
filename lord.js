var light = 0;
var fade_elements = document.getElementsByClassName("fadein");
setInterval(autoupdate);
fade(fade_elements[0], 0, 25);
fade(fade_elements[1], -1, 25);
fade(fade_elements[2], -2.5, 25);
fade(fade_elements[3], -3, 25);

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function fade(element, op, speed) {
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += 0.025;
    }, speed);
}

function lightclick() {
	light++;
	if (light == 2) {
		document.getElementById("qms").innerHTML = "?";
	}
	if (light == 4) {
		fade(fade_elements[4], 0, 50);
		fade(fade_elements[5], -2, 50);
		fade(fade_elements[6], -4, 50);
	}
}


function autoupdate() {
	document.getElementById("lightcounter").innerHTML = light;
	document.getElementById("bgimgol").style.opacity = 1 - (light/3000);

	let lightgood = "quite dim";
	if (light > 300) {
		lightgood = "getting brighter";
	} 
	if (light > 1000) {
		lightgood = "sufficient to see by";
	}
	if (light > 2000) {
		lightgood = "good";
	}
	document.getElementById("lightgood").innerHTML = lightgood;
}

//I dont know what this does exactly, i copied it from stackoverflow and it does what i want (prevent double click selection)
document.addEventListener('mousedown', function (event) {
  if (event.detail > 1) {
    event.preventDefault();
    // of course, you still do not know what you prevent here...
    // You could also check event.ctrlKey/event.shiftKey/event.altKey
    // to not prevent something useful.
  }
}, false);
