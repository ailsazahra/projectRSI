<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="hero">
        <div class="bg-purple-800 text-white p-6 rounded-lg shadow-md mb-8">
                <h1>Link with People and <br> Level Up Your Journey!</h1>
                <a href="http://127.0.0.1:8000/appointment-detail">
                <button><b>Connect Now!</b></button>
                </a>
            </div>
            <div class="appointments">
            </div>

            <h2 >Scheduled Appointment</h2>
                <div class="appointment-card">
                    <div class="card"></div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                </div>
        </div>
        <!-- Scheduled Appointments Section -->
        <div class="appointments">

            <div class="appointment-cards">
                @forelse($selectedSessions as $selectedSession)
                <div class="card">
                    <div class="card-header-dash">
                        <div>
                            <h3>{{ date('d', strtotime($selectedSession->appointment->date)) }}</h3>
                        </div>
                        <div>
                            <p><b>{{ date('l', strtotime($selectedSession->appointment->date)) }}</b></p>
                            <div class="time">
                                <p>{{ $selectedSession->appointment->time_start }} - {{ $selectedSession->appointment->time_end }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-dash">
                        <div class="user-info">
                            <div class="user-svg">
                                <svg width="56" height="76" viewBox="0 0 76 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.7702 0C27.3834 0 18.8851 10.5756 18.8851 23.6064C18.8851 36.6371 27.3834 47.2127 37.7702 47.2127C48.157 47.2127 56.6553 36.6371 56.6553 23.6064C56.6553 10.5756 48.157 0 37.7702 0ZM18.0353 47.2127C8.02616 47.6848 0 55.8999 0 66.0978V75.5403H75.5403V66.0978C75.5403 55.8999 67.6086 47.6848 57.5051 47.2127C52.4061 52.9727 45.4186 56.6553 37.7702 56.6553C30.1217 56.6553 23.1342 52.9727 18.0353 47.2127Z" fill="#FFFFFF"/>
                                </svg>
                            </div>
                            <div>
                                <h4>{{ $selectedSession->appointment->mentor_name }}</h4>
                                <p><b>{{ strtoupper($selectedSession->appointment->expertise) }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="unadd-btn" data-id="{{ $selectedSession->appointment->id }}">
                            <b>UNADD</b>
                        </button>
                    </div>
                </div>
                @empty
                <p class="no-appointments-message">You have no scheduled <br>appointments.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Script Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const unaddButtons = document.querySelectorAll('.unadd-btn');

            unaddButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const appointmentId = this.dataset.id;

                    fetch('/unadd-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ appointment_id: appointmentId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Session removed successfully!');
                            location.reload(); // Reload halaman setelah berhasil
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Something went wrong. Please try again.');
                    });
                });
            });
        });
    </script>
</x-app-layout>