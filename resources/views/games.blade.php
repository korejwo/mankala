<h2>Finished</h2>
<ul>
    @foreach ($finished as $game)
        <li>{{ $game['name'] }}</li>
    @endforeach
</ul>

<h2>Opened</h2>
<ul>
    @foreach ($opened as $game)
        <li>{{ $game->name }}</li>
    @endforeach
</ul>
