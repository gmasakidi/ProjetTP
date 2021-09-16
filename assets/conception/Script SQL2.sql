#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: f5E2_actors
#------------------------------------------------------------

CREATE TABLE f5E2_actors(
        id   Int Auto_increment NOT NULL ,
        name Varchar (100) NOT NULL
	,CONSTRAINT actors_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_categories
#------------------------------------------------------------

CREATE TABLE f5E2_categories(
        id   Int Auto_increment NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_articles
#------------------------------------------------------------

CREATE TABLE f5E2_articles(
        id                 Int Auto_increment NOT NULL ,
        title              Varchar (255) NOT NULL ,
        date               Datetime NOT NULL ,
        content            Text NOT NULL ,
        photo              Varchar (255) NOT NULL ,
        idCategories Int NOT NULL
	,CONSTRAINT articles_PK PRIMARY KEY (id)

	,CONSTRAINT articles_categories_FK FOREIGN KEY (idCategories) REFERENCES f5E2_categories(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_roles
#------------------------------------------------------------

CREATE TABLE f5E2_roles(
        id   Int Auto_increment NOT NULL ,
        name Varchar (20) NOT NULL
	,CONSTRAINT roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesGenres
#------------------------------------------------------------

CREATE TABLE f5E2_seriesGenres(
        id   Int Auto_increment NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT seriesGenres_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_status
#------------------------------------------------------------

CREATE TABLE f5E2_status(
        id     Int Auto_increment NOT NULL ,
        status Varchar (50) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_series
#------------------------------------------------------------

CREATE TABLE f5E2_series(
        id             Int Auto_increment NOT NULL ,
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
        id              Int Auto_increment NOT NULL ,
        seasonNumber    Int NOT NULL ,
        numberOfEpisode Int NOT NULL ,
        idSeries  Int NOT NULL
	,CONSTRAINT seasons_PK PRIMARY KEY (id)

	,CONSTRAINT seasons_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_users
#------------------------------------------------------------

CREATE TABLE f5E2_users(
        id            Int Auto_increment NOT NULL ,
        username      Varchar (50) NOT NULL ,
        mail          Varchar (255) NOT NULL ,
        password      Varchar (255) NOT NULL ,
        photo         Varchar (255) NULL ,
        idRoles Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id)

	,CONSTRAINT users_roles_FK FOREIGN KEY (idRoles) REFERENCES f5E2_roles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_articlesComments
#------------------------------------------------------------

CREATE TABLE f5E2_articlesComments(
        id               Int Auto_increment NOT NULL ,
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
# Table: f5E2_seriesComments
#------------------------------------------------------------

CREATE TABLE f5E2_seriesComments(
        id              Int Auto_increment NOT NULL ,
        content         Text NOT NULL ,
        date            Datetime NOT NULL ,
        rate            Int NOT NULL ,
        idUsers   Int NOT NULL ,
        idSeries  Int NOT NULL ,
        idSeasons Int NOT NULL
	,CONSTRAINT seriesComments_PK PRIMARY KEY (id)

	,CONSTRAINT seriesComments_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
	,CONSTRAINT seriesComments_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
	,CONSTRAINT seriesComments_seasons_FK FOREIGN KEY (idSeasons) REFERENCES f5E2_seasons(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesHaveActors
#------------------------------------------------------------

CREATE TABLE f5E2_seriesHaveActors(
        idSeries          Int NOT NULL ,
        idActors Int NOT NULL
	,CONSTRAINT seriesHaveActors_PK PRIMARY KEY (idSeries,idActors)

	,CONSTRAINT seriesHaveActors_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
	,CONSTRAINT seriesHaveActors_actors_FK FOREIGN KEY (idActors) REFERENCES f5E2_actors(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_seriesHaveGenres
#------------------------------------------------------------

CREATE TABLE f5E2_seriesHaveGenres(
        idSeries                  Int NOT NULL ,
        idSeriesGenres Int NOT NULL
	,CONSTRAINT seriesHaveGenres_PK PRIMARY KEY (idSeries,idSeriesGenres)

	,CONSTRAINT seriesHaveGenres_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
	,CONSTRAINT seriesHaveGenres_seriesGenres_FK FOREIGN KEY (idSeriesGenres) REFERENCES f5E2_seriesGenres(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_viewedSeries
#------------------------------------------------------------

CREATE TABLE f5E2_viewedSeries(
        idUsers             Int NOT NULL ,
        idSeries Int NOT NULL
	,CONSTRAINT viewedSeries_PK PRIMARY KEY (idUsers,idSeries)

	,CONSTRAINT viewedSeries_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
	,CONSTRAINT viewedSeries_series_FK FOREIGN KEY (idSeries) REFERENCES f5E2_series(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: f5E2_progress
#------------------------------------------------------------

CREATE TABLE f5E2_progress(
        idSeasons            Int NOT NULL ,
        idUsers Int NOT NULL
	,CONSTRAINT progress_PK PRIMARY KEY (idSeasons,idUsers)

	,CONSTRAINT progress_seasons_FK FOREIGN KEY (idSeasons) REFERENCES f5E2_seasons(id)
	,CONSTRAINT progress_users_FK FOREIGN KEY (idUsers) REFERENCES f5E2_users(id)
)ENGINE=InnoDB;

INSERT INTO f5e2_seriesgenres (name)
VALUES ('Drame'),
('Fantastique'),
('Aventure'),
('Historique'),
('Epouvante-horreur'),
('Science fiction'),
('Comédie'),
('Famille'),
('Thriller'),
('Action'),
('Romance'),
('Judiciaire'),
('Policier'),
('Biopic'),
('Soap'),
('Musical');

INSERT INTO f5e2_actors (name)
VALUES ('Bryan Cranston'),
('Aaron Paul'),
('Anna Gunn'),
('Emilia Clarke'),
('Peter Dinklage'),
('Kit Harington'),
('Henry Cavill'),
('Anya Chalotra'),
('Freya Allan'),
('Raphael Keric'),
('Chloe Pirrie'),
('Anya Taylor-Joy'),
('Marco Ilsø'),
('Gustaf Skarsgård'),
('Alex Høgh Andersen'),
('Norman Reedus'),
('Jeffrey Dean Morgan'),
('Melissa McBride'),
('Yvonne Strahovski'),
('Joseph Fiennes'),
('Elisabeth Moss'),
('Frankie Faison'),
('Ivana Milicevic'),
('Antony Starr'),
('Sofia Vergara'),
('Julie Bowen'),
('Ed ONeill'),
('Maggie Smith'),
('Michelle Dockery'),
('Hugh Bonneville'),
('Diane Lane'),
('Michael Kelly'),
('Robin Wright'),
('Drew Goddard'),
('Steven S. DeKnight'),
('Alyson Hannigan'),
('Jason Segel'),
('Josh Radnor'),
('Sophie Skelton'),
('Sam Heughan'),
('Caitriona Balfe'),
('Billy Brown (II)'),
('Alfred Enoch'),
('Viola Davis'),
('Max Thieriot'),
('Freddie Highmore'),
('Vera Farmiga'),
('Fiona Shaw'),
('Jodie Comer'),
('Sandra Oh'),
('Kaley Cuoco'),
('Johnny Galecki'),
('Jim Parsons'),
('Lisa Kudrow'),
('Courteney Cox'),
('Jennifer Aniston'),
('Sergio Peris-Mencheta'),
('Carter Hudson'),
('Damson Idris'),
('Jamie Dornan'),
('Gillian Anderson'),
('Karen Hassan'),
('Natasha Lyonne'),
('Laura Prepon'),
('Taylor Schilling'),
('Jesse Lee Soffer'),
('Jason Beghe'),
('Amy Morton'),
('Lauren German'),
('D.B. Woodside'),
('Tom Ellis'),
('Sterling K. Brown'),
('Mandy Moore'),
('Milo Ventimiglia'),
('Hank Azaria'),
('Dan Castellaneta'),
('Harry Shearer'),
('Elizabeth Lail'),
('Victoria Pedretti'),
('Penn Badgley'),
('Hugo Silva'),
('Roberto Enriquez'),
('Michelle Jenner'),
('Andrew Scott'),
('Topher Grace'),
('James Heslep Smith III'),
('Finn Wolfhard'),
('Winona Ryder'),
('Millie Bobby Brown'),
('Jeremy Allen White'),
('Ethan Cutkosky'),
('William H. Macy'),
('James Remar'),
('Jennifer Carpenter'),
('Michael C. Hall'),
('Elizabeth Reaser'),
('Carla Gugino'),
('Michiel Huisman'),
('Carly Chaikin'),
('Christian Slater'),
('Rami Malek'),
('Holland Roden'),
('Dylan OBrien'),
('Tyler Posey'),
('Melissa Fumero'),
('Andre Braugher'),
('Andy Samberg'),
('Helena Bonham Carter'),
('Tobias Menzies'),
('Olivia Colman'),
('Timothy Dalton'),
('Josh Hartnett'),
('Eva Green'),
('Indya Moore'),
('Dominique Jackson'),
('MJ Rodriguez'),
('Tony Goldwyn'),
('Scott Foley'),
('Kerry Washington'),
('Meryl Streep'),
('Nicole Kidman'),
('Reese Witherspoon'),
('Lucy Hale'),
('Troian Bellisario'),
('Ashley Benson'),
('Bryshere Y. Gray'),
('Taraji P. Henson'),
('Terrence Howard'),
('Jacob Elordi'),
('Hunter Schafer'),
('Zendaya'),
('Gugu Mbatha-Raw'),
('Owen Wilson'),
('Tom Hiddleston'),
('Dylan McDermott'),
('Emma Roberts'),
('Lily Rabe'),
('Paul Anderson'),
('Helen McCrory'),
('Cillian Murphy'),
('Miguel Bernardeau'),
('Itzan Escamilla'),
('Georgina Amorós');