CREATE TABLE LOG_Classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    operation_type VARCHAR(10), -- Type de l'opération (INSERT, UPDATE, DELETE)
    table_name VARCHAR(50),    -- Nom de la table (ici "Classes")
    row_id INT,                -- ID unique généré pour l'enregistrement (prof_id est utilisé ici comme identifiant)
    changed_fields TEXT,       -- Champs modifiés (nom des colonnes)
    old_values TEXT,           -- Anciennes valeurs (JSON)
    new_values TEXT,           -- Nouvelles valeurs (JSON)
    operation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
