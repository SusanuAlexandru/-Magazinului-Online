# Magazinului-Online
Specificații pentru Proiectul Magazinului Online - Echipamente Sportive
1. Obiectivul Proiectului
Scopul proiectului este de a dezvolta un site de tip magazin online pentru echipamente
sportive care permite utilizatorilor să caute, să vizualizeze și să cumpere produse sportive,
 precum echipament de fitness, accesorii pentru sporturi de echipă, echipament outdoor, și alte
 articole similare. Proiectul va include funcționalități specifice, cum ar fi secțiuni dedicate
 pentru diferite tipuri de sporturi, pachete speciale de produse și recenzii detaliate.
3. Funcționalitățile Site-ului
2.1. Funcționalități pentru Utilizatori
Autentificare și Înregistrare
Utilizatorii trebuie să se poată înregistra și autentifica pe site. Informațiile includ: nume, prenume, email, parolă (criptată).
Utilizatorii trebuie să poată reseta parola în caz de nevoie.
Navigare și Vizualizare Produse
Utilizatorii trebuie să poată căuta produse după nume, categorie sau sport (ex. fotbal, fitness, ciclism).
Produsele vor avea descrieri detaliate, imagini, prețuri, recenzii ale utilizatorilor și informații de stoc.
Filtrare avansată după tip de echipament, preț, brand sau sport.
Adăugare în Coș și Comenzi
Utilizatorii pot adăuga produse în coș și vizualiza coșul de cumpărături.
Funcționalitate de actualizare a cantităților în coș, adăugare sau eliminare a produselor.
Posibilitatea de a adăuga pachete speciale de produse la preț redus (ex. seturi de echipament).
Plată și Livrare
Opțiuni de plată multiple (de exemplu, plata la livrare sau prin card).
Livrare la domiciliu sau preluare de la magazin (dacă există puncte fizice de preluare).
Recenzii și Evaluări
Utilizatorii pot lăsa recenzii și evaluări pentru produse, oferind feedback despre calitate și utilizare.
Secțiune de recenzii detaliate pentru a ajuta alți utilizatori să ia decizii informate.
2.2. Funcționalități pentru Administrator
Administrarea Produselor
Administratorii pot adăuga, edita sau șterge produse, inclusiv gestionarea stocurilor.
Produsele trebuie să aibă atribute de categorie (fotbal, ciclism, fitness), preț, descriere, brand, stoc disponibil și imagine.
Gestionarea Comenzilor
Administratorii pot vizualiza comenzile plasate, inclusiv statusul acestora (în așteptare, confirmată, expediată).
Gestionarea retururilor și schimburilor (în caz de neconformități sau cereri ale utilizatorilor).
Raportare și Analiză
Administratorii pot vizualiza rapoarte despre vânzări, produse cele mai vândute și feedback-ul utilizatorilor.
4. Tehnologii Utilizate
Backend: PHP 8.x pentru dezvoltarea funcționalităților principale ale aplicației.
Bază de date: MySQL pentru stocarea informațiilor despre utilizatori, produse, comenzi, categorii și recenzii.
Frontend: HTML, CSS și JavaScript pentru interfața de utilizator.
Framework: Slim pentru partea de backend.
5. Arhitectura Sistemului
4.1. Structura Bazei de Date
Tabelul users: Stochează informații despre utilizatori (id, nume, email, parolă).
Tabelul products: Stochează informații despre produse (id, nume, descriere, preț, stoc, categorie_id, brand).
Tabelul categories: Stochează informații despre categorii de produse (id, nume).
Tabelul orders: Stochează comenzile efectuate de utilizatori (id, user_id, data_comenzii, status).
Tabelul order_items: Stochează produsele din fiecare comandă (id, order_id, product_id, cantitate).
Tabelul reviews: Stochează recenziile lăsate de utilizatori (id, product_id, user_id, rating, comentariu, data).
4.2. Structura de Fişiere
app/: Include directoarele și fișierele pentru modele și controlere.
Models/: Conține modelele pentru tabelele din baza de date (User.php, Product.php, Order.php, Review.php).
Controllers/: Conține controlerele pentru manipularea resurselor (UserController.php, ProductController.php, OrderController.php, ReviewController.php).
config/: Fișierele de configurare, inclusiv database.php pentru conectarea la baza de date.
public/: Directorul accesibil publicului, cu fișierele frontend, imaginile și punctul de intrare (index.php).
index.php: Punctul de intrare în aplicație, include configurările și rutele.
routes/: Fișierul web.php unde sunt definite toate rutele aplicației.
views/: Fișierele .php pentru interfața utilizatorului (ex. home.php, product_details.php, cart.php, reviews.php).
6. Module de Lucru pentru Stagiari
Echipa de Dezvoltare Frontend (2 Elevi)
Interfața Utilizatorului: Dezvoltarea paginilor HTML și implementarea CSS pentru un design atractiv și responsive, specific pasionaților de sport.
JavaScript: Implementarea funcționalităților de client-side, cum ar fi actualizarea în timp real a coșului, afișarea recenziilor și implementarea filtrărilor de produse.
Echipa de Dezvoltare Backend (2 Elevi)
Autentificare și Gestionarea Utilizatorilor: Dezvoltarea autentificării și autorizării utilizatorilor, validarea datelor.
Gestionarea Produselor și Comenzilor: Scripturi pentru CRUD pentru produse, gestionarea comenzilor, gestionarea stocurilor și a recenziilor.
7. Cerințe Funcționale
Validare Formulare: Toate formularele (înregistrare, autentificare, checkout) validate atât client-side (JavaScript), cât și server-side (PHP).
Securitate: Parolele utilizatorilor trebuie criptate folosind bcrypt.
Gestionare Erori: Trebuie gestionate toate erorile și excepțiile, oferind feedback utilizatorului (ex. produsul nu mai este în stoc).
8. Cerințe Non-Funcționale
Usability: Interfața trebuie să fie ușor de utilizat și să ofere o experiență intuitivă, atrăgătoare pentru pasionații de sport.
Scalabilitate: Sistemul trebuie să fie gândit pentru a suporta creșterea numărului de produse, categorii și utilizatori.
Documentație: Codul trebuie să fie bine comentat, iar echipa să realizeze documentație pentru fiecare funcționalitate dezvoltată.
9. Funcționalități Speciale pentru Domeniul Echipamentelor Sportive
Pachete Speciale: Utilizatorii pot cumpăra pachete promoționale de produse (ex. echipament complet pentru un sport specific la preț redus).
Recenzii și Evaluări: Utilizatorii pot lăsa recenzii pentru produse, iar aceste recenzii pot fi filtrate pentru a arăta cele mai utile.
Ghid de Marimi: Pentru echipamentele de îmbrăcăminte, va exista un ghid de mărimi pentru a ajuta utilizatorii să aleagă mărimea corectă.

