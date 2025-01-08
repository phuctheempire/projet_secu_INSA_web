#!/bin/bash


PHPSESSID=$(head -n 1 session_info.txt)
USER_ID=$(tail -n 1 session_info.txt)

if [ -z "$PHPSESSID" ]; then
    echo "Failed to retrieve session info."
    exit 1
fi

MAIL_PAGE_URL="http://127.0.0.1/pages/user/mail.php?id=$USER_ID"

response=$(curl -i -L -X GET "$MAIL_PAGE_URL" -b "PHPSESSID=$PHPSESSID")


echo "----------------------------------------"

if echo "$response" | grep -q "200 OK"; then
    echo "HTTP Success"
    if echo "$response" | grep -q "Changer mon adresse email"; then
        echo "Email text is present , email page succeeded"
    else
        echo "Email text not found in response"
    fi
else
    echo "Access to mail page failed"
fi

echo "----------------------------------------"