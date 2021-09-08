#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: f5E2_seriesGenres
#------------------------------------------------------------

CREATE TABLE f5E2_seriesGenres(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT seriesGenres_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_roles
#------------------------------------------------------------

CREATE TABLE f5E2_roles(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (20) NOT NULL
	,CONSTRAINT roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_users
#------------------------------------------------------------

CREATE TABLE f5E2_users(
        id            Int  Auto_increment  NOT NULL ,
        username      Varchar (50) NOT NULL ,
        mail          Varchar (255) NOT NULL ,
        password      Varchar (255) NOT NULL ,
        birthdate     Date NOT NULL ,
        photo         Varchar (255) NOT NULL ,
        idRoles Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id)

	,CONSTRAINT users_roles_FK FOREIGN KEY (idRoles) REFERENCES f5E2_roles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_categories
#------------------------------------------------------------

CREATE TABLE f5E2_categories(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_articles
#------------------------------------------------------------

CREATE TABLE f5E2_articles(
        id                 Int  Auto_increment  NOT NULL ,
        title              Varchar (255) NOT NULL ,
        date               Datetime NOT NULL ,
        content            Text NOT NULL ,
        idCategories Int NOT NULL
	,CONSTRAINT articles_PK PRIMARY KEY (id)

	,CONSTRAINT articles_categories_FK FOREIGN KEY (idCategories) REFERENCES f5E2_categories(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_articlesComments
#------------------------------------------------------------

CREATE TABLE f5E2_articlesComments(
        id               Int  Auto_increment  NOT NULL ,
        content          Text NOT NULL ,
        date             Datetime NOT NULL ,
        rate             Int NOT NULL ,
        idUsers    Int NOT NULL ,
        idArticles Int NOT NULL
	,CONSTRAINT articlesComments_PK PRIMARY KEY (id)

	,CONSTRAINT articlesComments_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
	,CONSTRAINT articlesComments_articles_FK FOREIGN KEY (idArticles) REFERENCES f5E2_articles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_status
#------------------------------------------------------------

CREATE TABLE f5E2_status(
        id     Int  Auto_increment  NOT NULL ,
        status Varchar (50) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_series
#------------------------------------------------------------

CREATE TABLE f5E2_series(
        id             Int  Auto_increment  NOT NULL ,
        title          Varchar (100) NOT NULL ,
        synopsis       Text NOT NULL ,
        creators       Varchar (255) NOT NULL ,
        year           Year NOT NULL ,
        photo          Varchar (255) NOT NULL ,
        idStatus Int NOT NULL
	,CONSTRAINT series_PK PRIMARY KEY (id)

	,CONSTRAINT series_status_FK FOREIGN KEY (idStatus) REFERENCES f5E2_status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seasons
#------------------------------------------------------------

CREATE TABLE f5E2_seasons(
        id              Int  Auto_increment  NOT NULL ,
        seasonNumber    Int NOT NULL ,
        numberOfEpisode Int NOT NULL ,
        idSeries  Int NOT NULL
	,CONSTRAINT seasons_PK PRIMARY KEY (id)

	,CONSTRAINT seasons_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_progress
#------------------------------------------------------------

CREATE TABLE f5E2_progress(
        id             Int  Auto_increment  NOT NULL ,
        season         Int NOT NULL ,
        episode        Int NOT NULL ,
        idSeries Int NOT NULL ,
        idUsers  Int NOT NULL
	,CONSTRAINT progress_PK PRIMARY KEY (id)

	,CONSTRAINT progress_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
	,CONSTRAINT progress_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesComments
#------------------------------------------------------------

CREATE TABLE f5E2_seriesComments(
        id             Int  Auto_increment  NOT NULL ,
        content        Text NOT NULL ,
        date           Datetime NOT NULL ,
        rate           Int NOT NULL ,
        idUsers  Int NOT NULL ,
        idSeries Int NOT NULL
	,CONSTRAINT seriesComments_PK PRIMARY KEY (id)

	,CONSTRAINT seriesComments_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
	,CONSTRAINT seriesComments_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_actors
#------------------------------------------------------------

CREATE TABLE f5E2_actors(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (100) NOT NULL
	,CONSTRAINT actors_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_viewedSeries
#------------------------------------------------------------

CREATE TABLE f5E2_viewedSeries(
        idSeries           Int NOT NULL ,
        idUsers Int NOT NULL
	,CONSTRAINT viewedSeries_PK PRIMARY KEY (idSeries,idUsers)

	,CONSTRAINT viewedSeries_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
	,CONSTRAINT viewedSeries_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesHaveGenres
#------------------------------------------------------------

CREATE TABLE f5E2_seriesHaveGenres(
        idSeriesGenres Int NOT NULL ,
        idSeries	   Int NOT NULL
	,CONSTRAINT seriesHaveGenres_PK PRIMARY KEY (idSeriesGenres,idSeries)

	,CONSTRAINT seriesHaveGenres_seriesGenres_FK FOREIGN KEY (idSeriesGenres) REFERENCES f5E2_seriesGenres(id)
	,CONSTRAINT seriesHaveGenres_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesHaveActors
#------------------------------------------------------------

CREATE TABLE f5E2_seriesHaveActors(
        idActors           Int NOT NULL ,
        idSeries Int NOT NULL
	,CONSTRAINT seriesHaveActors_PK PRIMARY KEY (idActors,idSeries)

	,CONSTRAINT seriesHaveActors_actors_FK FOREIGN KEY (idActors) REFERENCES f5E2_actors(id)
	,CONSTRAINT seriesHaveActors_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;

