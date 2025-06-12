# To-Do List - Aplikacja do zarządzania zadaniami

Aplikacja do zarządzania zadaniami zbudowana w Laravel z funkcjami takimi jak filtrowanie, historia zmian, przypomnienia e-mail i integracja z Google Calendar.

## Wymagania systemowe

- PHP 8.1 lub wyższy
- Composer
- MySQL lub MariaDB
- Node.js i NPM
- Laragon, XAMPP lub podobne środowisko lokalne (opcjonalnie)

## Instalacja

1. Sklonuj repozytorium:
   ```bash
   git clone https://github.com/twoje-konto/To-do-list.git
   cd To-do-list
   ```

2. Zainstaluj zależności PHP:
   ```bash
   composer install
   ```

3. Zainstaluj zależności JavaScript:
   ```bash
   npm install
   ```

4. Skompiluj zasoby:
   ```bash
   npm run dev
   ```

5. Skopiuj plik środowiskowy i wygeneruj klucz aplikacji:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. Skonfiguruj połączenie z bazą danych w pliku `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todolist
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Uruchom migracje i seedery:
   ```bash
   php artisan migrate --seed
   ```

## Konfiguracja powiadomień e-mail

1. Skonfiguruj ustawienia SMTP w pliku `.env`:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=twoja_nazwa_użytkownika
   MAIL_PASSWORD=twoje_hasło
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@todolist.com
   MAIL_FROM_NAME="To-Do List"
   ```

2. Aby włączyć automatyczne przypomnienia, skonfiguruj zadanie cron:
   ```bash
   * * * * * cd /ścieżka/do/projektu && php artisan schedule:run >> /dev/null 2>&1
   ```

## Konfiguracja Google Calendar

1. Utwórz projekt w Google Cloud Console i włącz Google Calendar API.

2. Utwórz poświadczenia OAuth 2.0 i pobierz plik credentials.json.

3. Umieść plik credentials.json w katalogu `storage/app/google-calendar/`.

4. Skonfiguruj ustawienia Google Calendar w pliku `.env`:
   ```
   GOOGLE_CALENDAR_ID=primary
   GOOGLE_CALENDAR_AUTH_PROFILE=oauth
   ```

5. Uruchom polecenie, aby autoryzować aplikację:
   ```bash
   php artisan google:oauth:login
   ```

## Uruchomienie aplikacji

1. Uruchom serwer deweloperski:
   ```bash
   php artisan serve
   ```

2. Otwórz aplikację w przeglądarce pod adresem: `http://localhost:8000`

## Funkcje

- Zarządzanie zadaniami (dodawanie, edycja, usuwanie)
- Filtrowanie zadań według statusu, priorytetu i daty
- Historia zmian zadań
- Przypomnienia e-mail o zbliżających się terminach
- Integracja z Google Calendar
- Responsywny interfejs użytkownika

## Licencja

Ten projekt jest udostępniany na licencji MIT.
