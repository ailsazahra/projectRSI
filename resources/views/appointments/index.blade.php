<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('appointment-detail') }}
        </h2>
    </x-slot>

    <div class="appointment-cards2">
    @foreach ($appointments as $appointment)
        <div class="card2">
            <p>{{ $appointment->mentor_name }}</p>
            <p>{{ $appointment->expertise }}</p>
            <p>Time: {{ $appointment->time_start }} - {{ $appointment->time_end }}</p>
            <p>Quota: {{ $appointment->booked }}/{{ $appointment->quota }}</p>
            <button class="add-btn">ADD</button>
        </div>
    @endforeach
</div>

</x-app-layout> -->