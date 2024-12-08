DELIMITER //
CREATE TRIGGER after_insert_posts
AFTER INSERT ON Posts
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Posts (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Posts',
        NEW.post_id,
        JSON_OBJECT(
            'author_id', NEW.author_id,
            'title', NEW.title,
            'content', NEW.content,
            'image_path', NEW.image_path,
            'date', NEW.date
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_posts
AFTER UPDATE ON Posts
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

    IF OLD.image_path != NEW.image_path THEN
        SET changes = CONCAT_WS(',', changes, 'image_path');
        SET old_vals = JSON_SET(old_vals, '$.image_path', OLD.image_path);
        SET new_vals = JSON_SET(new_vals, '$.image_path', NEW.image_path);
    END IF;

    IF OLD.date != NEW.date THEN
        SET changes = CONCAT_WS(',', changes, 'date');
        SET old_vals = JSON_SET(old_vals, '$.date', OLD.date);
        SET new_vals = JSON_SET(new_vals, '$.date', NEW.date);
    END IF;

    -- Insérer dans la table LOG_Posts
    INSERT INTO LOG_Posts (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Posts',
        NEW.post_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_posts
AFTER DELETE ON Posts
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Posts (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Posts',
        OLD.post_id,
        JSON_OBJECT(
            'author_id', OLD.author_id,
            'title', OLD.title,
            'content', OLD.content,
            'image_path', OLD.image_path,
            'date', OLD.date
        )
    );
END;
//
DELIMITER ;
