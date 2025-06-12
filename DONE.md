# Wykonane zadania i przemyślenia - Aplikacja To-Do List

## Zrealizowane funkcjonalności

1. ✅ Podstawowe operacje CRUD dla zadań:
   - Tworzenie nowych zadań
   - Wyświetlanie listy zadań
   - Edycja istniejących zadań
   - Usuwanie zadań

2. ✅ Struktura zadań zawierająca:
   - Tytuł
   - Opis
   - Status (do zrobienia, w trakcie, zakończone)
   - Priorytet (niski, średni, wysoki)
   - Termin wykonania

3. ✅ Filtrowanie zadań:
   - Według statusu
   - Według priorytetu
   - Według terminu wykonania
   - Rozwiązano problem z filtrowaniem zadań według statusu i priorytetu poprzez zastosowanie niewrażliwości na wielkość liter
   - Naprawiono błąd `InvalidArgumentException: Illegal operator and value combination` przy filtrowaniu według daty

4. ✅ Historia zmian zadań:
   - Śledzenie zmian statusu, priorytetu i terminu wykonania
   - Wyświetlanie historii zmian dla każdego zadania
   - Poprawiono wygląd historii zmian, zwiększając rozmiar ikon w linii czasu
   - Ulepszono strukturę HTML i CSS dla lepszej semantyki kodu

5. ✅ System powiadomień:
   - Wysyłanie przypomnień e-mail o zbliżających się terminach zadań
   - Implementacja zadań cyklicznych do wysyłania przypomnień

6. ✅ Udostępnianie zadań:
   - Możliwość udostępnienia zadania innym użytkownikom poprzez link
   - Dostęp do szczegółów zadania bez konieczności logowania

7. ✅ Responsywny interfejs użytkownika:
   - Aplikacja dostosowana do urządzeń mobilnych i desktopowych
   - Wykorzystanie Tailwind CSS do stylizacji
   - Dodano responsywny widok dla listy zadań z osobnym układem dla urządzeń mobilnych
   - Zaimplementowano tryb ciemny z odpowiednimi klasami Tailwind CSS

8. ⚠️ Integracja z Google Calendar:
   - Przygotowano instrukcję implementacji w README.md
   - Nie zaimplementowano w pełni ze względu na konieczność konfiguracji API Google

## Rozwiązane problemy

1. **Problem z filtrowaniem zadań**
   - Filtrowanie nie działało poprawnie ze względu na różnice w wielkości liter
   - Rozwiązanie: Zmodyfikowano metody `scopeByStatus` i `scopeByPriority` w modelu `Task` do niewrażliwości na wielkość liter

2. **Błąd przy filtrowaniu według daty**
   - Błąd `InvalidArgumentException: Illegal operator and value combination`
   - Rozwiązanie: Poprawiono metodę `scopeByDueDate` w modelu `Task`

3. **Problem z zapisywaniem historii przy usuwaniu zadań**
   - Błąd integralności klucza obcego podczas usuwania zadań
   - Rozwiązanie: Zmodyfikowano metodę `destroy` w kontrolerze `TaskController`, aby najpierw zapisywać historię usunięcia zadania, a dopiero potem usuwać zadanie z bazy danych

4. **Problemy z wyświetlaniem UI w trybie ciemnym**
   - Rozwiązanie: Dodano klasy Tailwind CSS dla trybu ciemnego (dark:border-gray-700, dark:bg-gray-900, dark:text-gray-300)

## Przemyślenia na temat projektu

### Architektura i struktura kodu

Projekt został zbudowany zgodnie z architekturą MVC frameworka Laravel, co zapewniło czytelną strukturę kodu i łatwość jego utrzymania. Wykorzystano następujące elementy:

- **Modele**: Zdefiniowano relacje między zadaniami, historiami zmian i użytkownikami
- **Kontrolery**: Logika biznesowa została odpowiednio podzielona między kontrolery
- **Widoki**: Zastosowano Blade do tworzenia szablonów z komponentami wielokrotnego użytku
- **Obserwatory**: Wykorzystano obserwatory do automatycznego śledzenia zmian w zadaniach

### Wyzwania implementacyjne

1. **Responsywność interfejsu**
   - Wyzwanie: Stworzenie interfejsu, który dobrze wygląda zarówno na urządzeniach mobilnych, jak i desktopowych
   - Rozwiązanie: Zastosowano podejście "mobile-first" z dwoma różnymi widokami dla urządzeń mobilnych i desktopowych

2. **Historia zmian**
   - Wyzwanie: Efektywne śledzenie i prezentowanie historii zmian zadań
   - Rozwiązanie: Wykorzystano obserwatory Laravel do automatycznego zapisywania zmian oraz stworzono przejrzysty interfejs z osią czasu

3. **System przypomnień**
   - Wyzwanie: Niezawodne wysyłanie przypomnień o zbliżających się terminach
   - Rozwiązanie: Wykorzystano Laravel Scheduler i kolejki zadań do asynchronicznego przetwarzania przypomnień

### Możliwości rozwoju projektu

1. **Pełna integracja z Google Calendar**
   - Implementacja synchronizacji dwukierunkowej między zadaniami a wydarzeniami w Google Calendar

2. **Zaawansowane powiadomienia**
   - Dodanie powiadomień push w przeglądarce
   - Integracja z komunikatorami (Slack, Discord)

3. **Współpraca zespołowa**
   - Rozbudowa funkcji udostępniania zadań o możliwość przydzielania zadań członkom zespołu
   - Dodanie komentarzy do zadań

4. **Analityka**
   - Dodanie dashboardu z wykresami i statystykami dotyczącymi wykonanych zadań
   - Śledzenie czasu poświęconego na zadania

5. **Aplikacja mobilna**
   - Stworzenie natywnej aplikacji mobilnej korzystającej z API Laravel

### Wnioski końcowe

Projekt To-Do List został zrealizowany zgodnie z większością wymagań funkcjonalnych i technicznych. Zastosowano dobre praktyki programistyczne, takie jak:

- Walidacja danych wejściowych
- Obsługa błędów i wyjątków
- Wykorzystanie migracji i seederów
- Responsywny interfejs użytkownika

Napotkane problemy zostały rozwiązane w sposób efektywny, a kod jest czytelny i łatwy w utrzymaniu. Projekt ma potencjał do dalszego rozwoju i dodawania nowych funkcjonalności.
