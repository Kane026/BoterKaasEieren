<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
    
    
</head>
<body>
    
</body>
</html>
 <div class="p-6">
        <h1 class="text-2xl font-bold">
            Game #{{ $game->id }}
        </h1>

        <p>
            X: {{ $game->playerX->name }}
        </p>

        <p>
            O: {{ $game->playerO->name }}
        </p>

        <p>
            Status: {{ $game->status }}
        </p>

        <p>
            Aan de beurt: {{ $game->current_turn }}
        </p>

        <h2 class="mt-6 font-bold">
            Gespeelde zetten
        </h2>

        <ul>
            @foreach($game->rounds as $round)
                <li>
                    Zet {{ $round->turn_number }}
                    - {{ $round->symbol }}
                    ({{ $round->row }}, {{ $round->column }})
                </li>
            @endforeach
        </ul>
        <div class="board" style="display: grid; grid-template-columns: repeat(3, 100px); grid-template-rows: repeat(3, 100px);">

    @foreach($bord as $rowIndex => $row)
        @foreach($row as $colIndex => $cell)
            <form method="POST" action="{{ route('game.move', $game->id) }}">
                @csrf
                <input type="hidden" name="row" value="{{ $rowIndex }}">
                <input type="hidden" name="col" value="{{ $colIndex }}">

                <button 
                    type="submit"
                    style="width: 100px; height: 100px; border: 2px solid black; 
                           font-size: 2rem; background: none; cursor: pointer;"
                    {{ $cell ? 'disabled' : '' }}
                >
                    {{ $cell ?? '' }}
                </button>
            </form>
        @endforeach
    @endforeach

</div>
    </div>