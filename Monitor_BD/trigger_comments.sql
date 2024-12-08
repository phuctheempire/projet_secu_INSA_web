DELIMITER //
CREATE TRIGGER after_insert_comments
AFTER INSERT ON Comments
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Comments (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Comments',
        NEW.comment_id,
        JSON_OBJECT(
            'author_id', NEW.author_id,
            'annon_id', NEW.annon_id,
            'content', NEW.content,
            'date', NEW.date
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_comments
AFTER UPDATE ON Comments
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

    IF OLD.annon_id != NEW.annon_id THEN
        SET changes = CONCAT_WS(',', changes, 'annon_id');
        SET old_vals = JSON_SET(old_vals, '$.annon_id', OLD.annon_id);
        SET new_vals = JSON_SET(new_vals, '$.annon_id', NEW.annon_id);
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

    -- Insérer dans la table LOG_Comments
    INSERT INTO LOG_Comments (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Comments',
        NEW.comment_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_comments
AFTER DELETE ON Comments
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Comments (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Comments',
        OLD.comment_id,
        JSON_OBJECT(
            'author_id', OLD.author_id,
            'annon_id', OLD.annon_id,
            'content', OLD.content,
            'date', OLD.date
        )
    );
END;
//
DELIMITER ;
