var step_amt = 0;
var equip_amt = 0;
var ingred_amt = 0;

function step_rem(){
  remove = document.getElementById("Steps_Div").querySelectorAll("#Steps");
  remove[step_amt-1].parentNode.removeChild(remove[step_amt-1]);
  step_amt--;
  if(step_amt == 0){
    document.getElementById("removeStep").style.display = "none";
  }
}

function equip_rem(){
  remove = document.getElementById("Equipment_Div").querySelectorAll("#Equipment");
  remove[equip_amt-1].parentNode.removeChild(remove[equip_amt-1]);
  equip_amt--;
  if(equip_amt == 0){
    document.getElementById("removeEquip").style.display = "none";
  }
}

function ingred_rem(){
  removeIng = document.getElementById("Ingredients_Div").querySelectorAll("#Ingredients");
  removeIng[ingred_amt-1].parentNode.removeChild(removeIng[ingred_amt-1]);

  removeIng = document.getElementById("Ingredients_Div").querySelectorAll("#Type");
  removeIng[ingred_amt-1].parentNode.removeChild(removeIng[ingred_amt-1]);

  removeIng = document.getElementById("Ingredients_Div").querySelectorAll("#Amount");
  removeIng[ingred_amt-1].parentNode.removeChild(removeIng[ingred_amt-1]);

  removeIng = document.getElementById("Ingredients_Div").querySelectorAll("#TypeAmt");
  removeIng[ingred_amt-1].parentNode.removeChild(removeIng[ingred_amt-1]);


  ingred_amt--;
  if(ingred_amt == 0){
    document.getElementById("removeIngr").style.display = "none";
  }

}

function step_add(){
  step_amt++;
  document.getElementById("removeStep").style.display = "block";
  var steps = document.getElementById("Steps_Div");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Steps");
  stepNew.setAttribute("name", "Steps");
  stepNew.setAttribute("placeholder", "Step " + step_amt);
  stepNew.required = true;
  steps.appendChild(stepNew);
}

function equip_add(){
  equip_amt++;
  document.getElementById("removeEquip").style.display = "block";
  var steps = document.getElementById("Equipment_Div");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Equipment");
  stepNew.setAttribute("name", "Equipment");
  stepNew.setAttribute("placeholder", "Equipment " + equip_amt);
  stepNew.required = true;
  steps.appendChild(stepNew);
}

function ingred_add(){
  ingred_amt++
  document.getElementById("removeIngr").style.display = "block";
  var steps = document.getElementById("Ingredients_Div");
  var stepNew = document.createElement("input");
  stepNew.setAttribute("type", "text");
  stepNew.setAttribute("id", "Ingredients");
  stepNew.setAttribute("name", "Ingredient");
  stepNew.setAttribute("placeholder", "Ingredient " + ingred_amt);
  stepNew.required = true;

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
  amount.required = true;
  steps.appendChild(amount);


  var typeamt = document.createElement("select");
  typeamt.setAttribute("id", "TypeAmt");
  typeamt.setAttribute("name", "Type");

  optionqt = document.createElement("option");
  optionqt.setAttribute("value", "qt");
  qt = document.createTextNode("qt");
  optionqt.appendChild(qt);

  optionoz = document.createElement("option");
  optionoz.setAttribute("value", "oz");
  oz = document.createTextNode("oz");
  optionoz.appendChild(oz);

  optiontsp = document.createElement("option");
  optiontsp.setAttribute("value", "tsp");
  tsp = document.createTextNode("tsp");
  optiontsp.appendChild(tsp);

  optionna = document.createElement("option");
  optionna.setAttribute("value", "NA");
  na = document.createTextNode("N/A");
  optionna.appendChild(na);

  typeamt.appendChild(optionqt);
  typeamt.appendChild(optionoz);
  typeamt.appendChild(optiontsp);
  typeamt.appendChild(optionna);
  steps.appendChild(typeamt);




}
