# Deliveboo-final-project

### Riproduzione web app per ordinare cibo a domicilio.

#### NAVIGAZIONE
- [Home page](#home-page)
- [Pagina ristoratore vista cliente](#pagina-ristorante-vista-cliente)
  - [Checkout](#checkout)
  - [Pagamento](#pagamento)
  - [Mail di conferma al cliente](#mail-di-conferma-al-cliente)
- [Ordine](#ordine)
- [Registrazione](#registrazione)
- [Pagina ristoratore vista proprietario](#pagina-ristorante-vista-proprietario)
  - [Aggiungere o modificare piatto](#aggiungere-o-modificare-piatto)
  - [Lista ordini ricevuti](#lista-ordini-ricevuti)
  - [Statistiche](#statistiche)
  - [Mail di conferma al ristoratore](#mail-di-conferma-al-ristoratore)

#### HOME PAGE
![Alt text](./Deliveboo7/screenshots/home_1.png?raw=true "home")
![Alt text](./Deliveboo7/screenshots/home_2.png?raw=true "home")

Deliveboo permette di cercare uno specifico ristorante o di cercarne uno in base alla sua tipologia.

---

#### PAGINA RISTORANTE VISTA CLIENTE
![Alt text](./Deliveboo7/screenshots/restaurant_customer.png?raw=true "restaurant_customer")

Accedendo alla pagina del ristorante scelto, il cliente può aggiungere al carello i piatti scelti nella quantità desiderata, che è possibile variare direttamente dal carrello stesso. Al cliente è sempre visibile il momentaneo costo totale dell'intero ordine, e quello di ogni singola voce. 

---

#### ORDINE
- ##### CHECKOUT
![Alt text](./Deliveboo7/screenshots/checkout.png?raw=true "checkout")

Al cliente vengono richiesti alcuni dati, necessari per la consegna dell'ordine.

- ##### PAGAMENTO
![Alt text](./Deliveboo7/screenshots/payment.png?raw=true "pagamento")

Si passa al pagamento, integrato grazie a [Braintree](https://www.braintreepayments.com/it).

- ##### MAIL DI CONFERMA AL CLIENTE
![Alt text](./Deliveboo7/screenshots/mail_customer.png?raw=true "mail_customer")

Se il pagamento va a buon fine, il cliente riceve una mail di conferma dell'avvenuta presa in carico dell'ordine. Il servizio mail è stato integrato grazie a [Mailtrap](https://mailtrap.io/).

---

#### REGISTRAZIONE
![Alt text](./Deliveboo7/screenshots/sign_in.png?raw=true "sign_in")

Il ristoratore ha la possibilità di registrare la sua attività sul portale.

---

#### PAGINA RISTORANTE VISTA PROPRIETARIO
![Alt text](./Deliveboo7/screenshots/restaurant_owner1.png?raw=true "restaurant_owner")
![Alt text](./Deliveboo7/screenshots/restaurant_owner2.png?raw=true "restaurant_owner")

Il ristoratore, dalla pagine della sua attività, può vedere tutto il suo menu, compresi i prodotti che sceglie di non mostrare al pubblico (per esempio prodotti momentaneamente non disponibili).

- ##### AGGIUNGERE O MODIFICARE PIATTO
![Alt text](./Deliveboo7/screenshots/new_dish.png?raw=true "new_dish")

Il ristoratore può aggiungere nuovi piatti al suo menu o modificare quelli già esistenti.

- ##### LISTA ORINI RICEVUTI
![Alt text](./Deliveboo7/screenshots/orders.png?raw=true "orders")

Il ristoratore ha accesso alla lista degli ordini ricevuti, divisi tra quelli in elaborazione, quelli rifiutati e quelli già evasi. Può dichiarare evaso un ordine in elaborazione e viceversa riportare in elaborazione un ordine precedentemente dichiarato evaso.

- ##### STATISTICHE
![Alt text](./Deliveboo7/screenshots/stats.png?raw=true "stats")

Il ristoratore può consultare la pagina dedicata a svariate statistiche riguardanti la sua attività. Le statistiche sono state integrate grazie a [Chart.js](https://www.chartjs.org/).

- ##### MAIL DI CONFERMA AL RISTORATORE
![Alt text](./Deliveboo7/screenshots/mail_owner.png?raw=true "mail_owner")

Quando un cliente effettua un ordine ed il suo pagamento va buon fine, il ristoratore riceve una mail con il riepilogo dell'ordine.

---

