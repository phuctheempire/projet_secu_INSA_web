#!/bin/bash

# Read session info from the file
PHPSESSID=$(head -n 1 session_info.txt)
USER_ID=$(tail -n 1 session_info.txt)

# Ensure the variables are not empty
if [ -z "$PHPSESSID" ] || [ -z "$USER_ID" ]; then
    echo "Failed to retrieve session info."
    exit 1
fi

# Construct the URL for the user page
USER_PAGE_URL="http://127.0.0.1/pages/user/user_page.php?id=$USER_ID"

# Access the user page using PHPSESSID
response=$(curl -i -L -X GET "$USER_PAGE_URL" -b "PHPSESSID=$PHPSESSID")

# Check if HTTP status is 200 OK and the email is in the response
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "HTTP Success"
    echo "$response" | grep -q "john.doe@insa-cvl.fr" && echo "Email address is present"
else
    echo "Access to user page failed or login failed"
fi
echo "----------------------------------------"
