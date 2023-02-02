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
DROP TABLE IF EXISTS FORM;

/**
Creazione Tabelle
*/
CREATE TABLE UTENTE(
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL, 
    Email VARCHAR(100) NOT NULL, 
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL, 
    DataNascita DATE NOT NULL, 
    Privilegio INT NOT NULL default 0,
    PRIMARY KEY(Username)
    );

CREATE TABLE CARTA(
    NumeroCarta VARCHAR(19) NOT NULL, 
    Circuito VARCHAR(50) NOT NULL,
    CCV CHAR(3) NOT  NULL,
    DataScadenza DATE NOT NULL, 
    Intestatario VARCHAR(100) NOT NULL,
    PRIMARY KEY(NumeroCarta)
    );

CREATE TABLE ABBONAMENTO(
    IdAbbonamento INT NOT NULL AUTO_INCREMENT,
    TitoloAbb VARCHAR(100) NOT NULL, 
    Descrizione VARCHAR(1024), 
    Prezzo DECIMAL(10,2) NOT NULL, 
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
    AltImg VARCHAR(512),
    PRIMARY KEY(IdLocale)
    );

CREATE TABLE EVENTO(
    IdEvento INT NOT NULL AUTO_INCREMENT, 
    NomeEvento VARCHAR(100) NOT NULL, 
    Descrizione VARCHAR(2048) NOT NULL, 
    IdLocale INT NOT NULL, 
    DataOraInizio DATETIME NOT NULL, 
    DataOraFine DATETIME NOT NULL,
    PRIMARY KEY(IdEvento),
    FOREIGN KEY (IdLocale) REFERENCES LOCALE(IdLocale) ON DELETE CASCADE ON UPDATE CASCADE
    );


CREATE TABLE PORTAFOGLIO(
    Username VARCHAR(100) NOT NULL, 
    NumeroCarta VARCHAR(19) NOT NULL,
    PRIMARY KEY(Username, NumeroCarta),
    FOREIGN KEY (Username) REFERENCES UTENTE(Username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (NumeroCarta) REFERENCES CARTA(NumeroCarta) ON DELETE CASCADE ON UPDATE CASCADE 
    );

CREATE TABLE ABBONAMENTO_UTENTE(
    IdAbbUtente INT NOT NULL AUTO_INCREMENT,
    IdAbbonamento INT NOT NULL,  
    Username VARCHAR(100) NOT NULL, 
    NumeroCarta VARCHAR(19) NOT NULL, 
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
    PRIMARY KEY(Username, IdEvento),
    FOREIGN KEY (Username) REFERENCES UTENTE(Username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdEvento) REFERENCES EVENTO(IdEvento) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE FORM(
    IdForm INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(50),
    Cognome VARCHAR(50),
    Email VARCHAR(100),
    Msg VARCHAR(2048),
    DataInvio DATE NOT NULL,
    PRIMARY KEY(IdForm)
    );


/**UTENTI**/
INSERT INTO UTENTE VALUES("admin", "$2y$10$wrvZiy1egezeMrYQ.LIvAe64zjSZHUnmhOU/n4xFZCFML9kVRKnRe", "admin@gmail.com", "Mario", "Rossi", '1992-01-23', 1); 
INSERT INTO UTENTE VALUES("user", "$2y$10$V0IDAKje8lFy8BCCac/YZ.SPERXNWh2onazKJ3U6pTgxNP4PhaHOS", "user@gmail.com", "Luca", "Galeazzo", '1975-06-11', 0); 
INSERT INTO UTENTE VALUES('user2',	'$2y$10$ehHVSTcjGYXQRGQgJ1HeReFrxfhgfG9hVylaUWlkS8/eUV.oNx/W6',	'user2@gmail.com',	'Utente',	'Registrato',	'1999-02-08',	0);


/**CARTE**/;
INSERT INTO CARTA VALUES("340000000000000", "Maestro", "057", "2025-05-12", "Mario Rossi");

/**ABBONAMENTI**/
INSERT INTO ABBONAMENTO VALUES("1", "Base", "NULL", "100", "1", "1000");
INSERT INTO ABBONAMENTO VALUES("2", "Pro", "NULL", "220", "5", "3000");
INSERT INTO ABBONAMENTO VALUES("3", "Super", "NULL", "365", "10", "7000");

/**LOCALI **/
INSERT INTO LOCALE VALUES("1", "Fluido Caf&egrave;", "Via Pirandello, 65", "Caffetteria con un'ampia selezione di libri da cui attingere per immergersi in una rilassante lettura mentre si assaporano caff&egrave; e dolci fatti in casa.", "50", "/images/locali/fluido_cafe.webp", "Bar molto luminoso con tavolini e bancone in legno");
INSERT INTO LOCALE VALUES("2", "Extra Extra", 'Via Umberto <abbr title="primo">I</abbr>, 75', 'Discoteca più <span lang="en">In</span> del Metaverso, con <span lang="en">djset</span> ed eventi per tutti i gusti. Ambiente <span lang="en">chic</span> ed elegante, ma senza selezione all&#39;ingresso.', "700", "/images/locali/extra_extra.webp", "Discoteca affollata con grande sala da ballo");
INSERT INTO LOCALE VALUES("3", 'Rush IN', "Via della Croce Verde, 2", 'Pista per <span lang="en">Kart</span> con circuito sia <span lang="en">indoor</span> che <span lang="en">outdoor</span>. I <span lang="en">kart</span> sono noleggiabili per il tempo desiderato e se siete amanti della guida sportiva il divertimento &egrave; assicurato.', "100", "/images/locali/rush_in.webp", "Pista Kart su più piani coperta");
INSERT INTO LOCALE VALUES("4", "Bagni Venere", "Via Fratelli Cervi, 73", 'Piscine <span lang="en">indoor</span> e <span lang="en">outdoor</span>, termali e olimpioniche, con idromassaggio e senza, insomma... per tutti i gusti. &egrave; possibile accedere alla SPA per usufruire di saune, massaggi rilassanti e trattamenti. Il bar offre servizio <span lang="en">open</span> bar dalle 18 alle 23.', "150", "/images/locali/bagni_venere.webp", "Piscine con sdrai all'interno di una grotta");
INSERT INTO LOCALE VALUES("5", "Sala Conferenze Dante Alighieri", "Via Dante Alighieri, 1", 'Sala conferenze che ospita presentazioni di libri, comizi, interviste e addirittura numerosi <span lang="en">TedX</span>. Posto perfetto per ampliare la propria cultura e i propri orizzonti.', "300", "/images/locali/sala_conferenze_dante_a.webp", "Sala conferenze con numerosi posti disposti in forma semicircolare");

/**EVENTI **/ 
INSERT INTO EVENTO VALUES("1", "Salone del libro", "Il salone del libro &egrave; un evento frequentemente tenuto al Fluido Caf&egrave; e che
                            ha
                            come obiettivo quello di promuovere
                            la lettura e il libro come mezzo di conoscenza e intrattenimento. Durante il salone del
                            libro,
                            vengono organizzati incontri con
                            autori, presentazioni di libri, tavole rotonde e altre attività culturali. Il salone del
                            libro &egrave;
                            aperto a tutti e rappresenta
                            un'occasione unica per conoscere le novità editoriali, scambiare opinioni con gli autori e
                            gli
                            esperti del settore e partecipare
                            a interessanti dibattiti su temi culturali e sociali. Inoltre, il salone del libro offre
                            l'opportunità di acquistare libri a
                            prezzi scontati e di partecipare a <span lang=""en"">workshop</span> e laboratori dedicati
                            alla
                            scrittura e all'editoria. Insomma, il salone del libro
                            &egrave; un appuntamento imperdibile per gli appassionati di lettura e per chi vuole essere sempre
                            aggiornato sull'evoluzione del mondo
                            dell'editoria.", "1", "2023-02-15 17:00:00", "2023-03-15 19:00:00");
INSERT INTO EVENTO VALUES("2", "Vida Loca", "Vieni a scatenarti al ritmo del raggaeton più travolgente della stagione!
                            La
                            nostra discoteca
                            si trasformerà in un'arena dove potrai ballare e cantare insieme ai tuoi amici alle <span
                                lang=""en"">hit</span> del momento e alle canzoni
                            storiche del genere. Le luci e le decorazioni a tema ti faranno immergere completamente
                            nell'atmosfera latina,
                            mentre il <span lang=""en""><abbr title=""disc jockey"">DJ</abbr></span> mixerà le canzoni per
                            creare una serata indimenticabile. Ma non &egrave; tutto: durante la serata ci saranno
                            anche animazioni e performance di ballo per rendere la festa ancora più coinvolgente. Non
                            perdere l'occasione
                            di vivere una notte indimenticabile all'insegna del divertimento e della musica latina!", "2", "2023-02-25 22:00:00", "2023-02-25 23:30:00");
INSERT INTO EVENTO VALUES("3", "Spirit techno", "Venite a vivere la notte più emozionante della vostra vita al nostro
                            evento
                            <span lang=""en"">techno</span> in discoteca!
                            Preparatevi a sentire il battito delle vostre pulsazioni al ritmo delle migliori tracce
                            <span lang=""en"">techno</span>, mentre vi lasciate
                            trasportare dalle luci stroboscopiche e dall'atmosfera elettrizzante della nostra pista da
                            ballo. Con i nostri <span lang=""en""><abbr title=""disc jockey"">DJ</abbr></span>
                            di fama internazionale ai piatti, questa &egrave; una serata che non dimenticherete facilmente. Non
                            perdete l'opportunità
                            di unirvi a noi e scatenarvi al ritmo della <span lang=""en"">techno</span> più pura!", "2", "2023-02-21 22:00:00", "2023-02-22 06:00:00");
INSERT INTO EVENTO VALUES("4", "Ride", "Vieni a vivere l'adrenalina delle corse sui <span lang=""en"">kart</span> in
                            una
                            <span lang=""en"">location</span> mozzafiato! In <span lang=""en"">indoor</span> e <span
                                lang=""en"">oudoor</span>,
                            potrai sfrecciare su piste sinuose e sfidare gli avversari in emozionanti gare. Con la
                            nostra
                            struttura
                            all'avanguardia e il personale altamente qualificato, ti garantiamo sicurezza e divertimento
                            assoluti.
                            Non perdere l'occasione di vivere una giornata indimenticabile alla guida dei nostri <span
                                lang=""en"">kart</span> performanti.
                            Prenota subito la tua esperienza di corse mozzafiato!", "3", "2023-02-20 09:00:00", "2023-02-20 20:00:00");
INSERT INTO EVENTO VALUES("5", "Day Spa", "Una giornata in spa &egrave; il modo perfetto per rilassarsi e coccolarsi.
                            Immagina
                            di passare
                            la giornata in un ambiente tranquillo e rilassante, circondato da bellezze naturali e con
                            una
                            vista mozzafiato.
                            Potrai godere delle piscine termali calde e rilassanti, che ti aiuteranno a sciogliere ogni
                            tensione muscolare.
                            Inoltre, potrai scegliere tra una varietà di massaggi, che ti aiuteranno a rilassare il
                            corpo e
                            la mente.
                            E per rendere la tua giornata ancora più speciale, c'&egrave; anche un open bar con bevande
                            rinfrescanti e <span lang=""en"">snack</span>
                            leggeri, perfetti per rilassarsi al sole. Tutto questo ti aspetta in una giornata in spa,
                            dove
                            potrai godere
                            di momenti di benessere e <span lang=""en"">relax</span> assoluti.", "4", "2023-02-17 08:00:00", "2023-02-17 23:00:00");
INSERT INTO EVENTO VALUES("6", "Lotta alla mafia con Saviano", "Vi invitiamo a unirvi a noi per ascoltare Roberto Saviano, autore e
                            giornalista italiano che
                            ha dedicato la sua carriera a denunciare il potere e la violenza della camorra e della
                            mafia.
                            Durante il suo
                            comizio, Saviano condividerà la sua profonda conoscenza della storia e delle dinamiche della
                            camorra,
                            e racconterà le sue personali esperienze nella lotta contro queste organizzazioni criminali.", "5", "2023-02-09 17:00:00", "2023-02-09 20:30:00");

/**PORTAFOGLI**/
INSERT INTO PORTAFOGLIO VALUES("user", "340000000000000");

/**ABBONAMENTI UTENTI**/
INSERT INTO ABBONAMENTO_UTENTE VALUES("2", "3", "user", "340000000000000", "2023-12-01", "2023-12-07");

/**EVENTI UTENTI id evento data iscr**/
INSERT INTO EVENTO_UTENTE VALUES("user", "1", "2023-01-05");
INSERT INTO EVENTO_UTENTE VALUES("user", "3", "2022-12-10");
INSERT INTO EVENTO_UTENTE VALUES("user", "4", "2022-12-27");
INSERT INTO EVENTO_UTENTE VALUES("user", "5", "2022-12-28");