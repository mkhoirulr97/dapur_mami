<ul class="list-none">
    @foreach ($transactionDetails as $transaction)
        <li>{{ $transaction->menu->name }} <span
                class="text-gray-500">x{{ $transaction->quantity }}</span></li>
    @endforeach
</ul>
