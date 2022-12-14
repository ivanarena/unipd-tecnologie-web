/**
CREATE DATABASE sanjunipero;
USE sanjunipero;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;
*/
/**
Eliminazione Tabelle
*/
DROP TABLE IF EXISTS EVENTO_UTENTE;
DROP TABLE IF EXISTS ABBONAMENTO_UTENTE;
DROP TABLE IF EXISTS PORTAFOGLIO;
DROP TABLE IF EXISTS EVENTO;
DROP TABLE IF EXISTS LOCALE;
DROP TABLE IF EXISTS ABBONAMENTO;
DROP TABLE IF EXISTS CARTA;
DROP TABLE IF EXISTS UTENTE;

/**
Creazione Tabelle
*/
CREATE TABLE UTENTE(
    Username VARCHAR(20) NOT NULL,
    Password VARCHAR(255) NOT NULL, 
    Email VARCHAR(100) NOT NULL, 
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL, 
    DataNascita DATE NOT NULL, 
    Privilegio INT NOT NULL default 0,
    PRIMARY KEY(Username)
    );

CREATE TABLE CARTA(
    NumeroCarta CHAR(16) NOT NULL, 
    Circuito VARCHAR(50) NOT NULL,
    CCV CHAR(3) NOT  NULL,
    DataScadenza DATE NOT NULL, 
    Intestatario VARCHAR(50) NOT NULL,
    PRIMARY KEY(NumeroCarta)
    );

CREATE TABLE ABBONAMENTO( /**togliere durata?*/
    IdAbbonamento INT NOT NULL AUTO_INCREMENT,
    TitoloAbb VARCHAR(100) NOT NULL, 
    Descrizione VARCHAR(1024), 
    Prezzo DECIMAL(10,2) NOT NULL, 
    DurataAbb INT NOT NULL,
    EventiSettimanali INT NOT NULL,
    MetaCoin DECIMAL(10,2) NOT NULL default 0.00,
    PRIMARY KEY(IdAbbonamento)
    );

CREATE TABLE LOCALE(
    IdLocale INT NOT NULL AUTO_INCREMENT, 
    NomeLocale VARCHAR(50) NOT NULL, 
    Indirizzo VARCHAR(200) NOT NULL, 
    Descrizione VARCHAR(1024), 
    Capienza INT NOT NULL, 
    LinkImg VARCHAR(512),
    PRIMARY KEY(IdLocale)
    );

CREATE TABLE EVENTO(
    IdEvento INT NOT NULL AUTO_INCREMENT, 
    NomeEvento VARCHAR(100) NOT NULL, 
    Descrizione VARCHAR(1024) NOT NULL, 
    LinkImg VARCHAR(512), 
    IdLocale INT NOT NULL, 
    DataOraInizio DATETIME NOT NULL, 
    DataOraFine DATETIME NOT NULL,
    PRIMARY KEY(IdEvento),
    FOREIGN KEY (IdLocale) REFERENCES LOCALE(IdLocale) ON DELETE CASCADE ON UPDATE CASCADE
    );


CREATE TABLE PORTAFOGLIO(
    Username VARCHAR(100) NOT NULL, 
    NumeroCarta CHAR(16) NOT NULL,
    PRIMARY KEY(Username, NumeroCarta),
    FOREIGN KEY (Username) REFERENCES UTENTE(Username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE 
    );

CREATE TABLE ABBONAMENTO_UTENTE(
    IdAbbUtente INT NOT NULL AUTO_INCREMENT,
    IdAbbonamento INT NOT NULL,  
    Username VARCHAR(100) NOT NULL, 
    NumeroCarta CHAR(16) NOT NULL, 
    DataPagamento DATE NOT NULL, 
    DataScadenza DATE NOT NULL,
    PRIMARY KEY(IdAbbUtente),
    FOREIGN KEY (IdAbbonamento) REFERENCES ABBONAMENTO(IdAbbonamento) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Username) REFERENCES UTENTE(Username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE EVENTO_UTENTE(
    Username VARCHAR(100) NOT NULL,
    IdEvento INT NOT NULL,
    DataIscrizione DATETIME NOT NULL,
    PRIMARY KEY(Username,IdEvento),
    FOREIGN KEY (Username) REFERENCES UTENTE(Username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdEvento) REFERENCES EVENTO(IdEvento) ON DELETE CASCADE ON UPDATE CASCADE
    );


/**UTENTI**/
INSERT INTO UTENTE VALUES("Alyon", "$2y$10$Q6tUlj8oIhdsdVa6hs40B.A9dSi0maYFwDVe9yScpcBCmNC8e5Vcq", "massimo.chioru@gmail.com", "Massimo", "Chioru", '2001-11-13', 0); 
INSERT INTO UTENTE VALUES("admin", "$2y$10$wrvZiy1egezeMrYQ.LIvAe64zjSZHUnmhOU/n4xFZCFML9kVRKnRe", "admin@gmail.com", "Mario", "Rossi", '1992-01-23', 1); 
INSERT INTO UTENTE VALUES("user", "$2y$10$V0IDAKje8lFy8BCCac/YZ.SPERXNWh2onazKJ3U6pTgxNP4PhaHOS", "user@gmail.com", "Luca", "Galeazzo", '1975-06-11', 0); 
INSERT INTO UTENTE VALUES("Bigtooth", "$2y$10$XXnRpFBx2nu5ueYmB3Au9OHctgr.ROEIPpLSgM2I5jOM1oclg9bue", "giuliaadentone@gmail.com", "Giulia", "Dentone", '2001-10-15', 0); 
INSERT INTO UTENTE VALUES("dario69", "$2y$10$hQ2WR0bPmRfrfJgAr4qOyORQknXYCIsON6oSAvqXFwYSzpXC/C7LG", "69dariod@gmail.com", "Dario", "Destro", '1969-03-07', 0); 
INSERT INTO UTENTE VALUES("simo_p", "$2y$10$vHuvb6tMqelVADyZoiZu0..hjd3AVcl6QevJ8QxQhIb29D9J44gQq", "simonetta265@gmail.com", "Simonetta", "Pagliaro", '1998-05-26', 0); 

/**CARTE**/
INSERT INTO CARTA VALUES("370406126264861", "American Express", "022", "2026-05-14", "Massimo Chioru");
INSERT INTO CARTA VALUES("4141080454367972346", "VISA", "123", "2023-10-05", "Giulia Dentone");
INSERT INTO CARTA VALUES("4245058018166046", "VISA", "457", "2025-01-30", "Dario Destro");
INSERT INTO CARTA VALUES("583584310887", "Maestro", "026", "2027-01-01", "Simonetta Pagliaro");
INSERT INTO CARTA VALUES("783584310000", "Maestro", "021", "2023-01-01", "Luca Galeazzo");
INSERT INTO CARTA VALUES("111562587000", "Maestro", "057", "2025-05-12", "Mario Rossi");

/**ABBONAMENTI sistemare durata**/
INSERT INTO ABBONAMENTO VALUES("1", "Basic", "NULL", "100", "1", "1", "1000");
INSERT INTO ABBONAMENTO VALUES("2", "Pro", "NULL", "220", "1", "5", "3000");
INSERT INTO ABBONAMENTO VALUES("3", "Superior", "NULL", "365", "1", "10", "7000");

/**LOCALI manca link image**/
INSERT INTO LOCALE VALUES("1", "Fluido Cafe", "Via Pirandello", "NULL", "50", "");
INSERT INTO LOCALE VALUES("2", "Extra Extra", "Via Umberto I", "NULL", "700", "");
INSERT INTO LOCALE VALUES("3", "Rush IN", "Via della Croce Verde", "NULL", "700", "");
INSERT INTO LOCALE VALUES("4", "Bagni Venere", "Via Fratelli Cervi", "NULL", "150", "");
INSERT INTO LOCALE VALUES("5", "Sala Conferenze Dante Alighieri", "Via Dante Alighieri", "NULL", "300", "");

/**EVENTI manca link image**/ 
INSERT INTO EVENTO VALUES("1", "Salone del libro", "NULL", "", "1", "2023-01-15 17:00:00", "2023-01-15 19:00:00");
INSERT INTO EVENTO VALUES("2", "Vida Loca", "NULL", "", "2", "2023-02-02 22:00:00", "2023-02-03 06:00:00");
INSERT INTO EVENTO VALUES("3", "Spirit techno", "NULL", "", "2", "2022-12-26 22:00:00", "2022-12-27 06:00:00");
INSERT INTO EVENTO VALUES("4", "Ride", "NULL", "", "3", "2022-12-29 09:00:00", "2022-12-29 20:00:00");
INSERT INTO EVENTO VALUES("5", "Day Spa", "NULL", "", "4", "2022-12-30 08:00:00", "2022-12-30 23:00:00");
INSERT INTO EVENTO VALUES("6", "Lotta alla mafia con Saviano", "NULL", "", "5", "2023-01-05 17:00:00", "2023-01-05 20:30:00");

/**PORTAFOGLI**/
INSERT INTO PORTAFOGLI VALUES("Alyon", "370406126264861");
INSERT INTO PORTAFOGLI VALUES("Bigtooth", "4141080454367972346");
INSERT INTO PORTAFOGLI VALUES("dario69", "4245058018166046");
INSERT INTO PORTAFOGLI VALUES("user", "783584310000");
INSERT INTO PORTAFOGLI VALUES("admin", "111562587000");
INSERT INTO PORTAFOGLI VALUES("simo_p", "583584310887");

/**ABBONAMENTI UTENTI da vedere le prenotazioni eventi se abbonamento scaduto**/
INSERT INTO ABBONAMENTO_UTENTE VALUES("1", "1", "Alyon", "370406126264861", "2022-01-01", "2022-01-01");
INSERT INTO ABBONAMENTO_UTENTE VALUES("2", "1", "user", "783584310000", "2022-05-05", "2022-05-05");
INSERT INTO ABBONAMENTO_UTENTE VALUES("3", "2", "dario69", "4245058018166046", "2022-03-04", "2022-03-04");
INSERT INTO ABBONAMENTO_UTENTE VALUES("4", "2", "simo_p", "583584310887", "2022-12-12", "2022-12-12");
INSERT INTO ABBONAMENTO_UTENTE VALUES("5", "3", "Bigtooth", "4141080454367972346", "2022-12-15", "2022-12-15");

/**EVENTI UTENTI sistemare in conseguenza a sopra**/
INSERT INTO EVENTO_UTENTE VALUES("Alyon", "", "");
INSERT INTO EVENTO_UTENTE VALUES("dario69", "", "");
INSERT INTO EVENTO_UTENTE VALUES("simo_p", "", "");
INSERT INTO EVENTO_UTENTE VALUES("simo_p", "", "");
INSERT INTO EVENTO_UTENTE VALUES("Bigtooth", "", "");
INSERT INTO EVENTO_UTENTE VALUES("Bigtooth", "", "");
INSERT INTO EVENTO_UTENTE VALUES("Bigtooth", "", "");
INSERT INTO EVENTO_UTENTE VALUES("user", "", "");