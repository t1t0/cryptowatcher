<div>
    <div class='bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-6'>
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
            <div class='grow m-4'>
                <x-ts-select.native :options="$coins" select="label:label|value:value" wire:model="newCoin" />
            </div>
            <div class='m-4'>
                <x-ts-button round wire:click="addCoinToList">Add Coin</x-ts-button>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @foreach ($cryptos as $crypto)
            <div class='flex p-4'>
                <div class='grow text-lg'>{{ $crypto['name'] }} <span>({{ $crypto['symbol'] }})</span></div>
                <div class='basis-80'>{{$crypto['price']}}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@script
<script>
    //setInterval(() => {
    //    $wire.$refresh()
    //}, 300000)
</script>
@endscript