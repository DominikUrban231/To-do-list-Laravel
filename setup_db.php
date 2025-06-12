<?php

// Konfiguracja dla bazy danych Laragon
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

// Zamień nazwę bazy danych na "todolist"
$envContent = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=todolist', $envContent);
$envContent = preg_replace('/DB_USERNAME=.*/', 'DB_USERNAME=root', $envContent);
$envContent = preg_replace('/DB_PASSWORD=.*/', 'DB_PASSWORD=', $envContent);

// Zapisz zaktualizowany plik .env
file_put_contents($envFile, $envContent);

echo "Plik .env został zaktualizowany. Nazwa bazy danych zmieniona na 'todolist'.\n";
echo "Upewnij się, że baza danych 'todolist' istnieje w Twoim systemie.\n";
