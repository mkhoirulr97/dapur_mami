@if ($data == null)
    <p>-</p>
@else
    <a href="{{ asset('storage/payment_proof/' . $data) }}" target="_blank">
        <div class="avatar">
            <div class="w-16 rounded">
                <img src="{{ asset('storage/payment_proof/' . $data) }}" alt="Tailwind-CSS-Avatar-component" />
            </div>
        </div>
    </a>
@endif
