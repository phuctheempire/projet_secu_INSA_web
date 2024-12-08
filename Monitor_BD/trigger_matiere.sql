DELIMITER //
CREATE TRIGGER after_insert_matiere
AFTER INSERT ON Matiere
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Matiere (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Matiere',
        NEW.matier_id,
        JSON_OBJECT(
            'nom', NEW.nom
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_matiere
AFTER UPDATE ON Matiere
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.nom != NEW.nom THEN
        SET changes = 'nom';
        SET old_vals = JSON_SET(old_vals, '$.nom', OLD.nom);
        SET new_vals = JSON_SET(new_vals, '$.nom', NEW.nom);
    END IF;

    -- Insérer dans la table LOG_Matiere
    INSERT INTO LOG_Matiere (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Matiere',
        NEW.matier_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_matiere
AFTER DELETE ON Matiere
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Matiere (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Matiere',
        OLD.matier_id,
        JSON_OBJECT(
            'nom', OLD.nom
        )
    );
END;
//
DELIMITER ;
