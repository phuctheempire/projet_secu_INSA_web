CREATE TABLE LOG_Cours_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    operation_type VARCHAR(10), -- Type de l'opération (INSERT, UPDATE, DELETE)
    table_name VARCHAR(50),    -- Nom de la table (ici "Cours_info")
    row_id INT,                -- ID de la ligne affectée (stu_id pour cette table)
    changed_fields TEXT,       -- Champs modifiés (nom des colonnes)
    old_values TEXT,           -- Anciennes valeurs (JSON)
    new_values TEXT,           -- Nouvelles valeurs (JSON)
    operation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
