
# -----------------------------------------------------------------------------
#       TABLE : COMPETENCE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPETENCE
 (
   COM_ID INTEGER(4) NOT NULL  ,
   NIV_ID INTEGER(4) NOT NULL  ,
   COM_LIBELLE CHAR(64) NOT NULL  
   , PRIMARY KEY (COM_ID,NIV_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COMPETENCE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_COMPETENCE_NIVEAU
     ON COMPETENCE (NIV_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : NIVEAU
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NIVEAU
 (
   NIV_ID INTEGER(4) NOT NULL  ,
   NIV_DESCRIPTION CHAR(128) NULL  
   , PRIMARY KEY (NIV_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEUR
 (
   UTI_ID INTEGER(4) NOT NULL AUTO_INCREMENT ,
   NIV_ID INTEGER(4) NOT NULL  ,
   CLU_ID INTEGER(4) NOT NULL  ,
   UTI_NOM CHAR(32) NOT NULL  ,
   UTI_PRENOM CHAR(32) NOT NULL  ,
   UTI_MAIL CHAR(32) NOT NULL  ,
   UTI_MDP CHAR(32) NOT NULL  ,
   UTI_DATE_ARCHIVAGE CHAR(32) NULL  ,
   UTI_EST_INIT BOOL NULL  
   , PRIMARY KEY (UTI_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE UTILISATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_UTILISATEUR_NIVEAU
     ON UTILISATEUR (NIV_ID ASC);

CREATE  INDEX I_FK_UTILISATEUR_CLUB
     ON UTILISATEUR (CLU_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : APTITUDE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APTITUDE
 (
   APT_ID INTEGER(4) NOT NULL AUTO_INCREMENT ,
   COM_ID INTEGER(4) NOT NULL  ,
   NIV_ID INTEGER(4) NOT NULL  ,
   APT_LIBELLE CHAR(32) NOT NULL  
   , PRIMARY KEY (APT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE APTITUDE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_APTITUDE_COMPETENCE
     ON APTITUDE (COM_ID ASC,NIV_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : CLUB
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLUB
 (
   CLU_ID INTEGER(4) NOT NULL AUTO_INCREMENT ,
   UTI_ID INTEGER(4) NOT NULL  ,
   CLU_NOM CHAR(32) NOT NULL  ,
   CLU_VILLE CHAR(32) NULL  
   , PRIMARY KEY (CLU_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CLUB
# -----------------------------------------------------------------------------


CREATE UNIQUE INDEX I_FK_CLUB_UTILISATEUR
     ON CLUB (UTI_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : FORMATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FORMATION
 (
   FOR_ID INTEGER(4) NOT NULL AUTO_INCREMENT ,
   NIV_ID INTEGER(4) NOT NULL  ,
   UTI_ID INTEGER(4) NOT NULL  ,
   CLU_ID INTEGER(4) NOT NULL  ,
   FOR_ANNEE INTEGER(2) NOT NULL  
   , PRIMARY KEY (FOR_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FORMATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FORMATION_NIVEAU
     ON FORMATION (NIV_ID ASC);

CREATE  INDEX I_FK_FORMATION_UTILISATEUR
     ON FORMATION (UTI_ID ASC);

CREATE  INDEX I_FK_FORMATION_CLUB
     ON FORMATION (CLU_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : COURS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COURS
 (
   COU_ID INTEGER(4) NOT NULL AUTO_INCREMENT ,
   FOR_ID INTEGER(4) NOT NULL  ,
   COU_DATE DATE NULL  
   , PRIMARY KEY (COU_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COURS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_COURS_FORMATION
     ON COURS (FOR_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : INITIER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INITIER
 (
   FOR_ID INTEGER(4) NOT NULL  ,
   UTI_ID INTEGER(4) NOT NULL  
   , PRIMARY KEY (FOR_ID,UTI_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE INITIER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_INITIER_FORMATION
     ON INITIER (FOR_ID ASC);

CREATE  INDEX I_FK_INITIER_UTILISATEUR
     ON INITIER (UTI_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : APPRENDRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APPRENDRE
 (
   FOR_ID INTEGER(4) NOT NULL  ,
   UTI_ID INTEGER(4) NOT NULL  
   , PRIMARY KEY (FOR_ID,UTI_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE APPRENDRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_APPRENDRE_FORMATION
     ON APPRENDRE (FOR_ID ASC);

CREATE  INDEX I_FK_APPRENDRE_UTILISATEUR
     ON APPRENDRE (UTI_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : MAITRISER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MAITRISER
 (
   COU_ID INTEGER(4) NOT NULL  ,
   UTI_ID INTEGER(4) NOT NULL  ,
   APT_ID INTEGER(4) NOT NULL  ,
   MAI_PROGRESS CHAR(32) NULL  ,
   MAI_COMMENTAIRE CHAR(32) NULL  
   , PRIMARY KEY (COU_ID,UTI_ID,APT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE MAITRISER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_MAITRISER_COURS
     ON MAITRISER (COU_ID ASC);

CREATE  INDEX I_FK_MAITRISER_UTILISATEUR
     ON MAITRISER (UTI_ID ASC);

CREATE  INDEX I_FK_MAITRISER_APTITUDE
     ON MAITRISER (APT_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : GROUPE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS GROUPE
 (
   COU_ID INTEGER(4) NOT NULL ,
   UTI_ID_ELV2 INTEGER(4) NULL  ,
   UTI_ID_ELV1 INTEGER(4) NOT NULL  ,
   UTI_ID_INIT INTEGER(4) NOT NULL  ,
   GRO_ID INTEGER(4) NOT NULL AUTO_INCREMENT 
   , PRIMARY KEY (GRO_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE GROUPE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_GROUPE_COURS
     ON GROUPE (COU_ID ASC);

CREATE  INDEX I_FK_GROUPE_UTILISATEUR
     ON GROUPE (UTI_ID_ELV2 ASC);

CREATE  INDEX I_FK_GROUPE_UTILISATEUR2
     ON GROUPE (UTI_ID_ELV1 ASC);

CREATE  INDEX I_FK_GROUPE_UTILISATEUR3
     ON GROUPE (UTI_ID_INIT ASC);

# -----------------------------------------------------------------------------
#       TABLE : VALIDE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VALIDER
 (
   UTI_ID INTEGER(4) NOT NULL  ,
   APT_ID INTEGER(4) NOT NULL  ,
   VAL_STATUT CHAR(32) NULL  
   , PRIMARY KEY (UTI_ID,APT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VALIDE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VALIDE_UTILISATEUR
     ON VALIDER (UTI_ID ASC);

CREATE  INDEX I_FK_VALIDE_APTITUDE
     ON VALIDER (APT_ID ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE COMPETENCE 
  ADD FOREIGN KEY FK_COMPETENCE_NIVEAU (NIV_ID)
      REFERENCES NIVEAU (NIV_ID) ;


ALTER TABLE UTILISATEUR 
  ADD FOREIGN KEY FK_UTILISATEUR_NIVEAU (NIV_ID)
      REFERENCES NIVEAU (NIV_ID) ;


ALTER TABLE UTILISATEUR 
  ADD FOREIGN KEY FK_UTILISATEUR_CLUB (CLU_ID)
      REFERENCES CLUB (CLU_ID) ;


ALTER TABLE APTITUDE 
  ADD FOREIGN KEY FK_APTITUDE_COMPETENCE (COM_ID,NIV_ID)
      REFERENCES COMPETENCE (COM_ID,NIV_ID) ;


ALTER TABLE CLUB 
  ADD FOREIGN KEY FK_CLUB_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE FORMATION 
  ADD FOREIGN KEY FK_FORMATION_NIVEAU (NIV_ID)
      REFERENCES NIVEAU (NIV_ID) ;


ALTER TABLE FORMATION 
  ADD FOREIGN KEY FK_FORMATION_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE FORMATION 
  ADD FOREIGN KEY FK_FORMATION_CLUB (CLU_ID)
      REFERENCES CLUB (CLU_ID) ;


ALTER TABLE COURS 
  ADD FOREIGN KEY FK_COURS_FORMATION (FOR_ID)
      REFERENCES FORMATION (FOR_ID) ;


ALTER TABLE INITIER 
  ADD FOREIGN KEY FK_INITIER_FORMATION (FOR_ID)
      REFERENCES FORMATION (FOR_ID) ;


ALTER TABLE INITIER 
  ADD FOREIGN KEY FK_INITIER_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE APPRENDRE 
  ADD FOREIGN KEY FK_APPRENDRE_FORMATION (FOR_ID)
      REFERENCES FORMATION (FOR_ID) ;


ALTER TABLE APPRENDRE 
  ADD FOREIGN KEY FK_APPRENDRE_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE MAITRISER 
  ADD FOREIGN KEY FK_MAITRISER_COURS (COU_ID)
      REFERENCES COURS (COU_ID) ;


ALTER TABLE MAITRISER 
  ADD FOREIGN KEY FK_MAITRISER_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE MAITRISER 
  ADD FOREIGN KEY FK_MAITRISER_APTITUDE (APT_ID)
      REFERENCES APTITUDE (APT_ID) ;


ALTER TABLE GROUPE 
  ADD FOREIGN KEY FK_GROUPE_COURS (COU_ID)
      REFERENCES COURS (COU_ID) ;


ALTER TABLE GROUPE 
  ADD FOREIGN KEY FK_GROUPE_UTILISATEUR (UTI_ID_ELV2)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE GROUPE 
  ADD FOREIGN KEY FK_GROUPE_UTILISATEUR2 (UTI_ID_ELV1)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE GROUPE 
  ADD FOREIGN KEY FK_GROUPE_UTILISATEUR3 (UTI_ID_INIT)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE VALIDER 
  ADD FOREIGN KEY FK_VALIDE_UTILISATEUR (UTI_ID)
      REFERENCES UTILISATEUR (UTI_ID) ;


ALTER TABLE VALIDER 
  ADD FOREIGN KEY FK_VALIDE_APTITUDE (APT_ID)
      REFERENCES APTITUDE (APT_ID) ;

