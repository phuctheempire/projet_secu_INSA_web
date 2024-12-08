DELIMITER //
CREATE TRIGGER after_insert_professeur
AFTER INSERT ON Professeur
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Professeur (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Professeur',
        NEW.prof_id,
        JSON_OBJECT(
            'departement', NEW.departement
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_professeur
AFTER UPDATE ON Professeur
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.departement != NEW.departement THEN
        SET changes = CONCAT_WS(',', changes, 'departement');
        SET old_vals = JSON_SET(old_vals, '$.departement', OLD.departement);
        SET new_vals = JSON_SET(new_vals, '$.departement', NEW.departement);
    END IF;

    -- Insérer dans la table LOG_Professeur
    INSERT INTO LOG_Professeur (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Professeur',
        NEW.prof_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_professeur
AFTER DELETE ON Professeur
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Professeur (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Professeur',
        OLD.prof_id,
        JSON_OBJECT(
            'departement', OLD.departement
        )
    );
END;
//
DELIMITER ;
