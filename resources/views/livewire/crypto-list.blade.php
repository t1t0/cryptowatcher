<div>
    @foreach ($cryptos as $crypto)
    <div class='flex p-4'>
        <div class='grow text-lg'>{{ $crypto['name'] }} <span>({{ $crypto['symbol'] }})</span></div>
        <div class='basis-80'>{{$crypto['price']}}</div>
    </div>
    @endforeach
</div>

@script
<script>
    setInterval(() => {
        $wire.$refresh()
    }, 300000)
</script>
@endscript