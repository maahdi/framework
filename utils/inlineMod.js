var editionEnCours = false;

function retourSelect(valeur){
    $.ajax({
        type : 'POST',
        url  : 'main.php?action=enregistrerAjax',
        data : {nomPays : valeur},
        success :function(data,textStatus, jqXHR){
            $('#pays').prepend(data);
        }
            });
}

function inlineModSelect(id, obj, nomValeur, type, indiceLigne, table){
    if (editionEnCours){
        return false;
    }else{
        editionEnCours = true;
    }
    if (obj.options[obj.selectedIndex].value == 'nouveau'){
        $('#selPays').remove();
        $('#pays').prepend('<input type="text" id="nomPays">');
        $('#nomPays').bind('keydown keyup', function (e){
                if (e.which === 13){
                    valeur = $('#nomPays').val(); 
                    sauverMod(id, obj, nomValeur, valeur, type, indiceLigne, table, true);
                }
                });
    }else{
        sauverMod(id, obj, nomValeur, obj.options[obj.selectedIndex].value, type, indiceLigne, table, true);
    }
    var t = 10;

}

function inlineMod(id, obj, nomValeur, type, indiceLigne, table){
    if (editionEnCours){
        return false;
    }else{
        editionEnCours = true;
    }
    var input = null;
    
    switch (type){
        case 'texte':
         input = document.createElement("input");
            break;
        case 'entier':
            input = document.createElement("input");
            break;
        case 'texte-multi':
            input = document.createElement("textarea");
            break;
        case 'float':
            input = document.createElement("input");
            break;
    }
    if (obj.innerText){
        input.value = obj.innerText;
    }else{
        input.value = obj.textContent;
    }
    
    input.value = trim(input.value);
    input.style.width = getTextWidth(input.value)+ 30 + "px";
    //Remplacement du texte par notre objet input
    obj.replaceChild(input, obj.firstChild);

    //On donne le focus à l'input et on sélectionne le texte qu'il contient
    input.focus();
    input.select();
    input.onblur = function sortir(){
		sauverMod(id, obj, nomValeur, input.value, type, indiceLigne, table, false);
		delete input;
	};

    //Appui sur la touche Entrée
    input.onkeydown = function keyDown(event){
        if (!event&&window.event){
            event = window.event;
        }
        if(getKeyCode(event) == 13){
            sauverMod(id, obj, nomValeur, input.value, type, indiceLigne, table, false);
            delete input;
        }
    };
}


//Suppression des espaces/sauts de ligne inutiles (http://www.breakingpar.com/bkp/home.nsf/0/87256B280015193F87256C0C0062AC78)
function trim(value) {
   var temp = value;
   var obj = /^(\s*)([\W\w]*)(\b\s*$)/;
   if (obj.test(temp)) { temp = temp.replace(obj, '$2'); }
   obj = /  /g;
   while (temp.match(obj)) { temp = temp.replace(obj, " "); }
   return temp;
}


//Fonction donnant la largeur en pixels du texte donné (merci SpaceFrog !)
function getTextWidth(texte){
	//Valeur par défaut : 150 pixels
	var largeur = 150;

	if(trim(texte) == "")
	{
		return largeur;
	}

	//Création d'un span caché que l'on "mesurera"
	var span = document.createElement("span");
	span.style.visibility = "hidden";
	span.style.position = "absolute";

	//Ajout du texte dans le span puis du span dans le corps de la page
	span.appendChild(document.createTextNode(texte));
	document.getElementsByTagName("body")[0].appendChild(span);

	//Largeur du texte
	largeur = span.offsetWidth;

	//Suppression du span
	document.getElementsByTagName("body")[0].removeChild(span);
	span = null;

	return largeur;
}

//Fonction renvoyant le code de la touche appuyée lors d'un événement clavier
function getKeyCode(evenement)
{
    for (prop in evenement)
    {
        if(prop == 'which')
        {
            return evenement.which;
        }
    }

    return evenement.keyCode;
}




// retourne un objet xmlHttpRequest.
// méthode compatible entre tous les navigateurs (IE/Firefox/Opera)
function getXMLHTTP()
{
    var xhr = null;
    if(window.XMLHttpRequest)
    { // Firefox et autres
        xhr = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    { // Internet Explorer
        try
        {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try
            {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e1)
            {
                xhr = null;
            }
        }
    }
    else
    { // XMLHttpRequest non supporté par le navigateur
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
    }

    return xhr;
}
var XHR = null;

//Fonction de sauvegarde des modifications apportées
function sauverMod(id, obj, nomValeur, valeur, type, indiceLigne, table, select)
{
	//Si on a déjà sauvé la valeur en cours, on sort
//	if(sauve)
//	{
//		return false;
//	}
//	else
//	{
//		sauve = true;
//	}

	//Si l'objet existe déjà on abandonne la requête et on le supprime
	if(XHR && XHR.readyState != 0)
	{
		XHR.abort();
		delete XHR;
	}

	//Création de l'objet XMLHTTPRequest
	XHR = getXMLHTTP();

	if(!XHR)
	{
		return false;
	}
        
        //URL du script de sauvegarde auquel on passe la valeur à modifier
	XHR.open("POST", "main.php?action=enregistrerAjax", true);
        XHR.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	//On se sert de l'événement OnReadyStateChange pour supprimer l'input et le replacer par son contenu
	

	//Envoi de la requête avec les données en post
	XHR.send("id=" + id + "&champ=" + nomValeur + "&valeur=" + escape(valeur) 
                    + "&table=" + table + "&type=" + type + ieTrick());
        XHR.onreadystatechange = function()
	{
		//Si le chargement est terminé
		if (XHR.readyState == 4)
            {
                var sel = "prixttc" + indiceLigne;
                
                //Réinitialisation de la variable d'état d'édition
                editionEnCours = false;
                //Remplacement de l'input par le texte qu'il contient
                if (!select){
                    obj.replaceChild(document.createTextNode(valeur), obj.firstChild);
                    if (XHR.responseText){
                        readData(XHR.responseText, sel);
                    }

                }
                
            }
	}
        
}

//Pour FuckingInternetExplorer
function ieTrick(sep)
{
	d = new Date();
	trick = d.getYear() + "ie" + d.getMonth() + "t" + d.getDate() + "r" + d.getHours() + "i" 
		+ d.getMinutes() + "c" + d.getSeconds() + "k" + d.getMilliseconds();

	if (sep != "?")
	{
		sep = "&";
	}

	return sep + "ietrick=" + trick;
}

function readData(oData, sel) {
    document.getElementById(sel).innerHTML =oData;
    
    
}
