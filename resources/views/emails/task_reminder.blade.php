<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przypomnienie o zadaniu</title>
</head>
<body style="font-family: sans-serif; background-color: #f9fafb; padding: 2rem;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827; margin-bottom: 1rem;">
            Przypomnienie o zadaniu
        </h1>

        <p style="font-size: 1rem; color: #374151; margin-bottom: 0.5rem;">
            <strong>Nazwa zadania:</strong> {{ $task->name }}
        </p>

        <p style="font-size: 1rem; color: #374151; margin-bottom: 0.5rem;">
            <strong>Opis:</strong> {{ $task->description ?? 'Brak opisu' }}
        </p>

        <p style="font-size: 1rem; color: #374151; margin-bottom: 0.5rem;">
            <strong>Termin wykonania:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d.m.Y') }}
        </p>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="{{ url('/tasks/'.$task->id) }}"
               style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #10b981; color: white; font-weight: 600; border-radius: 0.375rem; text-decoration: none;">
                Przejdź do zadania
            </a>
        </div>
    </div>
</body>
</html>
