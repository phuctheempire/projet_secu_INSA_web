DELIMITER //
CREATE TRIGGER after_insert_documents
AFTER INSERT ON Documents
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Documents (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Documents',
        NEW.doc_id,
        JSON_OBJECT(
            'author_id', NEW.author_id,
            'mattier_id', NEW.mattier_id,
            'title', NEW.title,
            'name', NEW.name,
            'date', NEW.date,
            'section', NEW.section,
            'path', NEW.path
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_documents
AFTER UPDATE ON Documents
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

    IF OLD.mattier_id != NEW.mattier_id THEN
        SET changes = CONCAT_WS(',', changes, 'mattier_id');
        SET old_vals = JSON_SET(old_vals, '$.mattier_id', OLD.mattier_id);
        SET new_vals = JSON_SET(new_vals, '$.mattier_id', NEW.mattier_id);
    END IF;

    IF OLD.title != NEW.title THEN
        SET changes = CONCAT_WS(',', changes, 'title');
        SET old_vals = JSON_SET(old_vals, '$.title', OLD.title);
        SET new_vals = JSON_SET(new_vals, '$.title', NEW.title);
    END IF;

    IF OLD.name != NEW.name THEN
        SET changes = CONCAT_WS(',', changes, 'name');
        SET old_vals = JSON_SET(old_vals, '$.name', OLD.name);
        SET new_vals = JSON_SET(new_vals, '$.name', NEW.name);
    END IF;

    IF OLD.date != NEW.date THEN
        SET changes = CONCAT_WS(',', changes, 'date');
        SET old_vals = JSON_SET(old_vals, '$.date', OLD.date);
        SET new_vals = JSON_SET(new_vals, '$.date', NEW.date);
    END IF;

    IF OLD.section != NEW.section THEN
        SET changes = CONCAT_WS(',', changes, 'section');
        SET old_vals = JSON_SET(old_vals, '$.section', OLD.section);
        SET new_vals = JSON_SET(new_vals, '$.section', NEW.section);
    END IF;

    IF OLD.path != NEW.path THEN
        SET changes = CONCAT_WS(',', changes, 'path');
        SET old_vals = JSON_SET(old_vals, '$.path', OLD.path);
        SET new_vals = JSON_SET(new_vals, '$.path', NEW.path);
    END IF;

    -- Insérer dans la table LOG_Documents
    INSERT INTO LOG_Documents (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Documents',
        NEW.doc_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_documents
AFTER DELETE ON Documents
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Documents (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Documents',
        OLD.doc_id,
        JSON_OBJECT(
            'author_id', OLD.author_id,
            'mattier_id', OLD.mattier_id,
            'title', OLD.title,
            'name', OLD.name,
            'date', OLD.date,
            'section', OLD.section,
            'path', OLD.path
        )
    );
END;
//
DELIMITER ;
