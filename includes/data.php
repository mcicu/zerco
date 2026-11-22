<?php
// Sintaxă compatibilă cu PHP 7.4. Fără framework sau dependențe Composer.
$site = [
    'name' => 'Zerco Infrastructure',
    'url' => rtrim(getenv('SITE_URL') ?: 'https://zercoinfrastructure.ro', '/'),
    'email' => getenv('CONTACT_EMAIL') ?: 'office@zercoinfrastructure.ro',
    'from' => getenv('MAIL_FROM') ?: 'website@zercoinfrastructure.ro',
];
$services = [
    'infrastructura-rutiera' => ['title' => 'Infrastructură rutieră', 'short' => 'Drumuri care conectează.', 'icon' => 'road', 'image' => 'bridge.jpg', 'text' => 'De la traseu și soluția tehnică la documentația pentru execuție. O abordare integrată pentru drumuri, străzi și platforme.', 'items' => ['Studii de fezabilitate și documentații de avizare', 'Proiecte tehnice și detalii de execuție', 'Modernizări de drumuri și străzi', 'Amenajări de intersecții și accese', 'Platforme și parcări'], 'deliverable' => 'Documentații corelate cu situația din teren, cerințele beneficiarului și etapa de investiție.'],
    'poduri-si-structuri' => ['title' => 'Poduri și structuri', 'short' => 'Legături gândite să dureze.', 'icon' => 'bridge', 'image' => 'bridge.jpg', 'text' => 'Soluții pentru continuitatea traseelor și siguranța structurilor, cu atenție la condițiile amplasamentului și la exploatare.', 'items' => ['Studii de soluție pentru traversări', 'Proiectare poduri și podețe', 'Lucrări de sprijin și consolidare', 'Reabilitarea structurilor existente', 'Asistență tehnică de specialitate'], 'deliverable' => 'O soluție structurală documentată, coordonată cu traseul și cu lucrările conexe.'],
    'consultanta-tehnica' => ['title' => 'Consultanță tehnică', 'short' => 'Claritate înainte de decizie.', 'icon' => 'compass', 'image' => 'bridge.jpg', 'text' => 'Sprijin tehnic pentru înțelegerea opțiunilor, a constrângerilor și a etapelor necesare dezvoltării investiției.', 'items' => ['Analiza documentației disponibile', 'Evaluarea opțiunilor tehnice', 'Definirea etapelor de investiție', 'Suport pentru avize și acorduri', 'Coordonare tehnică între specialități'], 'deliverable' => 'O imagine clară asupra pașilor următori, a informațiilor lipsă și a deciziilor necesare.'],
    'asistenta-tehnica' => ['title' => 'Asistență tehnică', 'short' => 'Alături de proiect, în teren.', 'icon' => 'helmet', 'image' => 'bridge.jpg', 'text' => 'Continuitate între proiectare și execuție, prin clarificarea detaliilor și gestionarea aspectelor tehnice apărute în șantier.', 'items' => ['Clarificări asupra proiectului tehnic', 'Participare la întâlniri de coordonare', 'Analiza situațiilor din teren', 'Corelarea modificărilor de proiect', 'Suport pentru documentația finală'], 'deliverable' => 'Răspunsuri tehnice trasabile și documentație actualizată în raport cu soluțiile agreate.'],
];
$scenarios = [
    ['title' => 'Modernizarea unui drum local', 'category' => 'rutier', 'label' => 'Infrastructură rutieră', 'image' => 'drum-local.jpg', 'text' => 'Un traseu coerent, de la analiza terenului la drenaj, siguranță și accesibilitate.', 'service' => 'infrastructura-rutiera'],
    ['title' => 'Reabilitarea unui pod rutier', 'category' => 'poduri', 'label' => 'Poduri și structuri', 'image' => 'pod-padure.jpg', 'text' => 'Analiza structurii existente și definirea soluțiilor de reabilitare, cu atenție la siguranță, durabilitate și continuitatea circulației.', 'service' => 'poduri-si-structuri'],
];
