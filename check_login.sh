#!/bin/bash

# Set the URL and POST data to check
URL="http://127.0.0.1/pages/public/login.php"
EMAIL="john.doe@insa-cvl.fr"
PASSWORD="111"
LOGIN_BTN=""

# Initial points
points=2000

# Use curl to check the login function
check_login() {
    # Send POST request with curl and get the response, including all redirected responses
    response=$(curl -L -i -X POST $URL -d "email=$EMAIL" -d "password=$PASSWORD" -d "login_btn=$LOGIN_BTN")

    echo "----------------------------------------"
    # Check if the HTTP status code is 200 OK
    if echo "$response" | grep -q "200 OK"; then
        echo "HTTP Success"
        
        # Check if the response contains the EMAIL
        if echo "$response" | grep -q "$EMAIL"; then
            echo "Email address is present in the response, login successful"
        else
            echo "Email address is not present in the response, login might have failed"
        fi

        echo "Current points: $points"
    else
        # Deduct 200 points every minute if login fails
        points=$((points - 200))
        echo "Login failed, HTTP status code: $http_status"
        echo "Current points: $points"
    fi
    echo "----------------------------------------"
}

# Check login function
check_login