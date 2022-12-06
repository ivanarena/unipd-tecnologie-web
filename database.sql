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
DROP TABLE IF EXISTS LOCALE;
DROP TABLE IF EXISTS EVENTO;
DROP TABLE IF EXISTS ABBONAMENTO;
DROP TABLE IF EXISTS CARTA;
DROP TABLE IF EXISTS UTENTE;

/**
Creazione Tabelle
*/
CREATE TABLE UTENTE(
    Email VARCHAR(100) NOT NULL, 
    Username VARCHAR(20) UNIQUE NOT NULL,
    Password VARCHAR(50) NOT NULL, 
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL, 
    DataNascita DATE NOT NULL, 
    LuogoNascita VARCHAR(50) NOT NULL,
    --Borsellino DECIMAL(10,2) NOT NULL default 0.00,
    Privilegio INT NOT NULL default 1,
    PRIMARY KEY(Email)
    );

CREATE TABLE CARTA(
    NumeroCarta CHAR(16) NOT NULL, 
    Circuito VARCHAR(50) NOT NULL, 
    DataScadenza DATE NOT NULL, 
    Intestatario VARCHAR(50) NOT NULL,
    PRIMARY KEY(NumeroCarta)
    );

CREATE TABLE ABBONAMENTO(
    IdAbbonamento INT NOT NULL AUTO_INCREMENT,
    TitoloAbb VARCHAR(100) NOT NULL, 
    Descrizione VARCHAR(1024) NOT NULL, 
    Prezzo DECIMAL(10,2) NOT NULL, 
    DurataAbb INT NOT NULL,
    EventiSettimanali INT NOT NULL,
    --Borsellino DECIMAL(10,2) NOT NULL,
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
    Email VARCHAR(100) NOT NULL, 
    NumeroCarta CHAR(16) NOT NULL,
    PRIMARY KEY(Email, NumeroCarta),
    FOREIGN KEY (Email) REFERENCES UTENTE(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE 
    );

CREATE TABLE ABBONAMENTO_UTENTE(
    IdAbbUtente INT NOT NULL AUTO_INCREMENT,
    IdAbbonamento INT NOT NULL,  
    Email VARCHAR(100) NOT NULL, 
    NumeroCarta CHAR(16) NOT NULL, 
    DataPagamento DATE NOT NULL, 
    DataScadenza DATE NOT NULL,
    PRIMARY KEY(IdAbbUtente),
    FOREIGN KEY (IdAbbonamento) REFERENCES ABBONAMENTO(IdAbbonamento) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Email) REFERENCES UTENTE(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE UTENTE_EVENTO(
    Email VARCHAR(100) NOT NULL,
    IdEvento INT NOT NULL,
    DataIscrizione DATETIME NOT NULL,
    PRIMARY KEY(Email,IdEvento),
    FOREIGN KEY (Email) REFERENCES UTENTE(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdEvento) REFERENCES EVENTO(IdEvento) ON DELETE CASCADE ON UPDATE CASCADE
    );
