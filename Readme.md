# cooking.pl
## opis

Projekt typowej platformy webowej zbudowany w PHP 5 w oparciu o framework CodeIgniter przy uzyciu IntelliJ Idea 14.0.3

CodeIgniter: http://www.codeigniter.com/

IntelliJ: http://www.jetbrains.com/idea/download/

## instalacja

1. sklonować repozytorium na serwer docelowy
2. założyć na serwerze bazę mysql i skonfigurować ją w pliku https://github.com/think-01/BodyChief/blob/master/application/config/database.php
3. skonfigurować aplikację za pomocą pliku .htaccess
4. uruchomić url /migrate dla aplikacji
5. usunąć plik test.sql
6. usunąć plik /application/controllers/Migrate.php z serwera
7. usunąć plik /application/controllers/Test.php z serwera
7. usunąć katalog /application/migrations z serwera

## konfiguracja .htaccess

aplikację konfigurujemy na serwerze za pomocą pliku .htaccess:

```
SetEnv ___MAIL_USER uzytkownik_smtp
SetEnv ___MAIL_PASS haslo_smtp
SetEnv ___MAIL_PORT port_smtp
SetEnv ___MAIL_HOST host_smtp

SetEnv ___PAYU_POSID id_posa_pauy
SetEnv ___PAYU_SIG klucz_payu
```

## testowa zawartość bazy

testowe dane do bazy znajdują się w pliku test.sql

UWAGA: niektóre identyfikatory w rekordach testowych ( np. id płatności payu ) są fikcyjne i moga powodować nieprawidłowe działanie aplikacji, s pełni sprawne konto należy założyć ręcznie lub skorzystać z danych:
```
user: slawek@t01.pl
pass: 123456
```
## widoki
```
/application/views/alert.php // plik techniczny

/application/views/errors // szablony podstron błędów ( domyslne )
/application/views/email // szablony wiadomości email
/application/views/guest // szablony dla niezalogowanego użytkownika
/application/views/user // szablony dla zalogowanego użytkownika
/application/views/pdf // szablony generowanych pdf'ów

/application/views/user/panels/admin // szablon panelu administratora
/application/views/user/panels/user // szablon panelu użytkownika
```
## konfiguracja w widokach

widok /application/views/user/panels/admin/diet.php zawiera konfigurację asortymentu sklepu w postaci dwóch tablic:
```
<?
    $periods = array(
        'TESTOWA' => 1,
        '1 DZIEN' => 1,
        '1 TYDZIEN' => 7,
        '2 TYGODNIE' => 14,
        '3 TYGODNIE' => 21,
        '4 TYGODNIE' => 28,
    );
    $energy = array(
        '500',
        '1000',
        '1500',
        '2000',
        '2500',
    );
?>
```
## adresy url aplikacji
```
/index.php/
/index.php/login
/index.php/register
/index.php/order

/admin_panel
/index.php/admin_panel/users
/admin_panel/user/[ID_USERA]
/admin_panel/history
/index.php/admin_panel/diets
/index.php/admin_panel/diet/[ID_DIETY]
/index.php/order/delete/[ID_ZAMÓWIENIA]
/index.php/admin_panel/shedule/[DATA np. 2015-11-19]
/index.php/admin_panel/payment_status/[ID_PLATNOSC_PAYU np. BHJ38Q3GR3151002GUEST000P01]

/index.php/user_panel
/index.php/user_panel/edit/[ID_KARNETU]
/index.php/order
/index.php/user_panel/history
/index.php/order/invoice/[ID_FAKTURY]
/index.php/order/process/[ID_ZAMOWIENIA]
/index.php/user_panel/edit_user
```
## integracja z payu

notyfikacje z systemu payu powinny byc wysyłane zgodnie ze specyfikacją payu na url:

/index.php/order/notify

## komunikaty i tłumaczenia

niestandardowe komunikaty znajdują się w pliku /application/languages/english/form_validation_lang.php
