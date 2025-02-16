## **Scopo:** 

* Fornire API per gestione dei dati nel database.
* Implementare funzioni CRUD per gestire gli utenti, i piani giornalieri, singoli pasti e gli alimenti.

</br>

# **Organizzazione dei file:** 

## File `index.php`:

* Richiama tutte le funzioni e file necessari per la connessione al db, prende i dati della URI , richiama `routes.php`, ridireziona il traffico verso il controller specifico

## Cartella `./app`

* Contiene il file `routes.php`, il quale crea un vero e proprio registro dove vi sono i dati di routing.

* Contiene la cartella `./controllers` con i controller che tramite funzioni dedicate, si occupano di gestire i dati e caricare le risorse necessarie.

* La cartella `./models` contenente le entità con i loro metodi specifici che vanno a richiamare per ogni richiesta la query opportuna.