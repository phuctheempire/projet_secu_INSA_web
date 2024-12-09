<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "note_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
<div class="card" id="notes-section">
    <h1 class="document-title">Gestion des notes</h1>
    <?php foreach ($notes as $note) { ?>
        <div class="note-box">
            <h3 class="note-name"><?php echo $note["nom"]." ".$note["prenom"]; ?></h3>
            <p class="note-note"><?php echo $note["note"]; ?></p>
        </div>
    <?php } ?>
    <button id="modify-notes-btn" class="btn-modify">Modify Notes</button>
</div>

<script>
// JavaScript function to replace the section with a form
document.getElementById("modify-notes-btn").addEventListener("click", function() {
    // Create a new form element
    const formHTML = `
        <form id="modify-notes-form" action="note_info.php?cours_id=<?php echo $_GET['cours_id']?>" class="modify-form" method="POST">
            <h1 class="document-title">Modify Notes</h1>
            <?php foreach ($notes as $note) { ?>
                <div class="form-group">
                    <label for="note[<?php echo $note['id']; ?>]">
                        <?php echo $note["nom"]." ".$note["prenom"]; ?>
                    </label>
                    <input type="text" id="note-<?php echo $note['id']; ?>" name="note[<?php echo $note['id'] ?>]" 
                           value="<?php echo $note["note"]; ?>" class="form-input">
                </div>
            <?php } ?>
            <button type="submit" class="form-button" name="mod_note_btn">Save Changes</button>
        </form>
    `;
    
    // Replace the card content with the form
    document.getElementById("notes-section").innerHTML = formHTML;
});
</script>

    </div>
</body>