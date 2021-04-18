function Round3Dec(InputVal)
{
  return Math.round(InputVal * 1000) / 1000;
}

function NextHigherStandardResistor(Resistor_Ohms)
{
  var	Power10;
  var	Units;
  Power10 = 1;
  while (Resistor_Ohms > 8.2)
  {
    Power10 *= 10;
    Resistor_Ohms /= 10;
  }
  if (Resistor_Ohms < 1.0)
    Resistor_Ohms = 1.0;
  else if (Resistor_Ohms < 1.2)
    Resistor_Ohms = 1.2;
  else if (Resistor_Ohms < 1.5)
    Resistor_Ohms = 1.5;
  else if (Resistor_Ohms < 1.8)
    Resistor_Ohms = 1.8;
  else if (Resistor_Ohms < 2.2)
    Resistor_Ohms = 2.2;
  else if (Resistor_Ohms < 2.7)
    Resistor_Ohms = 2.7;
  else if (Resistor_Ohms < 3.3)
    Resistor_Ohms = 3.3;
  else if (Resistor_Ohms < 3.9)
    Resistor_Ohms = 3.9;
  else if (Resistor_Ohms < 4.7)
    Resistor_Ohms = 4.7;
  else if (Resistor_Ohms < 5.6)
    Resistor_Ohms = 5.6;
  else if (Resistor_Ohms < 6.8)
    Resistor_Ohms = 6.8;
  else
    Resistor_Ohms = 8.2;

  if (Power10 >= 1000000)
  {
    Units = " Megaohms";
    Power10 /= 1000000;
  }
  else if (Power10 >= 1000)
  {
    Units = " Kilohms";
    Power10 /= 1000;
  }
  else
  {
    Units = " Ohms";
  }

  Resistor_Ohms *= Power10;
  return "" + Round3Dec(Resistor_Ohms) + Units;
}

function compute(){	
	if(document.querySelector("#iled").value == 0) return;
	
	var rfinal = (document.querySelector("#vfuente").value - document.querySelector("#vled").value ) / (document.querySelector("#iled").value/1000);
	var cerca = NextHigherStandardResistor(rfinal);
	var pfinal = (document.querySelector("#vfuente").value - document.querySelector("#vled").value ) * (document.querySelector("#iled").value/1000);
	
	if(rfinal < 1000)
		document.querySelector("#r").value = Round3Dec(rfinal)+" Ohms";
	else if(rfinal < 1000000)
		document.querySelector("#r").value = Round3Dec(rfinal/1000)+" Kilohms";
	else
		document.querySelector("#r").value = Round3Dec(rfinal/1000000)+" Megaohms";
	
	document.querySelector("#rCom").value = cerca;
	
	if(pfinal > 1)
		document.querySelector("#p").value = Round3Dec(pfinal)+" Watts";
	else if(pfinal > 0.001)
		document.querySelector("#p").value = Round3Dec(pfinal*1000)+" Miliwatts";
	else
		document.querySelector("#p").value = Round3Dec(pfinal*1000000)+" Microwatts";
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		let inputs = document.querySelectorAll("input");
		for (let i = 0; i < inputs.length; i++) {
			inputs[i].addEventListener("input", compute);
		}

		let selects = document.querySelectorAll("select");
		for (let i = 0; i < selects.length; i++) {
			selects[i].addEventListener("change", compute);
		}
		compute();	
	}
};