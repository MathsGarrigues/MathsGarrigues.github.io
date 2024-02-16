<?php
// Inclure le fichier login.php pour établir la connexion à la base de données
require_once 'login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Boutons Toggle</title>
<style>
    /* Style pour le corps de la page */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    /* Style pour le conteneur principal */
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

        /* Style pour le titre */
    h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    /* Style pour le sous-titre */
    h2 {
        text-align: center;
        margin-top: 0;
        color: #555;
    }


    /* Style pour les boutons */
    .button-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

/* Style pour les boutons */
.button-row button {
    width: calc((100% / 8) - 10px); /* Calcul de la largeur en pourcentage pour assurer 8 boutons par ligne */
    height: 40px;
    margin-right: 2px;
    margin-top: 20px;
    padding: 0  px 10px;
    border: none;
    background-color: #3498db;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.1s ease;
}

/* Réduire légèrement l'espacement entre chaque bouton */
.button-row button:nth-child(8n) {
    margin-right: 5;
}

/* Médias pour les écrans plus petits */
@media screen and (max-width: 800px) {
    .button-row button {
        width: calc((100% / 6) - 10px); /* 6 boutons par ligne pour les écrans plus petits */
    }

    /* Réduire légèrement l'espacement entre chaque bouton pour les écrans plus petits */
    .button-row button:nth-child(6n) {
        margin-right: 5;
    }
}

@media screen and (max-width: 600px) {
    .button-row button {
        width: calc((100% / 4) - 10px); /* 4 boutons par ligne pour les écrans encore plus petits */
    }

    /* Réduire légèrement l'espacement entre chaque bouton pour les écrans encore plus petits */
    .button-row button:nth-child(4n) {
        margin-right: 5;
    }
}
.button-row button:nth-child(2n) {
        margin-right: 15px;
    }
}



    .button-row button:hover {
        background-color: #2980b9;
    }

    /* Style pour les boutons actifs */
    .button-row button.active {
        background-color: #e74c3c;
    }

    /* Style pour le bouton de validation */
    

    .validate-button {
        background-color: #2ecc71;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .validate-button:hover {
        background-color: #27ae60;
    }


    /* Style pour le cadre de texte */
    #output {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        min-height: 50px;
        background-color: #ecf0f1;
    }
    .class-container {
    margin-top: 20px; /* Espace entre chaque classe */
    text-align: center;
}

    .class-label {
    font-size: 20px; /* Taille du texte de la classe */
    margin-bottom: 10px; /* Espacement entre le texte de la classe et les boutons */
}
</style>
</head>
<body>

<div class="container">
    <h1>5e5</h1>
    <h2>Travail à la maison</h2>
    <div class="button-row">
    </div>

    <button class="validate-button" onclick="valider()">Valider</button>
    <div id="output"></div>
</div>

<script>

var names_classe = [

    '--------', 'Margaux',                  '--------', 'Ryan',                   '--------','--------',          '--------','Selin',
    'MateoU', 'Manon',                 '--------', '--------',             '--------','Assil',          'Raphaël','--------',
    'Asya', 'Fabio',                    'Daniel', 'Ines',                   'InesB', 'Antton' ,             '--------', 'Amber',
    'Camille', 'Laëtitia',              '--------', 'Lana',                    'Hajar', 'Elena',                    'Timéo', 'InèsK',
    'Ismaël', 'Alicia',                 'Aurélien', 'Sarah',                   '--------', 'Lucas',                '--------',  '--------'];


var classes = [
    { names: names_classe, label: ""},
];

var scores = {};

// Ajouter tous les élèves à l'objet scores avec un score initial de 100 points
names_classe.forEach(function(name) {
    scores[name] = 100;
});

// Générer les boutons et les étiquettes de classe
classes.forEach(function(classData) {
    generateButtonsForClass(classData.names, classData.label);
});

function generateButtonsForClass(names, classLabel) {
    var container = document.createElement('div');
    container.classList.add('class-container');
    document.querySelector('.button-row').appendChild(container);

    var classText = document.createElement('div');
    classText.textContent = classLabel;
    classText.classList.add('class-label');
    document.querySelector('.button-row').appendChild(classText);

    names.forEach(function(name) {
        var button = document.createElement('button');
        button.textContent = name;
        button.id = "button" + name;
        button.addEventListener('click', function() {
            toggleButton(name);
        });
        container.appendChild(button);
    });
}



// Appel de la fonction pour générer les boutons


var buttonsClicked = {};
var buttonsClickedBeforeValidation = {}; // Pour garder une trace des boutons cliqués avant d'appuyer sur "Valider"

var scoreEleves = {};
var scoreElevesBeforeValidation = {}; // Pour garder une trace des scores avant d'appuyer sur "Valider"

function toggleButton(buttonName) {
    var button = document.getElementById("button" + buttonName);
    
    // Vérifier si le bouton est actif ou non
    var isActive = button.classList.contains("active");

    // Stocker la valeur précédente avant de la modifier
    var previousValue = buttonsClicked[buttonName] || 0; // pour les boutons cliqués
    var previousScore = scoreEleves[buttonName] || 0; // pour les scores

    // Mettre à jour le tableau des boutons cliqués
    if (isActive) {
        buttonsClicked[buttonName] = previousValue + 1;
        scoreEleves[buttonName] = previousScore + 1;

    } else {
        buttonsClicked[buttonName] = previousValue - 1;
        scoreEleves[buttonName] = previousScore - 1;
    }

    // Toggle la classe 'active' pour le bouton
    button.classList.toggle("active");

    // Mettre à jour le tableau des boutons cliqués avant d'appuyer sur "Valider"
    if (!isActive && Object.keys(buttonsClickedBeforeValidation).length === 0) {
        buttonsClickedBeforeValidation[buttonName] = previousValue;
    }
    if (!isActive && Object.keys(scoreElevesBeforeValidation).length === 0) {
        scoreElevesBeforeValidation[buttonName] = previousScore;
    }
}

function deselectAllButtons() {
    var buttonElements = document.querySelectorAll('.button-row button');
    buttonElements.forEach(function(button) {
        button.classList.remove('active');
    });
}

function valider() {
    deselectAllButtons(); // Déselectionner tous les boutons
    var output = document.getElementById("output");
    var buttonsList = Object.keys(buttonsClicked).map(function(key) {
        // Afficher la valeur du bouton
        return key + ": " + buttonsClicked[key]+scoreEleves[key];
    });
    output.textContent = buttonsList.join("\n");
}
</script>

</body>
</html>