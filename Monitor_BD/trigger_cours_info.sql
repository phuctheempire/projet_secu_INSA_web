DELIMITER //
CREATE TRIGGER after_insert_cours_info
AFTER INSERT ON Cours_info
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Cours_info (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Cours_info',
        NEW.stu_id,
        JSON_OBJECT(
            'matier_id', NEW.matier_id,
            'note', NEW.note
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_cours_info
AFTER UPDATE ON Cours_info
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.matier_id != NEW.matier_id THEN
        SET changes = CONCAT_WS(',', changes, 'matier_id');
        SET old_vals = JSON_SET(old_vals, '$.matier_id', OLD.matier_id);
        SET new_vals = JSON_SET(new_vals, '$.matier_id', NEW.matier_id);
    END IF;

    IF OLD.note != NEW.note THEN
        SET changes = CONCAT_WS(',', changes, 'note');
        SET old_vals = JSON_SET(old_vals, '$.note', OLD.note);
        SET new_vals = JSON_SET(new_vals, '$.note', NEW.note);
    END IF;

    -- Insérer dans la table LOG_Cours_info
    INSERT INTO LOG_Cours_info (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Cours_info',
        NEW.stu_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_cours_info
AFTER DELETE ON Cours_info
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Cours_info (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Cours_info',
        OLD.stu_id,
        JSON_OBJECT(
            'matier_id', OLD.matier_id,
            'note', OLD.note
        )
    );
END;
//
DELIMITER ;
