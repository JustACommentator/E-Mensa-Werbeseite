CREATE TABLE IF NOT EXISTS gerichte_bewertungen (
    benutzerid BIGINT NOT NULL,
    gerichtid BIGINT NOT NULL,
    bewertung TINYINT NOT NULL CHECK(bewertung BETWEEN 1 AND 4),
    verfasst_am DATETIME NOT NULL,
    kommentar VARCHAR(140) NOT NULL,
    hervorgehoben BOOLEAN,
    PRIMARY KEY (benutzerid, gerichtid),
    FOREIGN KEY (benutzerid) REFERENCES benutzer(id),
    FOREIGN KEY (gerichtid) REFERENCES gericht(id)
    );

CREATE PROCEDURE addReview (IN _benutzerID BIGINT, IN _gerichtID BIGINT, IN _bewertung TINYINT, IN _kommentar VARCHAR(140))
BEGIN
INSERT INTO gerichte_bewertungen(benutzerid, gerichtid, bewertung, kommentar, verfasst_am, hervorgehoben) VALUES
    (_benutzerID, _gerichtID, _bewertung, _kommentar, CURRENT_TIMESTAMP, FALSE)
    ON DUPLICATE KEY UPDATE bewertung = _bewertung, kommentar = _kommentar;
END;

CREATE PROCEDURE getReviews ()
BEGIN
SELECT * FROM gerichte_bewertungen
ORDER BY verfasst_am DESC
    LIMIT 30;
END;

CREATE PROCEDURE getOwnReviews (IN _benutzerID BIGINT)
BEGIN
SELECT * FROM gerichte_bewertungen
WHERE benutzerid = _benutzerID
            ORDER BY verfasst_am DESC;
END;

CREATE PROCEDURE deleteReview (IN _benutzerID BIGINT, IN _gerichtID BIGINT)
BEGIN
DELETE FROM gerichte_bewertungen
WHERE benutzerid = _benutzerID AND gerichtid =  _gerichtID;
END;