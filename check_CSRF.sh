#!/bin/bash

source ./check_login.sh

check_login

# Vérifier si le fichier de cookies a été généré
if [ ! -f $COOKIE_FILE ]; then
    echo "Erreur : le fichier de cookies n'a pas été généré. Impossible de continuer."
    exit 1
fi

# URL de la page qui gère l'envoi de mails
URL="http://127.0.0.1/controller/api/user/mail.php"

# Données malveillantes
DATA="receiver_emails=hacker@gmail.com&title=Test&content=<a href='https://www/functions/user/mail.php?id=3&new_email=hacker2@gmail.com'>Cliquez ici pour un cadeau!</a>&send_email=1"

# Points initiaux
# points=2000

response=$(curl -s -L -i -X POST "$MAIL_URL" \
    -d "$DATA" \
    -b $COOKIE_FILE)

# Afficher la réponse complète pour le débogage (optionnel)
echo "----------------------------------------"
echo "Réponse complète :"
echo "$response"
echo "----------------------------------------"

if echo "$response" | grep -q "200 OK"; then
    echo "HTTP Success"

    if echo "$response" | grep -q "Invalid email"; then
        echo "L'e-mail a été détecté comme invalide (OK)."
    elif echo "$response" | grep -q "Email sent"; then
        echo "Attention : L'e-mail a été envoyé !"
    else
        echo "Le comportement du site est indéterminé."
    fi

else
    echo "Requête échouée. Vérifiez l'URL ou les paramètres."
fi

echo "----------------------------------------"
