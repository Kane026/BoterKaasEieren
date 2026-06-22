    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Mijn spellen
        </h1>

        <a href="{{ route('game.create') }}">
            Nieuwe game starten
        </a>

        <ul class="mt-4">
            @foreach($games as $game)
                <li>
                    <a href="{{ route('game.show', $game) }}">
                        Game #{{ $game->id }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>