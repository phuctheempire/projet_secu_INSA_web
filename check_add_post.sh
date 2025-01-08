#!/bin/bash

# Read session information from session_info.txt
PHPSESSID=$(head -n 1 session_info.txt)

# Ensure variables are not empty
if [ -z "$PHPSESSID" ]; then
    echo "Failed to retrieve session information."
    exit 1
fi

# Construct the URL for the user email page
POST_PAGE_URL="http://localhost/pages/user/new_post.php"

# Use PHPSESSID and form data to send a POST request
response=$(curl -i -L -X POST "$POST_PAGE_URL" \
    -b "PHPSESSID=$PHPSESSID" \
    -d "title=2" \
    -d "content=2" \
    -d "add_post=""")

# Check HTTP status code and if there are new emails
echo "----------------------------------------"
if echo "$response" | grep -q "200 OK"; then
    echo "HTTP request succeeded"
else
    echo "Failed to add the post ."
fi
echo "----------------------------------------"