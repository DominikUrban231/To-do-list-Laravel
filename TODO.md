# Zadanie rekrutacyjne - Aplikacja To-Do List

## Opis zadania
Stwórz aplikację "To-Do list", która umożliwia użytkownikowi dodawanie, edytowanie, przeglądanie i usuwanie zadań (CRUD) oraz wysyłanie powiadomień e-mail.

## Wymagania funkcjonalne

1. CRUD dla zadań:
   - Pełne operacje CRUD (Create, Read, Update, Delete) na zadaniach, z następującymi polami:
   - Nazwa zadania (max 255 znaków, wymagane)
   - Opis (opcjonalnie)
   - Priorytet (low/medium/high)
   - Status (to-do, in progress, done)
   - Termin wykonania (data, wymagane)

2. Przeglądanie zadań:
   - Filtrowanie listy zadań według priorytetów, statusu i terminu.

3. Powiadomienia e-mail:
   - Powiadomienie e-mail na 1 dzień przed terminem zadania.
   - Wykorzystanie mechanizmów Laravel (Queues i Scheduler).

4. Walidacja:
   - Właściwa walidacja wszystkich formularzy.
   - Sprawdzanie wymaganych pól.
   - Weryfikacja formatu daty.
   - Kontrola limitów znaków dla pól tekstowych.

5. Obsługa wielu użytkowników:
   - System logowania i rejestracji użytkowników.
   - Każdy użytkownik zarządza wyłącznie swoimi zadaniami.
   - Wykorzystanie wbudowanego systemu uwierzytelniania Laravel.

6. Udostępnianie zadań:
   - Generowanie publicznych linków z tokenem dostępu do zadań.
   - Ograniczenie czasowe ważności linku.
   - Dostęp do szczegółów zadania bez konieczności logowania.
   - Automatyczne blokowanie dostępu po upływie ważności linku.

## Wymagania techniczne

1. Back-end:
   Laravel 11, REST API, Eloquent ORM, MySQL/SQLite, migracje baz danych.
2. Front-end:
   Prosty interfejs użytkownika stworzony w Laravel Blade (opcjonalnie AJAX).
3. (Opcjonalnie) Konfiguracja w Dockerze:
   Możliwość dostarczenia projektu z konfiguracją Docker (Dockerfile, docker-compose.yml). Dzięki temu uruchomienie aplikacji będzie łatwiejsze.

## Ocena projektu

Przy ocenie zwracamy największą uwagę na:
- Poprawność działania (brak błędów, poprawnie wdrożone operacje CRUD)
- Bezpieczeństwo aplikacji.
- Strukturę i czytelność kodu (zgodność z zasadami SOLID, KISS)
- Znajomość Laravel (obsługa Eloquent ORM, migracje, kontrolery, walidacja, powiadomienia, polityki itd.)
- Obsługę błędów w aplikacji.
- Wykonanie "Dodatkowe funkcje (opcjonalne)".

## Czas realiacji

7 dni od otrzymania zadania.

## Instrukcje przekazania

- Dołącz do repozytorium plik README.md z instrukcją uruchomienia i konfiguracji projektu.
- Dołącz do repozytorium plik TODO.md z treścią zadania rekrutacyjnego.
- Dołącz do repozytorium plik DONE.md gdzie opiszesz co zostało zrobione i wszystkie przemyślenia na temat projektu i wykonania.
- Prześlij link do repozytorium na GitHub/GitLab (upewnij się, że repozytorium jest publiczne).
- Jeśli używasz Dockera, dodaj pliki konfiguracyjne i instrukcje uruchomienia w README.md.
Gotowe rozwiązanie wyślij na adres: rekrutacja@gruparbr.pl 


