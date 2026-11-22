# Zerco Infrastructure

Site de prezentare în limba română, scris pentru **PHP 7.4**, fără framework, Composer, Node sau bază de date. Interfață responsive cu bleumarin, albastru deschis și accente galbene, logo PNG cu fundal transparent, fotografii și fonturi locale. JavaScript simplu pentru meniul mobil; FAQ prin elemente HTML native.

## Pornire

Din directorul proiectului, pe un sistem care are PHP instalat:

```sh
php -S localhost:8080 includes/router.php
```

Deschide `http://localhost:8080`. Nu este necesară instalarea de pachete și nu există etapă de build. Pentru publicare, copiază proiectul pe o găzduire PHP, cu `index.php` în directorul public. Fișierul `.htaccess` din rădăcină trebuie încărcat pe server pentru adresele fără extensie; necesită Apache/LiteSpeed cu rescriere URL activă și instalarea în rădăcina domeniului. Rescrierea este internă, fără redirecționări HTTP de la adresele vechi. Pe Nginx, configurează rezolvarea internă a adreselor fără extensie către PHP-FPM, indexul, pagina 404 și blocarea accesului HTTP la `includes/`, fișiere ascunse și documentație.

## Pagini

- Acasă: `/`
- Despre noi: `/despre-noi`
- Servicii: `/servicii`, cu patru pagini generate de `/serviciu?serviciu=...`
- Domenii: `/domenii`
- Proiecte: `/proiecte`, cu scenarii explicit ilustrative pentru un drum local și un pod rutier
- Contact: `/contact`
- Cariere și colaborări: `/cariere`
- Confidențialitate și pagină 404

Datele comune și descrierile serviciilor se editează în `includes/data.php`. Antetul și subsolul sunt comune. SEO: titluri și descrieri pe pagini, URL canonical, metadate Open Graph, favicon, sitemap și robots.txt.

Adresele CSS și JavaScript includ automat o versiune calculată din conținutul fiecărui fișier. La upload, încarcă și `includes/header.php`, pentru ca browserul și cache-ul CDN să solicite versiunea actualizată a resurselor.

Contoarele de pe paginile Acasă, Despre noi și Servicii sunt afișate prin componenta comună `includes/stats.php` și configurate în `$stats` din `includes/data.php`: 15 proiecte finalizate și 25 autorizații emise. Numerele se animează o singură dată la apariția în ecran; rămân vizibile fără JavaScript și fără animație pentru preferința de mișcare redusă.

## Configurarea contactului

Adresa de primire a mesajelor este implicit `office@zercoinfrastructure.ro`, iar expeditorul este `website@zercoinfrastructure.ro`. Formularul permite trimiterea când adresele sunt valide și funcția PHP `mail()` este disponibilă. Valorile implicite pot fi suprascrise prin variabilele de mediu ale serverului PHP:

```text
SITE_URL=https://zercoinfrastructure.ro
CONTACT_EMAIL=office@zercoinfrastructure.ro
MAIL_FROM=website@zercoinfrastructure.ro
```

Găzduirea trebuie să permită trimiterea de la `website@zercoinfrastructure.ro`. PHP citește variabilele prin `getenv()`. Proiectul **nu încarcă automat fișiere `.env`**. Pe hosting fără variabile de mediu, poți configura aceleași valori direct în `includes/data.php`.

Trimiterea folosește funcția PHP `mail()` și transportul MTA configurat de hosting. `MAIL_FROM` trebuie să fie o adresă permisă de acel transport. Nu există un client SMTP sau o integrare cu un furnizor de email în proiect. Configurează transportul și înregistrările DNS aferente domeniului în panoul găzduirii. Confirmarea din formular înseamnă că transportul local a acceptat mesajul, nu o garanție de livrare în inbox.

Formularul include validare pe server și în browser, escaping HTML, token CSRF, honeypot, interval minim de completare, limitare per sesiune și redirecționare după trimitere. Mesajele nu sunt salvate local, iar erorile tehnice nu includ conținutul lor. Limita per sesiune este o protecție de bază; pentru trafic abuziv se poate configura limitare suplimentară în găzduire.

Folosește HTTPS. Dacă serverul stă în spatele unui proxy, configurează în infrastructură semnalizarea HTTPS. Oferă PHP acces la directorul său standard pentru sesiuni.

## Conținut de completat înainte de lansare

- Confirmă serviciile și domeniile propuse în raport cu activitatea reală a firmei. Textele sunt redactate pentru această prezentare, pornind de la domeniul infrastructurii indicat prin referință.
- Completează datele juridice reale, contactul și informarea privind prelucrarea datelor, inclusiv politica de păstrare a corespondenței, înainte să activezi formularul.
- Înlocuiește scenariile cu proiecte reale numai după ce ai descrieri, permisiuni și fotografii potrivite. Nu au fost inventate lucrări realizate, clienți, certificări, rezultate sau statistici.
- Dacă schimbi domeniul, actualizează `SITE_URL`, `sitemap.xml` și `robots.txt`.
- Dacă instalezi într-un subdirector, adaptează `ErrorDocument` din `.htaccess`.

## Fotografii și fonturi

**Nicio imagine nu a fost preluată de pe likeconsulting.ro.** Referința a fost folosită pentru a înțelege tipul de business și structura serviciilor. Textele și stilul sunt create pentru acest proiect. Paleta urmărește logo-ul Zerco furnizat în `assets/images/logo-zerco.jpeg`; versiunea cu fundal transparent folosită în antet și subsol este `assets/images/logo-zerco.png`.

Imagini de ilustrare găzduite local:

- `assets/images/bridge.jpg`: nod rutier, [Pexels, foto 681335](https://www.pexels.com/photo/681335/).
- `assets/images/drum-local.jpg`: varianta de toamnă activă pentru scenariul „Modernizarea unui drum local”, generată cu imagegen; drum rural modernizat, frunziș de toamnă și lumină caldă.
- `assets/images/pod-padure.jpg`: varianta de toamnă activă pentru scenariul „Reabilitarea unui pod rutier”, generată cu imagegen; pod simplu într-o pădure de toamnă, în culori calde.
- `assets/images/drum-local-vara.jpg`: variantă de vară păstrată în assets, momentan neafișată pe site; imagine regenerată cu imagegen pentru scenariul ilustrativ „Modernizarea unui drum local”. Prompt: păstrează drumul local și încadrarea, schimbă anotimpul în primăvară/vară, cu vegetație verde, cer albastru, asfalt gri și lumină neutră, fără tonuri galbene de toamnă. Ajustare finală cu imagegen: culori de vară echilibrate, verde natural mai bogat și contrast moderat, păstrând încadrarea și structurile. Nu documentează un amplasament sau o lucrare reală.
- `assets/images/pod-padure-vara.jpg`: variantă de vară păstrată în assets, momentan neafișată pe site; imagine regenerată cu imagegen pentru scenariul ilustrativ „Reabilitarea unui pod rutier”. Prompt: păstrează podul simplu din beton și încadrarea, schimbă pădurea în primăvară/vară, cu frunziș verde, reflexii albastre în apă și lumină neutră, fără tonuri galbene de toamnă. Ajustare finală cu imagegen: verde temperat, saturație redusă și contrast blând, păstrând încadrarea și structurile. Nu documentează un amplasament sau o lucrare reală.
- `assets/images/architecture.jpg`: imagine cu clădiri folosită în secțiunea „Partenerul tău în dezvoltare” de pe pagina principală, [Unsplash, foto 1486406146926-c627a92ad1ab](https://images.unsplash.com/photo-1486406146926-c627a92ad1ab).

Fotografiile nu documentează lucrări ale firmei. Fonturi DM Sans și Manrope, găzduite local în `assets/fonts/`, cu licențele SIL Open Font License incluse. Site-ul nu apelează Google Fonts la vizitare și nu include analytics, hărți, reclame sau tracking.

## Verificare

Nu au fost scrise teste, conform cerinței. Verificarea sintaxei pentru toate fișierele PHP și încărcarea paginilor și resurselor locale au trecut pe PHP 8.4.28. Logo-ul PNG a fost verificat pe fundal alb și albastru deschis. Verificarea vizuală a paginilor în browser nu a putut fi finalizată după resetarea conexiunii la browser. Nu s-a publicat pe un serviciu extern; proiectul este pregătit pentru găzduire PHP.
