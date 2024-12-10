#!/bin/bash

# Initial score
score=5000

# Service ports
services=("ssh:22:5" "http:80:10" "ftp:21:5")

# Check if a service is running
check_service() {
    local service_name=$1
    local port=$2
    local deduction=$3

    # Use ss or netstat to check if the service is running
    if ss -tuln | grep -q ":$port "; then
        echo "Service: $service_name | Port: $port | Status: Running"
    else
        echo "Service: $service_name | Port: $port | Status: Not Running | Deduction: $deduction"
        score=$((score - deduction))
    fi
}

# Monitor all services in a loop
monitor_services() {
    while true; do
        echo "----------------------------------------"
        echo "Starting service check..."
        echo "Current score: $score"
        echo "----------------------------------------"

        # Iterate through the service list
        for service_info in "${services[@]}"; do
            IFS=":" read -r name port penalty <<< "$service_info"
            check_service "$name" "$port" "$penalty"
        done

        echo "Check completed! Current score: $score"
        echo "----------------------------------------"

        # Stop monitoring if the score drops below or equal to 0
        if ((score <= 0)); then
            echo "Score has dropped to 0 or below. Stopping monitoring!"
            break
        fi

        # Check every minute
        sleep 60
    done
}

# Start monitoring services
monitor_services

