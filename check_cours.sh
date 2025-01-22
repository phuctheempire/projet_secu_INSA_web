#!/bin/bash

# Lire les informations de session depuis le fichier
PHPSESSID=$(head -n 1 session_info.txt)

# Vérifier que PHPSESSID n'est pas vide
if [ -z "$PHPSESSID" ]; then
    echo "Failed to retrieve session info."
    exit 1
fi

# URL de la page des cours
COURSE_PAGE_URL="http://localhost/pages/public/cours.php"

# Faire une requête GET pour accéder à la page
response=$(curl -i -L -X GET "$COURSE_PAGE_URL" -b "PHPSESSID=$PHPSESSID")

# Vérifier si le cours "Java" est présent dans la réponse
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "HTTP Success"
    if echo "$response" | grep -q "Java"; then
        echo "Le cours Java est affiché sur la page."
    else
        echo "Le cours Java n'est pas trouvé sur la page."
    fi
else
    echo "Echec d'accès à la page des cours."
fi
echo "----------------------------------------"
