#!/bin/bash

# Lire les informations de session depuis le fichier
PHPSESSID=$(head -n 1 session_info.txt)

# Vérifier que PHPSESSID n'est pas vide
if [ -z "$PHPSESSID" ]; then
    echo "Failed to retrieve session info."
    exit 1
fi

# URL de la page des notes
NOTES_PAGE_URL="http://localhost/pages/user/note.php"

# Faire une requête GET pour accéder à la page
response=$(curl -i -L -X GET "$NOTES_PAGE_URL" -b "PHPSESSID=$PHPSESSID")

# Vérifier si la réponse contient la matière "JAVA" avec une note de 15
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "HTTP Success"
    if echo "$response" | grep -q "JAVA" && echo "$response" | grep -q ">15<"; then
        echo "La matière JAVA avec une note de 15 est présente sur la page."
    else
        echo "La matière JAVA avec une note de 15 n'est pas trouvée sur la page."
    fi
else
    echo "Echec d'accès à la page des notes."
fi
echo "----------------------------------------"
