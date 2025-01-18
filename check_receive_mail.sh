#!/bin/bash

# Read session information from session_info.txt
PHPSESSID=$(head -n 1 session_info.txt)
USER_ID=$(tail -n 1 session_info.txt)
Message=1

# Ensure variables are not empty
if [ -z "$PHPSESSID" ] || [ -z "$USER_ID" ]; then
    echo "Failed to retrieve session information."
    exit 1
fi

# Construct the URL for the user email page
MAIL_PAGE_URL="http://127.0.0.1/pages/user/mail.php?id=$USER_ID"

# Use PHPSESSID and form data to send a POST request
response=$(curl -i -L -X POST "$MAIL_PAGE_URL" \
    -b "PHPSESSID=$PHPSESSID")

# Check HTTP status code and if there are new emails
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    if echo "$response" | grep -q "$Message"; then
        echo "Receving email succeeded"
    else
        echo "Receving email do not contain the name: $Message"
        echo "Receving email might be incomplete."
        echo $0 >> failed_log.txt
    fi
    
else
    echo "Failed to receive the email ."
    echo $0 >> failed_log.txt
fi
echo "----------------------------------------"