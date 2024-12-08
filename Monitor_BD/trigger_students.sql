DELIMITER //
CREATE TRIGGER after_insert_students
AFTER INSERT ON Students
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Students (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Students',
        NEW.stu_id,
        JSON_OBJECT(
            'departement', NEW.departement,
            'promo', NEW.promo,
            'group_td', NEW.group_td,
            'group_tp', NEW.group_tp,
            'group_anglais', NEW.group_anglais
        )
    );
END;
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER after_update_students
AFTER UPDATE ON Students
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

    IF OLD.promo != NEW.promo THEN
        SET changes = CONCAT_WS(',', changes, 'promo');
        SET old_vals = JSON_SET(old_vals, '$.promo', OLD.promo);
        SET new_vals = JSON_SET(new_vals, '$.promo', NEW.promo);
    END IF;

    IF OLD.group_td != NEW.group_td THEN
        SET changes = CONCAT_WS(',', changes, 'group_td');
        SET old_vals = JSON_SET(old_vals, '$.group_td', OLD.group_td);
        SET new_vals = JSON_SET(new_vals, '$.group_td', NEW.group_td);
    END IF;

    IF OLD.group_tp != NEW.group_tp THEN
        SET changes = CONCAT_WS(',', changes, 'group_tp');
        SET old_vals = JSON_SET(old_vals, '$.group_tp', OLD.group_tp);
        SET new_vals = JSON_SET(new_vals, '$.group_tp', NEW.group_tp);
    END IF;

    IF OLD.group_anglais != NEW.group_anglais THEN
        SET changes = CONCAT_WS(',', changes, 'group_anglais');
        SET old_vals = JSON_SET(old_vals, '$.group_anglais', OLD.group_anglais);
        SET new_vals = JSON_SET(new_vals, '$.group_anglais', NEW.group_anglais);
    END IF;

    -- Insérer dans la table LOG_Students
    INSERT INTO LOG_Students (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Students',
        NEW.stu_id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_students
AFTER DELETE ON Students
FOR EACH ROW
BEGIN
    INSERT INTO LOG_Students (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Students',
        OLD.stu_id,
        JSON_OBJECT(
            'departement', OLD.departement,
            'promo', OLD.promo,
            'group_td', OLD.group_td,
            'group_tp', OLD.group_tp,
            'group_anglais', OLD.group_anglais
        )
    );
END;
//
DELIMITER ;



