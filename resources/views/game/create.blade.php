 <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Nieuwe game
        </h1>

        <form method="POST" action="{{ route('game.store') }}">
            @csrf

            <div>
                <label for="opponent_id">
                    Tegenstander
                </label>

                <select
                    id="opponent_id"
                    name="opponent_id"
                >
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">
                Start game
            </button>
        </form>
    </div>