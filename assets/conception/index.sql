#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: 5fE2&_seriesGenre
#------------------------------------------------------------

CREATE TABLE 5fE2__seriesGenre(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT 5fE2__seriesGenre_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_articles
#------------------------------------------------------------

CREATE TABLE 5fE2__articles(
        id      Int  Auto_increment  NOT NULL ,
        title   Varchar (255) NOT NULL ,
        date    Datetime NOT NULL ,
        content Text NOT NULL
	,CONSTRAINT 5fE2__articles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_role
#------------------------------------------------------------

CREATE TABLE 5fE2__role(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (20) NOT NULL
	,CONSTRAINT 5fE2__role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_users
#------------------------------------------------------------

CREATE TABLE 5fE2__users(
        id            Int  Auto_increment  NOT NULL ,
        username      Varchar (50) NOT NULL ,
        mail          Varchar (255) NOT NULL ,
        password      Varchar (255) NOT NULL ,
        birthdate     Date NOT NULL ,
        photo         Varchar (255) NOT NULL ,
        id_5fE2__role Int NOT NULL
	,CONSTRAINT 5fE2__users_PK PRIMARY KEY (id)

	,CONSTRAINT 5fE2__users_5fE2__role_FK FOREIGN KEY (id_5fE2__role) REFERENCES 5fE2__role(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_commentary
#------------------------------------------------------------

CREATE TABLE 5fE2__commentary(
        id                Int  Auto_increment  NOT NULL ,
        content           Text NOT NULL ,
        date              Datetime NOT NULL ,
        rate              Int NOT NULL ,
        id_5fE2__users    Int NOT NULL ,
        id_5fE2__articles Int NOT NULL
	,CONSTRAINT 5fE2__commentary_PK PRIMARY KEY (id)

	,CONSTRAINT 5fE2__commentary_5fE2__users_FK FOREIGN KEY (id_5fE2__users) REFERENCES 5fE2__users(id)
	,CONSTRAINT 5fE2__commentary_5fE2__articles0_FK FOREIGN KEY (id_5fE2__articles) REFERENCES 5fE2__articles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_categories
#------------------------------------------------------------

CREATE TABLE 5fE2__categories(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT 5fE2__categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_status
#------------------------------------------------------------

CREATE TABLE 5fE2__status(
        id     Int  Auto_increment  NOT NULL ,
        status Varchar (50) NOT NULL
	,CONSTRAINT 5fE2__status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_progress
#------------------------------------------------------------

CREATE TABLE 5fE2__progress(
        id      Int  Auto_increment  NOT NULL ,
        season  Int NOT NULL ,
        episode Int NOT NULL
	,CONSTRAINT 5fE2__progress_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_series
#------------------------------------------------------------

CREATE TABLE 5fE2__series(
        id                Int  Auto_increment  NOT NULL ,
        title             Varchar (100) NOT NULL ,
        synopsis          Text NOT NULL ,
        creator           Varchar (255) NOT NULL ,
        year              Date NOT NULL ,
        photo             Varchar (255) NOT NULL ,
        actors            Varchar (255) NOT NULL ,
        id_5fE2__status   Int NOT NULL ,
        id_5fE2__progress Int NOT NULL
	,CONSTRAINT 5fE2__series_PK PRIMARY KEY (id)

	,CONSTRAINT 5fE2__series_5fE2__status_FK FOREIGN KEY (id_5fE2__status) REFERENCES 5fE2__status(id)
	,CONSTRAINT 5fE2__series_5fE2__progress0_FK FOREIGN KEY (id_5fE2__progress) REFERENCES 5fE2__progress(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_season
#------------------------------------------------------------

CREATE TABLE 5fE2__season(
        id              Int  Auto_increment  NOT NULL ,
        seasonNumber    Int NOT NULL ,
        numberOfEpisode Int NOT NULL ,
        id_5fE2__series Int NOT NULL
	,CONSTRAINT 5fE2__season_PK PRIMARY KEY (id)

	,CONSTRAINT 5fE2__season_5fE2__series_FK FOREIGN KEY (id_5fE2__series) REFERENCES 5fE2__series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_viewedSeries
#------------------------------------------------------------

CREATE TABLE 5fE2__viewedSeries(
        id             Int NOT NULL ,
        id_5fE2__users Int NOT NULL
	,CONSTRAINT 5fE2__viewedSeries_PK PRIMARY KEY (id,id_5fE2__users)

	,CONSTRAINT 5fE2__viewedSeries_5fE2__series_FK FOREIGN KEY (id) REFERENCES 5fE2__series(id)
	,CONSTRAINT 5fE2__viewedSeries_5fE2__users0_FK FOREIGN KEY (id_5fE2__users) REFERENCES 5fE2__users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_seriesGenres
#------------------------------------------------------------

CREATE TABLE 5fE2__seriesGenres(
        id              Int NOT NULL ,
        id_5fE2__series Int NOT NULL
	,CONSTRAINT 5fE2__seriesGenres_PK PRIMARY KEY (id,id_5fE2__series)

	,CONSTRAINT 5fE2__seriesGenres_5fE2__seriesGenre_FK FOREIGN KEY (id) REFERENCES 5fE2__seriesGenre(id)
	,CONSTRAINT 5fE2__seriesGenres_5fE2__series0_FK FOREIGN KEY (id_5fE2__series) REFERENCES 5fE2__series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 5fE2&_articleCategory
#------------------------------------------------------------

CREATE TABLE 5fE2__articleCategory(
        id                Int NOT NULL ,
        id_5fE2__articles Int NOT NULL
	,CONSTRAINT 5fE2__articleCategory_PK PRIMARY KEY (id,id_5fE2__articles)

	,CONSTRAINT 5fE2__articleCategory_5fE2__categories_FK FOREIGN KEY (id) REFERENCES 5fE2__categories(id)
	,CONSTRAINT 5fE2__articleCategory_5fE2__articles0_FK FOREIGN KEY (id_5fE2__articles) REFERENCES 5fE2__articles(id)
)ENGINE=InnoDB;