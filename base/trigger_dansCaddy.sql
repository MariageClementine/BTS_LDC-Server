-- trigger qui archive une liste quand elle a été completee

DELIMITER //
DROP TRIGGER IF EXISTS dbListeCoursesOrig.archivage //
CREATE TRIGGER dbListeCoursesOrig.archivage
AFTER update on contenuListe
FOR EACH ROW
BEGIN
    -- on declare les variables necessaires
	DECLARE COMPTEUR INT;

	-- on recup  
	SELECT count(*)
	INTO COMPTEUR
	FROM contenuListe
	WHERE dansCaddy = 0
	AND listeId=NEW.listeId;

	-- si plus rien
	IF (COMPTEUR=0)
	THEN 
		UPDATE liste set enCours=0 WHERE listeId= NEW.listeId;
	END IF;

END//
DELIMITER ; 