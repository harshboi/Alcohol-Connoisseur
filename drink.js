var step_amt = 1;
var equip_amt = 1;
var ingred_amt = 1;

function step_add(){
  step_amt++;
  var steps = document.getElementById("step_amt");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Steps");
  stepNew.setAttribute("name", "Steps");
  stepNew.setAttribute("placeholder", "Step " + step_amt);
  steps.appendChild(stepNew);
}

function equip_add(){
  equip_amt++;
  var steps = document.getElementById("Equipment");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Equipment");
  stepNew.setAttribute("name", "Equipment");
  stepNew.setAttribute("placeholder", "Equipment " + equip_amt);
  steps.appendChild(stepNew);
}

function ingred_add(){
  ingred_amt++
  var steps = document.getElementById("Ingredients");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Ingredient");
  stepNew.setAttribute("name", "Ingredient");
  stepNew.setAttribute("placeholder", "Ingredient " + ingred_amt);
  steps.appendChild(stepNew);
}
