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
<pre>
<b>Panel klienta zawiera:</b>
- Historie transakcji (data, abonament, rodzaj diety, adres dostawy, fakturę jeśli firma - generowana automatycznie)
- Aktualnie wybraną wybraną dietę wraz z informacją o terminie abonamentu (informacja)
- Kalendarz z opcją zawieszenia dowozu jedzenia do godziny 14:00 dnia poprzedzającego zawieszenie karnetu. Pominięty w dostawie dzień nie zostaje utracony, zostaje doliczony do terminu. Przykład: Abonament trwa od 1 do 10 września. Użytkownik zawiesza dostawę 4 i 5 września. Po tej operacji abonament trwa od 1 do 3 września i od 6 do 12 września. Abonament trwa 10 dni w obu przypadkach.
- Edycje danych (imię, nazwisko, dane do faktury, datę dowozu, godzinę dowozu)
</pre>
</body>
</html>