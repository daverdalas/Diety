<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        a {
            display:block;
        }
    </style>
</head>
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel/users', 'lista klientów');?>
<pre>
<b>Panel administratora zawiera:</b>
- Listę klientów - widoczne imię, nazwisko, wybrana dieta
- Podstrona klienta - imię, nazwisko, wybrana dieta, adres dostawy, adres do faktury, NIP,  (opcjonalny), godzina dostawy, kalendarz dostaw, historia płatności
- Wyszukiwarkę klientów - po imieniu, diecie, dacie ważności karnetu, po dniu dostawy
- Możliwość wydrukowania listy klientów na dany dzień/dni (Info o kliencie - Imię, nazwisko, adres dostawy, telefon, rodzaj diety, data dowozu)
- Edycję danych klientów
- Edycję i dodawanie planów abonamentowych (każda dieta ma 3 warianty cenowe w zależności od ilości kalorii)
- Możliwość skasowania zamówienia
</pre>
</body>
</html>