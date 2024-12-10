URL="http://127.0.0.1/pages/public/register.php"
DATA="nom=Constans&prenom=Mathis&email=tom@gmail.com&departement=STI&sexe=M&date_naissance=2003-11-27&adresse=123 rue Exemple&telephone=0606060706&annee=2A&password1=1234&password2=1234"
REGISTER_BTN=""

# Initial points
points=2000

response=$(curl -L -i -X POST $URL -d "DATA" -d "register_btn=$REGISTER_BTN")

echo "----------------------------------------"
    # Check if the HTTP status code is 200 OK
    if echo "$response" | grep -q "200 OK"; then
        echo "HTTP Success"

        if echo "$response" | grep -q "User already exists"; then
          echo "User already register. Launch check_login.sh..."
          ./check_login.sh 
        else
          echo "Enregistrement réussi !"
        fi

    else
        # Deduct 200 points every minute if login fails
        points=$((points - 200))
        echo "Register failed, HTTP status code: $http_status"
        echo "Current points: $points"
    fi
echo "----------------------------------------"
