USE emensawerbeseite;

CREATE TABLE IF NOT EXISTS wunschgericht (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    vorname VARCHAR(80) NOT NULL,
    email VARCHAR(80) NOT NULL,
    gerichtname VARCHAR(80) NOT NULL,
    beschreibung VARCHAR(1500) NOT NULL,
    hinzugefügt_am DATETIME DEFAULT CURRENT_TIMESTAMP
    );


SELECT *
FROM wunschgericht
ORDER BY hinzugefügt_am DESC
LIMIT 5;