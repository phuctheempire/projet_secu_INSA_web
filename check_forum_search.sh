#!/bin/bash

# Set the URL and POST data to check
Search="1"
EMAIL="1"
URL="http://localhost/pages/public/forum.php?recherche=$Search&search-btn="

# Function to check the search functionality
check_forum_search() {
    echo "Checking forum search functionality..."

    # Send POST request with curl and get the response, including all redirected responses
    response=$(curl -L -i -X POST "$URL")

    echo "----------------------------------------"
    
    # Check if the HTTP status code is 200 OK
    if echo "$response" | grep -q "200 OK"; then
        echo "HTTP Success"

        # Check if the response contains the SEARCH_NAME
        if echo "$response" | grep -q "$EMAIL"; then
            echo "Search results contain the name: $EMAIL"
            echo "Search functionality is working as expected."
        else
            echo "Search results do not contain the name: $EMAIL"
            echo "Search functionality might be incomplete."
            echo $0 >> failed_log.txt
        fi


    else
        # Deduct 200 points every minute if contact retrieval fails
        echo "Search functionality failed, HTTP status code not 200."
        echo $0 >> failed_log.txt
    fi

    echo "----------------------------------------"
}

# Execute the search functionality check
check_forum_search
