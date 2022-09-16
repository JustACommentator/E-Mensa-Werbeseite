CREATE VIEW view_suppengerichte AS
SELECT * FROM gericht WHERE name LIKE '%suppe%'; #a


CREATE VIEW view_anmeldungen AS
SELECT email, anzahlanmeldungen FROM benutzer ORDER BY anzahlanmeldungen DESC; #b


CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT kategorie.name as Kategorie, gericht.name as Gericht
FROM gericht_hat_kategorie ghk
         INNER JOIN gericht
                    ON ghk.gericht_id = gericht.id AND gericht.vegetarisch = true
         RIGHT JOIN kategorie
                    ON ghk.kategorie_id = kategorie.id
ORDER BY gericht.name; #c