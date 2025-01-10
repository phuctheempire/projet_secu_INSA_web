#!/bin/bash

# Set the login URL and POST data
LOGIN_URL="http://127.0.0.1/pages/public/login.php"
EMAIL="john.doe@insa-cvl.fr"
PASSWORD="111"
LOGIN_BTN=""

# Initial points
points=2000

# Perform login and extract PHPSESSID and redirection URL
response=$(curl -L -i -X POST "$LOGIN_URL" \
    -d "email=$EMAIL" \
    -d "password=$PASSWORD" \
    -d "login_btn=$LOGIN_BTN" )

# Extract the redirection URL and PHPSESSID
REDIRECT_URL=$(echo "$response" | grep -oP 'location: \K[^\n]+' | head -n 1)
PHPSESSID=$(echo "$response" | grep -oP 'Set-Cookie: PHPSESSID=\K[^;]+' | head -n 1)

# Clean up REDIRECT_URL and extract the id value
CLEAN_REDIRECT_URL=$(echo "$REDIRECT_URL" | xargs)
USER_ID=$(echo "$CLEAN_REDIRECT_URL" | grep -oP 'id=\K\d+')

# Save PHPSESSID and USER_ID to a file (or environment variables)
echo "$PHPSESSID" > session_info.txt
echo "$USER_ID" >> session_info.txt

# Check if PHPSESSID or USER_ID are empty
if [[ -z "$PHPSESSID" || -z "$USER_ID" ]]; then
    echo "Login failed. PHPSESSID or USER_ID is empty."
else
    echo "Login successful. PHPSESSID: $PHPSESSID, USER_ID: $USER_ID"
    echo "Session info saved to session_info.txt"
fi
