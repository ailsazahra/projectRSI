<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('appointment-detail') }}
        </h2>
    </x-slot>

  
   
    <div class="appointment">
        <!-- Appointment Filter Section -->
        <div class="bg-purple-800 text-white p-6 rounded-lg shadow-md mb-8">
            <h1 class="text-2xl font-bold mb-6">Choose Your Criteria</h1>
            <div class="criteria">
            <div>
               <label class="block font-semibold mb-2">Expertise<br></label>
               <input type="text" id="expertise" placeholder="Expertise" class="w-full p-3 rounded-lg text-gray-900">
            </div>
            <div>
               <label class="block font-semibold mb-2">Date<br></label>
               <input type="date" id="date" placeholder="Date..." class="w-full p-3 rounded-lg text-gray-900">
            </div>

            </div>
            <button onclick="searchAppointments()" class="mt-4 bg-white text-purple-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-200">
                Search
                <svg class="inline w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20a8 8 0 1 0 5.293-14.293l.379-.379.683-.683.707-.707 
                    4.95 4.95-.707.707-.683.683-.379.379A8 8 0 0 0 10 20zm0-16a8 8 0 1 1 0 16 8 8 0 0 1 
                    0-16zm3.536 4.293l-.707.707-1.293 1.293-1.414-1.414 1.293-1.293.707-.707-1.293-1.293 
                    1.414-1.414 1.293 1.293.707-.707 1.293 1.293-1.414 1.414z"/>
                </svg>
       
            </button>
    
            <h2>Scheduled Appointment</h2>

                <div class="appointment-card">
                    <div class="card">...</div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                    <div class="card">...</div>
                </div>

         </div>
    </div>



    <div class="results" id="results">
    <!-- Cards will be dynamically added here -->
    </div>

<script>
    async function searchAppointments() {
        const expertise = document.getElementById("expertise").value;
        const date = document.getElementById("date").value;
        const resultsContainer = document.getElementById("results");

        resultsContainer.innerHTML = ""; // Clear previous results

        try {
            const response = await fetch(`/search?expertise=${expertise}&date=${date}`);
            const appointments = await response.json();

            if (appointments.length > 0) {
                appointments.forEach(session => {
                    // Create a card for each session
                    const card = document.createElement("div");
                    card.classList.add("card-content");
                    card.setAttribute("data-id", session.id); // Add session ID for reference

                    card.innerHTML = `
                    <div class="top">
                        <div class="card-header">
                            <div class="user-icon" style="display: flex; justify-content: center; margin-bottom: 8px;">
                                <svg width="76" height="76" viewBox="0 0 76 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.7702 0C27.3834 0 18.8851 10.5756 18.8851 23.6064C18.8851 36.6371 27.3834 47.2127 37.7702 47.2127C48.157 47.2127 56.6553 36.6371 56.6553 23.6064C56.6553 10.5756 48.157 0 37.7702 0ZM18.0353 47.2127C8.02616 47.6848 0 55.8999 0 66.0978V75.5403H75.5403V66.0978C75.5403 55.8999 67.6086 47.6848 57.5051 47.2127C52.4061 52.9727 45.4186 56.6553 37.7702 56.6553C30.1217 56.6553 23.1342 52.9727 18.0353 47.2127Z" fill="#483D89"/>
                                </svg>
                            </div>
                            <h4>${session.mentor_name}</h4>
                            <span class="expertise">${session.expertise}</span>
                        </div>
                        <div class="card-body">
                            <p><strong>Time:</strong> ${session.time_start} - ${session.time_end}</p>
                            <p class="quota"><strong>Quota:</strong> ${session.booked}/${session.quota}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button ${session.booked >= session.quota ? 'disabled' : ''} onclick="addSession(${session.id})">
                            ${session.booked >= session.quota ? "FULL" : "ADD"}
                        </button>
                    </div>
                `;


                    resultsContainer.appendChild(card);
                });
            } else {
                // If no appointments found, show a message
                const emptyCard = document.createElement("div");
                emptyCard.classList.add("card", "empty");
                emptyCard.innerHTML = `<p>No sessions available</p>`;
                resultsContainer.appendChild(emptyCard);
            }
        } catch (error) {
            console.error("Error fetching appointments:", error);
        }
    }

    

    function addSession(appointmentId) {
        fetch('/add-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ appointment_id: appointmentId }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);

                    // Jika berhasil, perbarui kuota di UI
                    if (data.message === 'Session successfully added!') {
                        // Temukan kartu sesi berdasarkan ID
                        const sessionCard = document.querySelector(`[data-id="${appointmentId}"]`);

                        if (sessionCard) {
                            // Perbarui kuota di kartu
                            const quotaText = sessionCard.querySelector('.quota');
                            quotaText.innerText = `Quota: ${data.booked}/${data.quota}`;

                            // Nonaktifkan tombol jika kuota penuh
                            const addButton = sessionCard.querySelector('button');
                            if (data.booked >= data.quota) {
                                addButton.disabled = true;
                                addButton.innerText = "FULL";
                            }
                        } else {
                            console.error("Session card not found in DOM.");
                        }
                    }
                }
            })
            .catch(error => console.error('Error updating session:', error));
    }


</script>

    
</x-app-layout>


