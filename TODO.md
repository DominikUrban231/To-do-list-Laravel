# Zadanie rekrutacyjne - Aplikacja To-Do List

## Cel zadania
Stworzenie aplikacji do zarządzania zadaniami (To-Do List) przy użyciu frameworka Laravel, z uwzględnieniem dobrych praktyk programistycznych i responsywnego interfejsu użytkownika.

## Wymagania funkcjonalne

1. Podstawowe operacje CRUD dla zadań:
   - Tworzenie nowych zadań
   - Wyświetlanie listy zadań
   - Edycja istniejących zadań
   - Usuwanie zadań

2. Każde zadanie powinno zawierać:
   - Tytuł
   - Opis
   - Status (do zrobienia, w trakcie, zakończone)
   - Priorytet (niski, średni, wysoki)
   - Termin wykonania

3. Filtrowanie zadań:
   - Według statusu
   - Według priorytetu
   - Według terminu wykonania

4. Historia zmian zadań:
   - Śledzenie zmian statusu, priorytetu i terminu wykonania
   - Wyświetlanie historii zmian dla każdego zadania

5. System powiadomień:
   - Wysyłanie przypomnień e-mail o zbliżających się terminach zadań
   - Możliwość ustawienia czasu przypomnienia przed terminem

6. Udostępnianie zadań:
   - Możliwość udostępnienia zadania innym użytkownikom poprzez link
   - Użytkownik otrzymujący link powinien móc zobaczyć szczegóły zadania bez logowania

7. Responsywny interfejs użytkownika:
   - Aplikacja powinna być dostosowana do urządzeń mobilnych i desktopowych
   - Wykorzystanie Tailwind CSS do stylizacji

8. Integracja z Google Calendar:
   - Umożliwienie przypięcia zadania do Google Kalendarza za pomocą integracji z biblioteką spatie/laravel-google-calendar
   - Użytkownik powinien mieć możliwość skojarzenia ważnych zadań z kalendarzem Google

## Wymagania techniczne

1. Framework Laravel w najnowszej stabilnej wersji
2. Baza danych MySQL lub PostgreSQL
3. Autentykacja użytkowników z wykorzystaniem Laravel Breeze
4. Walidacja danych wejściowych
5. Obsługa błędów i wyjątków
6. Testy jednostkowe dla kluczowych funkcjonalności
7. Dokumentacja API (jeśli implementowane)
8. Kod zgodny z PSR-12
9. Wykorzystanie migracji i seederów do inicjalizacji bazy danych
10. Wykorzystanie Laravel Scheduler do planowania przypomnień

## Kryteria oceny

1. Poprawność implementacji wymaganych funkcjonalności
2. Jakość i czytelność kodu
3. Wydajność aplikacji
4. Pokrycie testami
5. Responsywność i estetyka interfejsu użytkownika
6. Bezpieczeństwo aplikacji
7. Dokumentacja projektu
