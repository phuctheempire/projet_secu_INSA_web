DELIMITER //
CREATE TRIGGER after_insert_annoncement
AFTER INSERT ON Annoncement
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Annoncement (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Annoncement',
        NEW.annon_id,
        JSON_OBJECT(
            'author_id', NEW.author_id,
            'matier_id', NEW.matier_id,
            'title', NEW.title,
            'content', NEW.content,
            'date', NEW.date
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_annoncement
AFTER UPDATE ON Annoncement
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.author_id != NEW.author_id THEN
        SET changes = CONCAT_WS(',', changes, 'author_id');
        SET old_vals = JSON_SET(old_vals, '$.author_id', OLD.author_id);
        SET new_vals = JSON_SET(new_vals, '$.author_id', NEW.author_id);
    END IF;

    IF OLD.matier_id != NEW.matier_id THEN
        SET changes = CONCAT_WS(',', changes, 'matier_id');
        SET old_vals = JSON_SET(old_vals, '$.matier_id', OLD.matier_id);
        SET new_vals = JSON_SET(new_vals, '$.matier_id', NEW.matier_id);
    END IF;

    IF OLD.title != NEW.title THEN
        SET changes = CONCAT_WS(',', changes, 'title');
        SET old_vals = JSON_SET(old_vals, '$.title', OLD.title);
        SET new_vals = JSON_SET(new_vals, '$.title', NEW.title);
    END IF;

    IF OLD.content != NEW.content THEN
        SET changes = CONCAT_WS(',', changes, 'content');
        SET old_vals = JSON_SET(old_vals, '$.content', OLD.content);
        SET new_vals = JSON_SET(new_vals, '$.content', NEW.content);
    END IF;

    IF OLD.date != NEW.date THEN
        SET changes = CONCAT_WS(',', changes, 'date');
        SET old_vals = JSON_SET(old_vals, '$.date', OLD.date);
        SET new_vals = JSON_SET(new_vals, '$.date', NEW.date);
    END IF;

    -- Insérer dans la table LOG_Annoncement
    INSERT INTO LOG_Annoncement (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Annoncement',
        NEW.annon_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_annoncement
AFTER DELETE ON Annoncement
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Annoncement (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Annoncement',
        OLD.annon_id,
        JSON_OBJECT(
            'author_id', OLD.author_id,
            'matier_id', OLD.matier_id,
            'title', OLD.title,
            'content', OLD.content,
            'date', OLD.date
        )
    );
END;
//
DELIMITER ;
