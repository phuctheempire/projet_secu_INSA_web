#!/bin/bash

# Read session information from session_info.txt
PHPSESSID=$(head -n 1 session_info.txt)
USER_ID=$(tail -n 1 session_info.txt)

# Ensure variables are not empty
if [ -z "$PHPSESSID" ] || [ -z "$USER_ID" ]; then
    echo "Failed to retrieve session information."
    exit 1
fi

# Construct the URL for the user email page
MAIL_PAGE_URL="http://127.0.0.1/pages/user/send_email.php?id=$USER_ID"

# Use PHPSESSID and form data to send a POST request
response=$(curl -i -L -X POST "$MAIL_PAGE_URL" \
    -b "PHPSESSID=$PHPSESSID" \
    -d "receiver_emails=1" \
    -d "title=1" \
    -d "content=1" \
    -d "send_email=""")

# Check HTTP status code and if there are new emails
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "Sending email succeeded"
else
    echo "Failed to send the email ."
fi
echo "----------------------------------------"