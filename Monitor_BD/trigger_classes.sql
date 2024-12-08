DELIMITER //
CREATE TRIGGER after_insert_classes
AFTER INSERT ON Classes
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Classes (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Classes',
        NEW.prof_id,
        JSON_OBJECT(
            'matier_id', NEW.matier_id
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_classes
AFTER UPDATE ON Classes
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

    -- Insérer dans la table LOG_Classes
    INSERT INTO LOG_Classes (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Classes',
        NEW.prof_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_classes
AFTER DELETE ON Classes
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Classes (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Classes',
        OLD.prof_id,
        JSON_OBJECT(
            'matier_id', OLD.matier_id
        )
    );
END;
//
DELIMITER ;
