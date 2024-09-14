# App Delivery Backend

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Descrizione

Questo repository contiene il backend dell'app di delivery, responsabile della gestione degli ordini, autenticazione utente, interazioni con il database e integrazioni con il sistema di pagamento. L'API è stata sviluppata utilizzando **Laravel** per garantire scalabilità, sicurezza e facilità di manutenzione.

## Funzionalità

- Gestione degli utenti (registrazione, login, autenticazione).
- Aggiunta e modifica di un ristorante.
- Visualizzazione del menu del ristorante e aggiunta e modifica piatti.
- Visualizzazione Ordini e dettagli.
- visualizzazione statistiche ordini mensili con dettagli giornalieri.
- API RESTful per la comunicazione con il frontend.
- Integrazione con il sistema di pagamento Braintree.
- Supporto per database relazionali (MySQL).

## Requisiti

Prima di iniziare, assicurati di avere installato:

- [PHP](https://www.php.net/) >= 7.4
- [Composer](https://getcomposer.org/) - Gestore di pacchetti PHP
- [MySQL](https://www.mysql.com/) o un altro database SQL compatibile
- Un account **Braintree** per i pagamenti
- [Node.js](https://nodejs.org/) e **npm** (per compilare gli asset frontend con **Sass** e **Bootstrap**)

## Installazione

Segui questi passi per installare il progetto in locale:

1. Clona il repository:

    ```bash
    git clone https://github.com/WalterCorsini/app-delivery-back.git
    ```

2. Entra nella directory del progetto:

    ```bash
    cd app-delivery-back
    ```

3. Installa le dipendenze PHP usando Composer:

    ```bash
    composer install
    ```

4. Installa le dipendenze frontend (Sass, Bootstrap) con npm:

    ```bash
    npm install
    ```

5. Crea un file `.env` nella root del progetto e aggiungi le variabili di ambiente necessarie:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=delivery_app
    DB_USERNAME=root
    DB_PASSWORD=password
    
    BRAINTREE_MERCHANT_ID=your_merchant_id
    BRAINTREE_PUBLIC_KEY=your_public_key
    BRAINTREE_PRIVATE_KEY=your_private_key
    ```

6. Esegui le migrazioni del database:

    ```bash
    php artisan migrate
    ```

7. Avvia il server di sviluppo Laravel:

    ```bash
    php artisan serve
    ```

    Il server sarà disponibile su `http://localhost:8000`.

8. Compila gli asset frontend:

    ```bash
    npm run dev
    ```

## Struttura del progetto

Di seguito è una rapida panoramica della struttura principale dei file nel progetto:

```bash
app-delivery-back/
├── app/            # Contiene i controller, modelli, e altri componenti di Laravel
├── config/         # Configurazioni per l'applicazione (database, ambiente, ecc.)
├── public/         # Asset pubblici come CSS e JS
├── resources/      # Views e file Sass per il frontend
├── routes/         # Definizione delle rotte API
├── database/       # Migrazioni e seeding del database
├── .env            # Variabili di ambiente (non incluso nel repository)
├── composer.json   # Dipendenze PHP e configurazione di Laravel
├── package.json    # Dipendenze frontend (npm)
└── README.md       # Il file che stai leggendo
```


## Tecnologie Utilizzate
- Laravel - Framework PHP per la gestione delle funzionalità backend.
- PHP - Linguaggio di programmazione usato per costruire l'applicazione.
- MySQL - Database relazionale per memorizzare gli utenti, gli ordini e altre entità.
- Bootstrap - Framework CSS per il frontend, utilizzato insieme a Sass.
- Sass - Preprocessore CSS utilizzato per strutturare meglio gli stili.
- Chart.js - Libreria JavaScript per visualizzare grafici e statistiche nella dashboard.
- Braintree - Integrazione con il sistema di pagamento per gestire le transazioni.
