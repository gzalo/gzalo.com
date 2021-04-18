
function f(r){
	if(r >= 1000000) return (r/1000000) + " Micro"
	if(r >= 1000) return (r/1000) + " Nano"
	return r + " Pico";
}

function compute(){
    var r1 = parseInt(document.querySelector("input[name='band01']:checked").value);
	var r2 = parseInt(document.querySelector("input[name='band02']:checked").value);
	var r3 = parseInt(document.querySelector("input[name='band03']:checked").value);
	var r4 = parseInt(document.querySelector("input[name='band04']:checked").value);
	document.querySelector("#c").value = f((r1+r2)*r3);
	document.querySelector("#t").value = r4 + " %";
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {	
		let inputs = document.querySelectorAll("input");
		for (let i = 0; i < inputs.length; i++) {
			inputs[i].addEventListener("input", compute);
			inputs[i].addEventListener("change", compute);
		}

		let selects = document.querySelectorAll("select");
		for (let i = 0; i < selects.length; i++) {
			selects[i].addEventListener("change", compute);
		}
		compute();	
	}
}