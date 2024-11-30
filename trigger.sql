DELIMITER //
CREATE TRIGGER after_insert_users
AFTER INSERT ON Users
FOR EACH ROW
BEGIN
    INSERT INTO Log (operation_type, table_name, row_id, new_values)
    VALUES (
        'INSERT',
        'Users',
        NEW.id,
        JSON_OBJECT(
            'email', NEW.email,
            'password', NEW.password,
            'nom', NEW.nom,
            'prenom', NEW.prenom,
            'sexe', NEW.sexe,
            'date_naissance', NEW.date_naissance,
            'adresse', NEW.adresse,
            'telephone', NEW.telephone,
            'image_path', NEW.image_path,
            'role', NEW.role
        )
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_update_users
AFTER UPDATE ON Users
FOR EACH ROW
BEGIN
    DECLARE changes TEXT;
    DECLARE old_vals JSON;
    DECLARE new_vals JSON;

    SET changes = '';
    SET old_vals = '{}';
    SET new_vals = '{}';

    -- Comparaison des colonnes
    IF OLD.email != NEW.email THEN
        SET changes = CONCAT_WS(',', changes, 'email');
        SET old_vals = JSON_SET(old_vals, '$.email', OLD.email);
        SET new_vals = JSON_SET(new_vals, '$.email', NEW.email);
    END IF;

    IF OLD.password != NEW.password THEN
        SET changes = CONCAT_WS(',', changes, 'password');
        SET old_vals = JSON_SET(old_vals, '$.password', OLD.password);
        SET new_vals = JSON_SET(new_vals, '$.password', NEW.password);
    END IF;

    IF OLD.nom != NEW.nom THEN
        SET changes = CONCAT_WS(',', changes, 'nom');
        SET old_vals = JSON_SET(old_vals, '$.nom', OLD.nom);
        SET new_vals = JSON_SET(new_vals, '$.nom', NEW.nom);
    END IF;

    IF OLD.prenom != NEW.prenom THEN
        SET changes = CONCAT_WS(',', changes, 'prenom');
        SET old_vals = JSON_SET(old_vals, '$.prenom', OLD.prenom);
        SET new_vals = JSON_SET(new_vals, '$.prenom', NEW.prenom);
    END IF;

    -- Répéter pour les autres colonnes
    IF OLD.sexe != NEW.sexe THEN
        SET changes = CONCAT_WS(',', changes, 'sexe');
        SET old_vals = JSON_SET(old_vals, '$.sexe', OLD.sexe);
        SET new_vals = JSON_SET(new_vals, '$.sexe', NEW.sexe);
    END IF;

    IF OLD.date_naissance != NEW.date_naissance THEN
        SET changes = CONCAT_WS(',', changes, 'date_naissance');
        SET old_vals = JSON_SET(old_vals, '$.date_naissance', OLD.date_naissance);
        SET new_vals = JSON_SET(new_vals, '$.date_naissance', NEW.date_naissance);
    END IF;

    IF OLD.adresse != NEW.adresse THEN
        SET changes = CONCAT_WS(',', changes, 'adresse');
        SET old_vals = JSON_SET(old_vals, '$.adresse', OLD.adresse);
        SET new_vals = JSON_SET(new_vals, '$.adresse', NEW.adresse);
    END IF;

    IF OLD.telephone != NEW.telephone THEN
        SET changes = CONCAT_WS(',', changes, 'telephone');
        SET old_vals = JSON_SET(old_vals, '$.telephone', OLD.telephone);
        SET new_vals = JSON_SET(new_vals, '$.telephone', NEW.telephone);
    END IF;

    IF OLD.image_path != NEW.image_path THEN
        SET changes = CONCAT_WS(',', changes, 'image_path');
        SET old_vals = JSON_SET(old_vals, '$.image_path', OLD.image_path);
        SET new_vals = JSON_SET(new_vals, '$.image_path', NEW.image_path);
    END IF;

    IF OLD.role != NEW.role THEN
        SET changes = CONCAT_WS(',', changes, 'role');
        SET old_vals = JSON_SET(old_vals, '$.role', OLD.role);
        SET new_vals = JSON_SET(new_vals, '$.role', NEW.role);
    END IF;

    -- Insérer dans la table Log
    INSERT INTO Log (operation_type, table_name, row_id, changed_fields, old_values, new_values)
    VALUES (
        'UPDATE',
        'Users',
        NEW.id,
        changes,
        old_vals,
        new_vals
    );
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_delete_users
AFTER DELETE ON Users
FOR EACH ROW
BEGIN
    INSERT INTO Log (operation_type, table_name, row_id, old_values)
    VALUES (
        'DELETE',
        'Users',
        OLD.id,
        JSON_OBJECT(
            'email', OLD.email,
            'password', OLD.password,
            'nom', OLD.nom,
            'prenom', OLD.prenom,
            'sexe', OLD.sexe,
            'date_naissance', OLD.date_naissance,
            'adresse', OLD.adresse,
            'telephone', OLD.telephone,
            'image_path', OLD.image_path,
            'role', OLD.role
        )
    );
END;
//
DELIMITER ;
