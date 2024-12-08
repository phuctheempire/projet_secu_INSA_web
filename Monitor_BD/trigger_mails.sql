DELIMITER //
CREATE TRIGGER after_insert_mails
AFTER INSERT ON Mails
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Mails (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Mails',
        NEW.mail_id,
        JSON_OBJECT(
            'sender_id', NEW.sender_id,
            'receiver_id', NEW.receiver_id,
            'title', NEW.title,
            'content', NEW.content,
            'date', NEW.date
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_mails
AFTER UPDATE ON Mails
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.sender_id != NEW.sender_id THEN
        SET changes = CONCAT_WS(',', changes, 'sender_id');
        SET old_vals = JSON_SET(old_vals, '$.sender_id', OLD.sender_id);
        SET new_vals = JSON_SET(new_vals, '$.sender_id', NEW.sender_id);
    END IF;

    IF OLD.receiver_id != NEW.receiver_id THEN
        SET changes = CONCAT_WS(',', changes, 'receiver_id');
        SET old_vals = JSON_SET(old_vals, '$.receiver_id', OLD.receiver_id);
        SET new_vals = JSON_SET(new_vals, '$.receiver_id', NEW.receiver_id);
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

    -- Insérer dans la table LOG_Mails
    INSERT INTO LOG_Mails (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Mails',
        NEW.mail_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_mails
AFTER DELETE ON Mails
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Mails (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Mails',
        OLD.mail_id,
        JSON_OBJECT(
            'sender_id', OLD.sender_id,
            'receiver_id', OLD.receiver_id,
            'title', OLD.title,
            'content', OLD.content,
            'date', OLD.date
        )
    );
END;
//
DELIMITER ;
