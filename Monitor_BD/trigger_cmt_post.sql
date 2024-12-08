DELIMITER //
CREATE TRIGGER after_insert_cmt_post
AFTER INSERT ON Cmt_post
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Cmt_post (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Cmt_post',
        NEW.cmt_id,
        JSON_OBJECT(
            'author_id', NEW.author_id,
            'post_id', NEW.post_id,
            'content', NEW.content,
            'date', NEW.date
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_cmt_post
AFTER UPDATE ON Cmt_post
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

    IF OLD.post_id != NEW.post_id THEN
        SET changes = CONCAT_WS(',', changes, 'post_id');
        SET old_vals = JSON_SET(old_vals, '$.post_id', OLD.post_id);
        SET new_vals = JSON_SET(new_vals, '$.post_id', NEW.post_id);
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

    -- Insérer dans la table LOG_Cmt_post
    INSERT INTO LOG_Cmt_post (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Cmt_post',
        NEW.cmt_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_cmt_post
AFTER DELETE ON Cmt_post
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Cmt_post (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Cmt_post',
        OLD.cmt_id,
        JSON_OBJECT(
            'author_id', OLD.author_id,
            'post_id', OLD.post_id,
            'content', OLD.content,
            'date', OLD.date
        )
    );
END;
//
DELIMITER ;
