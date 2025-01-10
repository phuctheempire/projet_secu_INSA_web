#!/bin/bash

# URL de la page qui gère l'envoi de mails
URL="http://localhost:2024/pages/user/send_email.php"

# Données malveillantes
DATA="send_email=1&receiver_emails=hacker@gmail.com&title=WWHEATETGSAGSHDFIGASHRGAIWRHGAWRIGH&content=<a href='/pages/user/mail.php?id=3&new_email=hacker2@gmail.com&change_email=1'>Cliquez ici pour un cadeau!</a>"

# Points initiaux
points=2000

response=$(curl -s -L -i -X POST "$URL" -d "$DATA")

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
    points=$((points - 200))
    echo "Requête échouée. Vérifiez l'URL ou les paramètres."
    echo "Points restants : $points"
fi

echo "----------------------------------------"