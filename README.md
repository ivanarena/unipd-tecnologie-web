# Progetto di laboratorio del corso di Tecnologie Web A.A. 2022/2023

## Getting Started

1. Assicurati di avere installato Docker Desktop
2. Clona la repo (preferibilmente via SSH)
3. Spostati nella repo e lancia il comando  ``docker-compose up -d``
4. Per visualizzare il sito vai su localhost (o localhost:80)
5. Per gestire il database vai su localhost:8080
6. DB username : "root" e password : "password"

## Specifiche Tecniche

1. Il sito web deve essere realizzato con lo standard XHTML Strict, o HTML5. Le pagine in HTML5 devono degradare in modo elegante e devono rispettare la sintassi XML;
2. Il layout deve essere realizzato con CSS puri (CSS2 o CSS3);
3. L’uso dei layout Flex e Grid, se sviluppati in maniera corretta ed utilizzati ragionevolmente, vengono valutati molto positivamente;
4. Il sito web deve rispettare la completa separazione tra contenuto, presentazione e comportamento;
5. Il sito web deve essere accessibile a tutte le categorie di utenti;
6. Il sito web deve organizzare i propri contenuti in modo da poter essere facilmente reperiti da qualsiasi utente;
7. Il sito web deve contenere pagine che utilizzino script PHP per collezionare e pubblicare dati inseriti dagli utenti (deve essere sviluppata anche la possibilità di modifica e cancellazione dei dati stessi);
8. Deve essere presente una forma di controllo dell’input inserito dall’utente, sia lato client che lato server;
9. I dati inseriti dagli utenti devono essere salvati in un database;
10. È preferibile che il database sia in forma normale.

Il progetto deve essere accompagnato da una relazione che ne illustri le fasi di progettazione, realizzazione e test ed evidenzi il ruolo svolto dai singoli componenti del gruppo.

Viene richiesta un'analisi iniziale delle caratteristiche degli utenti che il sito si propone di raggiungere e le possibili ricerche sui motori di ricerca a cui il sito deve rispondere.

Le pagine web devono essere accessibili indipendentemente dal browser e dalle dimensioni dello schermo del dispositivo degli utenti. Considerazioni riguardanti diversi dispositivi (laddove possibile) verranno valutate positivamente.

***NB: Il non rispetto di anche una sola di queste regole comporta la non sufficienza del progetto!***

## Regole per la consegna del progetto

***NB: Il non rispetto di anche una sola di queste regole può comportare l'esclusione dalla consegna o una penalizzazione nella valutazione!***

1. La relazione deve contenere in prima pagina:
   1. indirizzo web del sito;
   2. eventuali password degli utenti da utilizzare in fase di correzione (una coppia login-passwd per ogni classe di utenza), in particolare:
      1. l’utente amministratore, se presente, deve avere login e password uguali ad admin;
      2. l’utente semplice, se presente, deve avere login e password uguali ad user;
   3. indirizzo email del referente del gruppo per eventuali comunicazioni.
2. I file PHP devono avere i permessi corretti;
3. Il sito deve utilizzare link relativi in modo da poter essere facilmente installato anche su server o cartelle diverse. Se l’installazione necessita di operazioni particolari queste devono essere indicate in relazione;
4. Il progetto deve essere consegnato in due modi:
   1. Il progetto deve essere installato sulla macchina tecweb.studenti.math.unipd.it, sulla home page di uno dei componenti del gruppo (questa login verrà bloccata per il tempo necessario alla correzione, in genere almeno due settimane).
   2. Tramite un form di consegna che verrà attivato ad ogni sessione d’esame all’interno della piattaforma moodle alla pagina del corso.
