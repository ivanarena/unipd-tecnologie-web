
ABBONAMENTO(IdAbb, NomeAbb, Descrizione, Prezzo, DurataAbb)
ABBONAMENTO-UTENTE(IdAbbonato, Username, IdAbb, DataInizio)
PAGAMENTO()

CREATE TABLE UTENTE(
    Username, Eta,
    Email VARCHAR(100) NOT NULL, 
    Password VARCHAR(50) NOT NULL, 
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL, 
    DataNascita DATE NOT NULL, 
    LuogoNascita VARCHAR(50) NOT NULL, 
    Privilegio default 1;
    PRIMARY KEY(Email)
    );

CREATE TABLE CARTA(
    NumeroCarta CHAR(16) NOT NULL, 
    Circuito VARCHAR(50) NOT NULL, 
    DataScadenza DATE NOT NULL, 
    Intestatario VARCHAR(50) NOT NULL,
    PRIMARY KEY(NumeroCarta)
    );

CREATE TABLE PORTAFOGLIO(
    Email VARCHAR(100) NOT NULL, 
    NumeroCarta CHAR(16) NOT NULL,
    PRIMARY KEY(Email, NumeroCarta),
    FOREIGN KEY (Email) REFERENCES UTENTE(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE 
    );