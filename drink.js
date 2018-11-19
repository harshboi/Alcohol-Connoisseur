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
  stepNew.setAttribute("id", "Ingredients");
  stepNew.setAttribute("name", "Ingredient");
  stepNew.setAttribute("placeholder", "Ingredient " + ingred_amt);
  steps.appendChild(stepNew);
  var type = document.createElement("select");
  type.setAttribute("id", "Type");
  type.setAttribute("name", "Type");

  optionAlch = document.createElement("option");
  optionAlch.setAttribute("value", "Alcohol");
  alcohol = document.createTextNode("Alcohol");
  optionAlch.appendChild(alcohol);

  optionfill = document.createElement("option");
  optionfill.setAttribute("value", "Filler");
  filler = document.createTextNode("Filler");
  optionfill.appendChild(filler);

  optionseas = document.createElement("option");
  optionseas.setAttribute("value", "Seasoning");
  seasoning = document.createTextNode("Seasoning");
  optionseas.appendChild(seasoning);

  optionfrui = document.createElement("option");
  optionfrui.setAttribute("value", "Fruit");
  fruit = document.createTextNode("Fruit");
  optionfrui.appendChild(fruit);

  optionna = document.createElement("option");
  optionna.setAttribute("value", "NA");
  na = document.createTextNode("N/A");
  optionna.appendChild(na);

  type.appendChild(optionAlch);
  type.appendChild(optionfill);
  type.appendChild(optionseas);
  type.appendChild(optionfrui);
  type.appendChild(optionna);
  steps.appendChild(type);

  amount = document.createElement("input");
  amount.setAttribute("type", "text");
  amount.setAttribute("id", "Amount");
  amount.setAttribute("name", "Amount");
  amount.setAttribute("placeholder", "Amount");

  steps.appendChild(amount);




}
