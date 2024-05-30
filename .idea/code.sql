CREATE TABLE ATTACHEMENT (
  id_attachement VARCHAR(42) NOT NULL,
  url_attachement VARCHAR(42),
  id_consultation VARCHAR(42) NOT NULL,

  PRIMARY KEY (id_attachement)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE CONSULTATION (
  id_consultation VARCHAR(42) NOT NULL,
  motif_consultation VARCHAR(42),
  flag_visioconference VARCHAR(42),
  id_medecin VARCHAR(42) NOT NULL,
  id_patient VARCHAR(42) NOT NULL,
  id_creneau VARCHAR(42) NOT NULL,

  PRIMARY KEY (id_consultation)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE CRENEAU (
  id_creneau VARCHAR(42) NOT NULL,
  date_heure_debut DATETIME,
  date_heure_fin DATETIME,
  flag_statut VARCHAR(42),

  PRIMARY KEY (id_creneau)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;


CREATE TABLE MEDECIN (
  id_medecin VARCHAR(42) NOT NULL,
  Specialite VARCHAR(42),
  Nom VARCHAR(42),
  Prenom VARCHAR(42),
  Date_Naissance VARCHAR(10),  
  Sexe CHAR(1),         
  N_Securite_Social VARCHAR(13),
  password VARCHAR(150),

  PRIMARY KEY (id_medecin)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE PATIENT (
  id_patient VARCHAR(42) NOT NULL,
  Nom VARCHAR(42),
  Prenom VARCHAR(42),
  Date_Naissance VARCHAR(10), 
  Sexe CHAR(1),        
  N_Securite_Social VARCHAR(13),
  password VARCHAR(150),
  
  PRIMARY KEY (id_patient)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

ALTER TABLE ATTACHEMENT ADD FOREIGN KEY (id_consultation) REFERENCES CONSULTATION (id_consultation);

ALTER TABLE CONSULTATION ADD FOREIGN KEY (id_creneau) REFERENCES CRENEAU (id_creneau);
ALTER TABLE CONSULTATION ADD FOREIGN KEY (id_patient) REFERENCES PATIENT (id_patient);
ALTER TABLE CONSULTATION ADD FOREIGN KEY (id_medecin) REFERENCES MEDECIN (id_medecin);
