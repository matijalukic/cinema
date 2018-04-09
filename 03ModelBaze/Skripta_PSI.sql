
CREATE TABLE [Administrator]
( 
	[UsernameZ]          varchar(10)  NOT NULL 
)
go

ALTER TABLE [Administrator]
	ADD CONSTRAINT [XPKAdministrator] PRIMARY KEY  CLUSTERED ([UsernameZ] ASC)
go

CREATE TABLE [Bioskop]
( 
	[IdBioskop]          integer  NOT NULL ,
	[Naziv]              varchar(30)  NOT NULL ,
	[Adresa]             varchar(30)  NOT NULL 
)
go

ALTER TABLE [Bioskop]
	ADD CONSTRAINT [XPKBioskop] PRIMARY KEY  CLUSTERED ([IdBioskop] ASC)
go

CREATE TABLE [Film]
( 
	[IdFilm]             integer  NOT NULL ,
	[Naziv]              varchar(30)  NOT NULL ,
	[Zanr]               varchar(10)  NOT NULL ,
	[Trajanje]           datetime  NOT NULL ,
	[Opis]               varchar(100)  NOT NULL ,
	[Godina]             integer  NOT NULL ,
	[Reziser]            varchar(30)  NOT NULL ,
	[GlavnaUloga]        varchar(30)  NOT NULL 
)
go

ALTER TABLE [Film]
	ADD CONSTRAINT [XPKFilm] PRIMARY KEY  CLUSTERED ([IdFilm] ASC)
go

CREATE TABLE [Gost]
( 
	[idKorisnik]         integer  NOT NULL 
)
go

ALTER TABLE [Gost]
	ADD CONSTRAINT [XPKGost] PRIMARY KEY  CLUSTERED ([idKorisnik] ASC)
go

CREATE TABLE [Karta]
( 
	[Cena]               integer  NOT NULL ,
	[IdProjekcija]       integer  NOT NULL ,
	[UsernameK]          varchar(10)  NOT NULL ,
	[UsernameZ]          varchar(10)  NOT NULL 
)
go

ALTER TABLE [Karta]
	ADD CONSTRAINT [XPKKarta] PRIMARY KEY  CLUSTERED ([IdProjekcija] ASC,[UsernameK] ASC,[UsernameZ] ASC)
go

CREATE TABLE [Korisnik]
( 
	[idKorisnik]         integer  NOT NULL 
)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XPKKorisnik] PRIMARY KEY  CLUSTERED ([idKorisnik] ASC)
go

CREATE TABLE [Menadzer]
( 
	[UsernameZ]          varchar(10)  NOT NULL 
)
go

ALTER TABLE [Menadzer]
	ADD CONSTRAINT [XPKMenadzer] PRIMARY KEY  CLUSTERED ([UsernameZ] ASC)
go

CREATE TABLE [Projekcija]
( 
	[Broj_slobodnih_mesta] integer  NOT NULL ,
	[Satnica]            datetime  NOT NULL ,
	[Sala]               integer  NOT NULL ,
	[IdRepertoar]        integer  NOT NULL ,
	[IdFilm]             integer  NOT NULL ,
	[IdProjekcija]       integer  NOT NULL 
)
go

ALTER TABLE [Projekcija]
	ADD CONSTRAINT [XPKProjekcija] PRIMARY KEY  CLUSTERED ([IdProjekcija] ASC)
go

CREATE TABLE [RegistrovaniKorisnik]
( 
	[UsernameK]          varchar(10)  NOT NULL ,
	[Ime]                varchar(15)  NOT NULL ,
	[Prezime]            varchar(15)  NOT NULL ,
	[JMBG]               integer  NOT NULL 
	CONSTRAINT [JMBG_1884051291]
		CHECK  ( =13 ),
	[Adresa]             varchar(30)  NOT NULL ,
	[Broj]               integer  NOT NULL ,
	[PasswordK]          varchar(20)  NULL 
)
go

ALTER TABLE [RegistrovaniKorisnik]
	ADD CONSTRAINT [XPKRegistrovaniKorisnik] PRIMARY KEY  CLUSTERED ([UsernameK] ASC)
go

CREATE TABLE [Repertoar]
( 
	[IdRepertoar]        integer  NOT NULL ,
	[UsernameZ]          varchar(10)  NULL 
)
go

ALTER TABLE [Repertoar]
	ADD CONSTRAINT [XPKRepertoar] PRIMARY KEY  CLUSTERED ([IdRepertoar] ASC)
go

CREATE TABLE [SalterskiSluzbenik]
( 
	[UsernameZ]          varchar(10)  NOT NULL 
)
go

ALTER TABLE [SalterskiSluzbenik]
	ADD CONSTRAINT [XPKSalterskiSluzbenik] PRIMARY KEY  CLUSTERED ([UsernameZ] ASC)
go

CREATE TABLE [Zaposleni]
( 
	[Ime]                varchar(15)  NOT NULL ,
	[Prezime]            varchar(15)  NOT NULL ,
	[JMBG]               integer  NOT NULL 
	CONSTRAINT [JMBG_1651532485]
		CHECK  ( =13 ),
	[IdBioskop]          integer  NULL ,
	[UsernameZ]          varchar(10)  NOT NULL ,
	[PasswordZ]          varchar(20)  NOT NULL 
)
go

ALTER TABLE [Zaposleni]
	ADD CONSTRAINT [XPKZaposleni] PRIMARY KEY  CLUSTERED ([UsernameZ] ASC)
go


ALTER TABLE [Administrator]
	ADD CONSTRAINT [R_7] FOREIGN KEY ([UsernameZ]) REFERENCES [Zaposleni]([UsernameZ])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Gost]
	ADD CONSTRAINT [R_10] FOREIGN KEY ([idKorisnik]) REFERENCES [Korisnik]([idKorisnik])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Karta]
	ADD CONSTRAINT [R_22] FOREIGN KEY ([IdProjekcija]) REFERENCES [Projekcija]([IdProjekcija])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Karta]
	ADD CONSTRAINT [R_25] FOREIGN KEY ([UsernameZ]) REFERENCES [SalterskiSluzbenik]([UsernameZ])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Karta]
	ADD CONSTRAINT [R_35] FOREIGN KEY ([UsernameK]) REFERENCES [RegistrovaniKorisnik]([UsernameK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Menadzer]
	ADD CONSTRAINT [R_6] FOREIGN KEY ([UsernameZ]) REFERENCES [Zaposleni]([UsernameZ])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go

ALTER TABLE [Menadzer]
	ADD CONSTRAINT [R_8] FOREIGN KEY ([UsernameZ]) REFERENCES [Administrator]([UsernameZ])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Projekcija]
	ADD CONSTRAINT [R_12] FOREIGN KEY ([IdRepertoar]) REFERENCES [Repertoar]([IdRepertoar])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Projekcija]
	ADD CONSTRAINT [R_13] FOREIGN KEY ([IdFilm]) REFERENCES [Film]([IdFilm])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [RegistrovaniKorisnik]
	ADD CONSTRAINT [R_11] FOREIGN KEY ([UsernameK]) REFERENCES [Korisnik]([idKorisnik])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Repertoar]
	ADD CONSTRAINT [R_31] FOREIGN KEY ([UsernameZ]) REFERENCES [Menadzer]([UsernameZ])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [SalterskiSluzbenik]
	ADD CONSTRAINT [R_5] FOREIGN KEY ([UsernameZ]) REFERENCES [Zaposleni]([UsernameZ])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go

ALTER TABLE [SalterskiSluzbenik]
	ADD CONSTRAINT [R_9] FOREIGN KEY ([UsernameZ]) REFERENCES [Administrator]([UsernameZ])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Zaposleni]
	ADD CONSTRAINT [R_20] FOREIGN KEY ([IdBioskop]) REFERENCES [Bioskop]([IdBioskop])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


CREATE TRIGGER tD_Administrator ON Administrator FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Administrator */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Administrator  SalterskiSluzbenik on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="0003516b", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_9", FK_COLUMNS="UsernameZ" */
    IF EXISTS (
      SELECT * FROM deleted,SalterskiSluzbenik
      WHERE
        /*  %JoinFKPK(SalterskiSluzbenik,deleted," = "," AND") */
        SalterskiSluzbenik.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Administrator because SalterskiSluzbenik exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Administrator  Menadzer on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_8", FK_COLUMNS="UsernameZ" */
    IF EXISTS (
      SELECT * FROM deleted,Menadzer
      WHERE
        /*  %JoinFKPK(Menadzer,deleted," = "," AND") */
        Menadzer.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Administrator because Menadzer exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Zaposleni  Administrator on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Administrator"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_7", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Zaposleni
      WHERE
        /* %JoinFKPK(deleted,Zaposleni," = "," AND") */
        deleted.UsernameZ = Zaposleni.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM Administrator
          WHERE
            /* %JoinFKPK(Administrator,Zaposleni," = "," AND") */
            Administrator.UsernameZ = Zaposleni.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Administrator because Zaposleni exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Administrator ON Administrator FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Administrator */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insUsernameZ varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Administrator  SalterskiSluzbenik on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="000397bb", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_9", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,SalterskiSluzbenik
      WHERE
        /*  %JoinFKPK(SalterskiSluzbenik,deleted," = "," AND") */
        SalterskiSluzbenik.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Administrator because SalterskiSluzbenik exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Administrator  Menadzer on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_8", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Menadzer
      WHERE
        /*  %JoinFKPK(Menadzer,deleted," = "," AND") */
        Menadzer.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Administrator because Menadzer exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Zaposleni  Administrator on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Administrator"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_7", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Zaposleni
        WHERE
          /* %JoinFKPK(inserted,Zaposleni) */
          inserted.UsernameZ = Zaposleni.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Administrator because Zaposleni does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Bioskop ON Bioskop FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Bioskop */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Bioskop  Zaposleni on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="00010f3e", PARENT_OWNER="", PARENT_TABLE="Bioskop"
    CHILD_OWNER="", CHILD_TABLE="Zaposleni"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_20", FK_COLUMNS="IdBioskop" */
    IF EXISTS (
      SELECT * FROM deleted,Zaposleni
      WHERE
        /*  %JoinFKPK(Zaposleni,deleted," = "," AND") */
        Zaposleni.IdBioskop = deleted.IdBioskop
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Bioskop because Zaposleni exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Bioskop ON Bioskop FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Bioskop */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insIdBioskop integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Bioskop  Zaposleni on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="00013012", PARENT_OWNER="", PARENT_TABLE="Bioskop"
    CHILD_OWNER="", CHILD_TABLE="Zaposleni"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_20", FK_COLUMNS="IdBioskop" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(IdBioskop)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Zaposleni
      WHERE
        /*  %JoinFKPK(Zaposleni,deleted," = "," AND") */
        Zaposleni.IdBioskop = deleted.IdBioskop
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Bioskop because Zaposleni exists.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Film ON Film FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Film */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Film  Projekcija on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="000112fd", PARENT_OWNER="", PARENT_TABLE="Film"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_13", FK_COLUMNS="IdFilm" */
    IF EXISTS (
      SELECT * FROM deleted,Projekcija
      WHERE
        /*  %JoinFKPK(Projekcija,deleted," = "," AND") */
        Projekcija.IdFilm = deleted.IdFilm
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Film because Projekcija exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Film ON Film FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Film */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insIdFilm integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Film  Projekcija on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="00012812", PARENT_OWNER="", PARENT_TABLE="Film"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_13", FK_COLUMNS="IdFilm" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(IdFilm)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Projekcija
      WHERE
        /*  %JoinFKPK(Projekcija,deleted," = "," AND") */
        Projekcija.IdFilm = deleted.IdFilm
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Film because Projekcija exists.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Gost ON Gost FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Gost */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Korisnik  Gost on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00014ab2", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="Gost"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_10", FK_COLUMNS="idKorisnik" */
    IF EXISTS (SELECT * FROM deleted,Korisnik
      WHERE
        /* %JoinFKPK(deleted,Korisnik," = "," AND") */
        deleted.idKorisnik = Korisnik.idKorisnik AND
        NOT EXISTS (
          SELECT * FROM Gost
          WHERE
            /* %JoinFKPK(Gost,Korisnik," = "," AND") */
            Gost.idKorisnik = Korisnik.idKorisnik
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Gost because Korisnik exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Gost ON Gost FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Gost */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insidKorisnik integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Korisnik  Gost on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00016922", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="Gost"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_10", FK_COLUMNS="idKorisnik" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(idKorisnik)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Korisnik
        WHERE
          /* %JoinFKPK(inserted,Korisnik) */
          inserted.idKorisnik = Korisnik.idKorisnik
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Gost because Korisnik does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Karta ON Karta FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Karta */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* RegistrovaniKorisnik  Karta on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="0003dd30", PARENT_OWNER="", PARENT_TABLE="RegistrovaniKorisnik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_35", FK_COLUMNS="UsernameK" */
    IF EXISTS (SELECT * FROM deleted,RegistrovaniKorisnik
      WHERE
        /* %JoinFKPK(deleted,RegistrovaniKorisnik," = "," AND") */
        deleted.UsernameK = RegistrovaniKorisnik.UsernameK AND
        NOT EXISTS (
          SELECT * FROM Karta
          WHERE
            /* %JoinFKPK(Karta,RegistrovaniKorisnik," = "," AND") */
            Karta.UsernameK = RegistrovaniKorisnik.UsernameK
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Karta because RegistrovaniKorisnik exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* SalterskiSluzbenik  Karta on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="SalterskiSluzbenik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_25", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,SalterskiSluzbenik
      WHERE
        /* %JoinFKPK(deleted,SalterskiSluzbenik," = "," AND") */
        deleted.UsernameZ = SalterskiSluzbenik.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM Karta
          WHERE
            /* %JoinFKPK(Karta,SalterskiSluzbenik," = "," AND") */
            Karta.UsernameZ = SalterskiSluzbenik.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Karta because SalterskiSluzbenik exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Projekcija  Karta on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Projekcija"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_22", FK_COLUMNS="IdProjekcija" */
    IF EXISTS (SELECT * FROM deleted,Projekcija
      WHERE
        /* %JoinFKPK(deleted,Projekcija," = "," AND") */
        deleted.IdProjekcija = Projekcija.IdProjekcija AND
        NOT EXISTS (
          SELECT * FROM Karta
          WHERE
            /* %JoinFKPK(Karta,Projekcija," = "," AND") */
            Karta.IdProjekcija = Projekcija.IdProjekcija
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Karta because Projekcija exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Karta ON Karta FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Karta */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insIdProjekcija integer, 
           @insUsernameK varchar(10), 
           @insUsernameZ varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* RegistrovaniKorisnik  Karta on child update no action */
  /* ERWIN_RELATION:CHECKSUM="000429b6", PARENT_OWNER="", PARENT_TABLE="RegistrovaniKorisnik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_35", FK_COLUMNS="UsernameK" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameK)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,RegistrovaniKorisnik
        WHERE
          /* %JoinFKPK(inserted,RegistrovaniKorisnik) */
          inserted.UsernameK = RegistrovaniKorisnik.UsernameK
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Karta because RegistrovaniKorisnik does not exist.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* SalterskiSluzbenik  Karta on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="SalterskiSluzbenik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_25", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,SalterskiSluzbenik
        WHERE
          /* %JoinFKPK(inserted,SalterskiSluzbenik) */
          inserted.UsernameZ = SalterskiSluzbenik.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Karta because SalterskiSluzbenik does not exist.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Projekcija  Karta on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Projekcija"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_22", FK_COLUMNS="IdProjekcija" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(IdProjekcija)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Projekcija
        WHERE
          /* %JoinFKPK(inserted,Projekcija) */
          inserted.IdProjekcija = Projekcija.IdProjekcija
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Karta because Projekcija does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Korisnik ON Korisnik FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Korisnik */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Korisnik  RegistrovaniKorisnik on parent delete cascade */
    /* ERWIN_RELATION:CHECKSUM="0001ac3b", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="RegistrovaniKorisnik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_11", FK_COLUMNS="UsernameK" */
    DELETE RegistrovaniKorisnik
      FROM RegistrovaniKorisnik,deleted
      WHERE
        /*  %JoinFKPK(RegistrovaniKorisnik,deleted," = "," AND") */
        RegistrovaniKorisnik.UsernameK = deleted.idKorisnik

    /* erwin Builtin Trigger */
    /* Korisnik  Gost on parent delete cascade */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="Gost"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_10", FK_COLUMNS="idKorisnik" */
    DELETE Gost
      FROM Gost,deleted
      WHERE
        /*  %JoinFKPK(Gost,deleted," = "," AND") */
        Gost.idKorisnik = deleted.idKorisnik


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Korisnik ON Korisnik FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Korisnik */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insidKorisnik integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Korisnik  RegistrovaniKorisnik on parent update cascade */
  /* ERWIN_RELATION:CHECKSUM="0002dba5", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="RegistrovaniKorisnik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_11", FK_COLUMNS="UsernameK" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(idKorisnik)
  BEGIN
    IF @numrows = 1
    BEGIN
      SELECT @insidKorisnik = inserted.idKorisnik
        FROM inserted
      UPDATE RegistrovaniKorisnik
      SET
        /*  %JoinFKPK(RegistrovaniKorisnik,@ins," = ",",") */
        RegistrovaniKorisnik.UsernameK = @insidKorisnik
      FROM RegistrovaniKorisnik,inserted,deleted
      WHERE
        /*  %JoinFKPK(RegistrovaniKorisnik,deleted," = "," AND") */
        RegistrovaniKorisnik.UsernameK = deleted.idKorisnik
    END
    ELSE
    BEGIN
      SELECT @errno = 30006,
             @errmsg = 'Cannot cascade Korisnik update because more than one row has been affected.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Korisnik  Gost on parent update cascade */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="Gost"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_10", FK_COLUMNS="idKorisnik" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(idKorisnik)
  BEGIN
    IF @numrows = 1
    BEGIN
      SELECT @insidKorisnik = inserted.idKorisnik
        FROM inserted
      UPDATE Gost
      SET
        /*  %JoinFKPK(Gost,@ins," = ",",") */
        Gost.idKorisnik = @insidKorisnik
      FROM Gost,inserted,deleted
      WHERE
        /*  %JoinFKPK(Gost,deleted," = "," AND") */
        Gost.idKorisnik = deleted.idKorisnik
    END
    ELSE
    BEGIN
      SELECT @errno = 30006,
             @errmsg = 'Cannot cascade Korisnik update because more than one row has been affected.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Menadzer ON Menadzer FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Menadzer */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Menadzer  Repertoar on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="0003635c", PARENT_OWNER="", PARENT_TABLE="Menadzer"
    CHILD_OWNER="", CHILD_TABLE="Repertoar"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_31", FK_COLUMNS="UsernameZ" */
    IF EXISTS (
      SELECT * FROM deleted,Repertoar
      WHERE
        /*  %JoinFKPK(Repertoar,deleted," = "," AND") */
        Repertoar.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Menadzer because Repertoar exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Administrator  Menadzer on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_8", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Administrator
      WHERE
        /* %JoinFKPK(deleted,Administrator," = "," AND") */
        deleted.UsernameZ = Administrator.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM Menadzer
          WHERE
            /* %JoinFKPK(Menadzer,Administrator," = "," AND") */
            Menadzer.UsernameZ = Administrator.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Menadzer because Administrator exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Zaposleni  Menadzer on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_6", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Zaposleni
      WHERE
        /* %JoinFKPK(deleted,Zaposleni," = "," AND") */
        deleted.UsernameZ = Zaposleni.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM Menadzer
          WHERE
            /* %JoinFKPK(Menadzer,Zaposleni," = "," AND") */
            Menadzer.UsernameZ = Zaposleni.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Menadzer because Zaposleni exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Menadzer ON Menadzer FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Menadzer */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insUsernameZ varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Menadzer  Repertoar on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="0003e1bd", PARENT_OWNER="", PARENT_TABLE="Menadzer"
    CHILD_OWNER="", CHILD_TABLE="Repertoar"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_31", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Repertoar
      WHERE
        /*  %JoinFKPK(Repertoar,deleted," = "," AND") */
        Repertoar.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Menadzer because Repertoar exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Administrator  Menadzer on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_8", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Administrator
        WHERE
          /* %JoinFKPK(inserted,Administrator) */
          inserted.UsernameZ = Administrator.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    select @nullcnt = count(*) from inserted where
      inserted.UsernameZ IS NULL
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Menadzer because Administrator does not exist.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Zaposleni  Menadzer on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_6", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Zaposleni
        WHERE
          /* %JoinFKPK(inserted,Zaposleni) */
          inserted.UsernameZ = Zaposleni.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Menadzer because Zaposleni does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Projekcija ON Projekcija FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Projekcija */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Projekcija  Karta on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="00035e30", PARENT_OWNER="", PARENT_TABLE="Projekcija"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_22", FK_COLUMNS="IdProjekcija" */
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.IdProjekcija = deleted.IdProjekcija
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Projekcija because Karta exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Film  Projekcija on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Film"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_13", FK_COLUMNS="IdFilm" */
    IF EXISTS (SELECT * FROM deleted,Film
      WHERE
        /* %JoinFKPK(deleted,Film," = "," AND") */
        deleted.IdFilm = Film.IdFilm AND
        NOT EXISTS (
          SELECT * FROM Projekcija
          WHERE
            /* %JoinFKPK(Projekcija,Film," = "," AND") */
            Projekcija.IdFilm = Film.IdFilm
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Projekcija because Film exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Repertoar  Projekcija on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Repertoar"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_12", FK_COLUMNS="IdRepertoar" */
    IF EXISTS (SELECT * FROM deleted,Repertoar
      WHERE
        /* %JoinFKPK(deleted,Repertoar," = "," AND") */
        deleted.IdRepertoar = Repertoar.IdRepertoar AND
        NOT EXISTS (
          SELECT * FROM Projekcija
          WHERE
            /* %JoinFKPK(Projekcija,Repertoar," = "," AND") */
            Projekcija.IdRepertoar = Repertoar.IdRepertoar
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Projekcija because Repertoar exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Projekcija ON Projekcija FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Projekcija */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insIdProjekcija integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Projekcija  Karta on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="0003a89e", PARENT_OWNER="", PARENT_TABLE="Projekcija"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_22", FK_COLUMNS="IdProjekcija" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(IdProjekcija)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.IdProjekcija = deleted.IdProjekcija
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Projekcija because Karta exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Film  Projekcija on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Film"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_13", FK_COLUMNS="IdFilm" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(IdFilm)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Film
        WHERE
          /* %JoinFKPK(inserted,Film) */
          inserted.IdFilm = Film.IdFilm
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Projekcija because Film does not exist.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Repertoar  Projekcija on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Repertoar"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_12", FK_COLUMNS="IdRepertoar" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(IdRepertoar)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Repertoar
        WHERE
          /* %JoinFKPK(inserted,Repertoar) */
          inserted.IdRepertoar = Repertoar.IdRepertoar
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Projekcija because Repertoar does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_RegistrovaniKorisnik ON RegistrovaniKorisnik FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on RegistrovaniKorisnik */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* RegistrovaniKorisnik  Karta on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="00025929", PARENT_OWNER="", PARENT_TABLE="RegistrovaniKorisnik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_35", FK_COLUMNS="UsernameK" */
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.UsernameK = deleted.UsernameK
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete RegistrovaniKorisnik because Karta exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Korisnik  RegistrovaniKorisnik on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="RegistrovaniKorisnik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_11", FK_COLUMNS="UsernameK" */
    IF EXISTS (SELECT * FROM deleted,Korisnik
      WHERE
        /* %JoinFKPK(deleted,Korisnik," = "," AND") */
        deleted.UsernameK = Korisnik.idKorisnik AND
        NOT EXISTS (
          SELECT * FROM RegistrovaniKorisnik
          WHERE
            /* %JoinFKPK(RegistrovaniKorisnik,Korisnik," = "," AND") */
            RegistrovaniKorisnik.UsernameK = Korisnik.idKorisnik
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last RegistrovaniKorisnik because Korisnik exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_RegistrovaniKorisnik ON RegistrovaniKorisnik FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on RegistrovaniKorisnik */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insUsernameK varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* RegistrovaniKorisnik  Karta on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="000283d5", PARENT_OWNER="", PARENT_TABLE="RegistrovaniKorisnik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_35", FK_COLUMNS="UsernameK" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameK)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.UsernameK = deleted.UsernameK
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update RegistrovaniKorisnik because Karta exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Korisnik  RegistrovaniKorisnik on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Korisnik"
    CHILD_OWNER="", CHILD_TABLE="RegistrovaniKorisnik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_11", FK_COLUMNS="UsernameK" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameK)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Korisnik
        WHERE
          /* %JoinFKPK(inserted,Korisnik) */
          inserted.UsernameK = Korisnik.idKorisnik
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update RegistrovaniKorisnik because Korisnik does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Repertoar ON Repertoar FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Repertoar */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Repertoar  Projekcija on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="00023105", PARENT_OWNER="", PARENT_TABLE="Repertoar"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_12", FK_COLUMNS="IdRepertoar" */
    IF EXISTS (
      SELECT * FROM deleted,Projekcija
      WHERE
        /*  %JoinFKPK(Projekcija,deleted," = "," AND") */
        Projekcija.IdRepertoar = deleted.IdRepertoar
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete Repertoar because Projekcija exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Menadzer  Repertoar on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Menadzer"
    CHILD_OWNER="", CHILD_TABLE="Repertoar"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_31", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Menadzer
      WHERE
        /* %JoinFKPK(deleted,Menadzer," = "," AND") */
        deleted.UsernameZ = Menadzer.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM Repertoar
          WHERE
            /* %JoinFKPK(Repertoar,Menadzer," = "," AND") */
            Repertoar.UsernameZ = Menadzer.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Repertoar because Menadzer exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Repertoar ON Repertoar FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Repertoar */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insIdRepertoar integer,
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Repertoar  Projekcija on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="0002995e", PARENT_OWNER="", PARENT_TABLE="Repertoar"
    CHILD_OWNER="", CHILD_TABLE="Projekcija"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_12", FK_COLUMNS="IdRepertoar" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(IdRepertoar)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Projekcija
      WHERE
        /*  %JoinFKPK(Projekcija,deleted," = "," AND") */
        Projekcija.IdRepertoar = deleted.IdRepertoar
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update Repertoar because Projekcija exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Menadzer  Repertoar on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Menadzer"
    CHILD_OWNER="", CHILD_TABLE="Repertoar"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_31", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Menadzer
        WHERE
          /* %JoinFKPK(inserted,Menadzer) */
          inserted.UsernameZ = Menadzer.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    select @nullcnt = count(*) from inserted where
      inserted.UsernameZ IS NULL
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Repertoar because Menadzer does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_SalterskiSluzbenik ON SalterskiSluzbenik FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on SalterskiSluzbenik */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* SalterskiSluzbenik  Karta on parent delete no action */
    /* ERWIN_RELATION:CHECKSUM="0003b373", PARENT_OWNER="", PARENT_TABLE="SalterskiSluzbenik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_25", FK_COLUMNS="UsernameZ" */
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30001,
             @errmsg = 'Cannot delete SalterskiSluzbenik because Karta exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Administrator  SalterskiSluzbenik on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_9", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Administrator
      WHERE
        /* %JoinFKPK(deleted,Administrator," = "," AND") */
        deleted.UsernameZ = Administrator.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM SalterskiSluzbenik
          WHERE
            /* %JoinFKPK(SalterskiSluzbenik,Administrator," = "," AND") */
            SalterskiSluzbenik.UsernameZ = Administrator.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last SalterskiSluzbenik because Administrator exists.'
      GOTO error
    END

    /* erwin Builtin Trigger */
    /* Zaposleni  SalterskiSluzbenik on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_5", FK_COLUMNS="UsernameZ" */
    IF EXISTS (SELECT * FROM deleted,Zaposleni
      WHERE
        /* %JoinFKPK(deleted,Zaposleni," = "," AND") */
        deleted.UsernameZ = Zaposleni.UsernameZ AND
        NOT EXISTS (
          SELECT * FROM SalterskiSluzbenik
          WHERE
            /* %JoinFKPK(SalterskiSluzbenik,Zaposleni," = "," AND") */
            SalterskiSluzbenik.UsernameZ = Zaposleni.UsernameZ
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last SalterskiSluzbenik because Zaposleni exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_SalterskiSluzbenik ON SalterskiSluzbenik FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on SalterskiSluzbenik */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insUsernameZ varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* SalterskiSluzbenik  Karta on parent update no action */
  /* ERWIN_RELATION:CHECKSUM="00040d73", PARENT_OWNER="", PARENT_TABLE="SalterskiSluzbenik"
    CHILD_OWNER="", CHILD_TABLE="Karta"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_25", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF EXISTS (
      SELECT * FROM deleted,Karta
      WHERE
        /*  %JoinFKPK(Karta,deleted," = "," AND") */
        Karta.UsernameZ = deleted.UsernameZ
    )
    BEGIN
      SELECT @errno  = 30005,
             @errmsg = 'Cannot update SalterskiSluzbenik because Karta exists.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Administrator  SalterskiSluzbenik on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Administrator"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_9", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Administrator
        WHERE
          /* %JoinFKPK(inserted,Administrator) */
          inserted.UsernameZ = Administrator.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    select @nullcnt = count(*) from inserted where
      inserted.UsernameZ IS NULL
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update SalterskiSluzbenik because Administrator does not exist.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Zaposleni  SalterskiSluzbenik on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_5", FK_COLUMNS="UsernameZ" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Zaposleni
        WHERE
          /* %JoinFKPK(inserted,Zaposleni) */
          inserted.UsernameZ = Zaposleni.UsernameZ
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update SalterskiSluzbenik because Zaposleni does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go




CREATE TRIGGER tD_Zaposleni ON Zaposleni FOR DELETE AS
/* erwin Builtin Trigger */
/* DELETE trigger on Zaposleni */
BEGIN
  DECLARE  @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)
    /* erwin Builtin Trigger */
    /* Zaposleni  Administrator on parent delete cascade */
    /* ERWIN_RELATION:CHECKSUM="0003adb7", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Administrator"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_7", FK_COLUMNS="UsernameZ" */
    DELETE Administrator
      FROM Administrator,deleted
      WHERE
        /*  %JoinFKPK(Administrator,deleted," = "," AND") */
        Administrator.UsernameZ = deleted.UsernameZ

    /* erwin Builtin Trigger */
    /* Zaposleni  Menadzer on parent delete cascade */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_6", FK_COLUMNS="UsernameZ" */
    DELETE Menadzer
      FROM Menadzer,deleted
      WHERE
        /*  %JoinFKPK(Menadzer,deleted," = "," AND") */
        Menadzer.UsernameZ = deleted.UsernameZ

    /* erwin Builtin Trigger */
    /* Zaposleni  SalterskiSluzbenik on parent delete cascade */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_5", FK_COLUMNS="UsernameZ" */
    DELETE SalterskiSluzbenik
      FROM SalterskiSluzbenik,deleted
      WHERE
        /*  %JoinFKPK(SalterskiSluzbenik,deleted," = "," AND") */
        SalterskiSluzbenik.UsernameZ = deleted.UsernameZ

    /* erwin Builtin Trigger */
    /* Bioskop  Zaposleni on child delete no action */
    /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Bioskop"
    CHILD_OWNER="", CHILD_TABLE="Zaposleni"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_20", FK_COLUMNS="IdBioskop" */
    IF EXISTS (SELECT * FROM deleted,Bioskop
      WHERE
        /* %JoinFKPK(deleted,Bioskop," = "," AND") */
        deleted.IdBioskop = Bioskop.IdBioskop AND
        NOT EXISTS (
          SELECT * FROM Zaposleni
          WHERE
            /* %JoinFKPK(Zaposleni,Bioskop," = "," AND") */
            Zaposleni.IdBioskop = Bioskop.IdBioskop
        )
    )
    BEGIN
      SELECT @errno  = 30010,
             @errmsg = 'Cannot delete last Zaposleni because Bioskop exists.'
      GOTO error
    END


    /* erwin Builtin Trigger */
    RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


CREATE TRIGGER tU_Zaposleni ON Zaposleni FOR UPDATE AS
/* erwin Builtin Trigger */
/* UPDATE trigger on Zaposleni */
BEGIN
  DECLARE  @numrows int,
           @nullcnt int,
           @validcnt int,
           @insUsernameZ varchar(10),
           @errno   int,
           @severity int,
           @state    int,
           @errmsg  varchar(255)

  SELECT @numrows = @@rowcount
  /* erwin Builtin Trigger */
  /* Zaposleni  Administrator on parent update cascade */
  /* ERWIN_RELATION:CHECKSUM="0005ce2f", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Administrator"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_7", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF @numrows = 1
    BEGIN
      SELECT @insUsernameZ = inserted.UsernameZ
        FROM inserted
      UPDATE Administrator
      SET
        /*  %JoinFKPK(Administrator,@ins," = ",",") */
        Administrator.UsernameZ = @insUsernameZ
      FROM Administrator,inserted,deleted
      WHERE
        /*  %JoinFKPK(Administrator,deleted," = "," AND") */
        Administrator.UsernameZ = deleted.UsernameZ
    END
    ELSE
    BEGIN
      SELECT @errno = 30006,
             @errmsg = 'Cannot cascade Zaposleni update because more than one row has been affected.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Zaposleni  Menadzer on parent update cascade */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="Menadzer"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_6", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF @numrows = 1
    BEGIN
      SELECT @insUsernameZ = inserted.UsernameZ
        FROM inserted
      UPDATE Menadzer
      SET
        /*  %JoinFKPK(Menadzer,@ins," = ",",") */
        Menadzer.UsernameZ = @insUsernameZ
      FROM Menadzer,inserted,deleted
      WHERE
        /*  %JoinFKPK(Menadzer,deleted," = "," AND") */
        Menadzer.UsernameZ = deleted.UsernameZ
    END
    ELSE
    BEGIN
      SELECT @errno = 30006,
             @errmsg = 'Cannot cascade Zaposleni update because more than one row has been affected.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Zaposleni  SalterskiSluzbenik on parent update cascade */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Zaposleni"
    CHILD_OWNER="", CHILD_TABLE="SalterskiSluzbenik"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_5", FK_COLUMNS="UsernameZ" */
  IF
    /* %ParentPK(" OR",UPDATE) */
    UPDATE(UsernameZ)
  BEGIN
    IF @numrows = 1
    BEGIN
      SELECT @insUsernameZ = inserted.UsernameZ
        FROM inserted
      UPDATE SalterskiSluzbenik
      SET
        /*  %JoinFKPK(SalterskiSluzbenik,@ins," = ",",") */
        SalterskiSluzbenik.UsernameZ = @insUsernameZ
      FROM SalterskiSluzbenik,inserted,deleted
      WHERE
        /*  %JoinFKPK(SalterskiSluzbenik,deleted," = "," AND") */
        SalterskiSluzbenik.UsernameZ = deleted.UsernameZ
    END
    ELSE
    BEGIN
      SELECT @errno = 30006,
             @errmsg = 'Cannot cascade Zaposleni update because more than one row has been affected.'
      GOTO error
    END
  END

  /* erwin Builtin Trigger */
  /* Bioskop  Zaposleni on child update no action */
  /* ERWIN_RELATION:CHECKSUM="00000000", PARENT_OWNER="", PARENT_TABLE="Bioskop"
    CHILD_OWNER="", CHILD_TABLE="Zaposleni"
    P2C_VERB_PHRASE="", C2P_VERB_PHRASE="", 
    FK_CONSTRAINT="R_20", FK_COLUMNS="IdBioskop" */
  IF
    /* %ChildFK(" OR",UPDATE) */
    UPDATE(IdBioskop)
  BEGIN
    SELECT @nullcnt = 0
    SELECT @validcnt = count(*)
      FROM inserted,Bioskop
        WHERE
          /* %JoinFKPK(inserted,Bioskop) */
          inserted.IdBioskop = Bioskop.IdBioskop
    /* %NotnullFK(inserted," IS NULL","select @nullcnt = count(*) from inserted where"," AND") */
    select @nullcnt = count(*) from inserted where
      inserted.IdBioskop IS NULL
    IF @validcnt + @nullcnt != @numrows
    BEGIN
      SELECT @errno  = 30007,
             @errmsg = 'Cannot update Zaposleni because Bioskop does not exist.'
      GOTO error
    END
  END


  /* erwin Builtin Trigger */
  RETURN
error:
   RAISERROR (@errmsg, -- Message text.
              @severity, -- Severity (0~25).
              @state) -- State (0~255).
    rollback transaction
END

go


