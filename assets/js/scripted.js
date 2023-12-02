//document.getElementById('dupliquerBouton').onclick = duplicate;

//var i = 0;

//function duplicate() {
    //var original = document.getElementById('duplicater0');
   // var clone = original.cloneNode(true); // Clonage "en profondeur"
   // clone.id = "duplicater" + ++i; // Un élément ne peut avoir qu'un ID unique
   // original.parentNode.appendChild(duplicata); // Ajout du duplicata à l'élément d'origine
//}


document.getElementById("dupliquerBouton").
            addEventListener("click", function () {
         document.getElementById("duplicater0").
            innerHTML += "<h3>Hello geeks</h3>";
        });




        const para = document.createElement("p");
const node = document.createTextNode("This is new.");
para.appendChild(node);
const element = document.getElementById("div1");
element.appendChild(para);