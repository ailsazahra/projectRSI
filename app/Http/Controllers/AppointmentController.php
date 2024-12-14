<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
            public function search(Request $request)
            {
                $query = Appointment::query();

                if ($request->filled('expertise')) {
                    $query->where('expertise', 'like', '%' . $request->expertise . '%');
                }

                if ($request->filled('date')) {
                $query->whereDate('date', '=', $request->date);
                }

                
                
                $appointments = $query->get();

                if ($appointments->isEmpty()) {
                    return response()->json([]);
                }
                return response()->json($appointments);
                
            }
           

            public function index()
            {
                $appointments = Appointment::all(); // Ambil semua data dari tabel appointments
                return view('appointments.index', compact('appointments')); // Kirim ke view
            }
            

        public function storeSelectedSession(Request $request)
        {
            $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
            ]);

            $appointmentId = $request->appointment_id;

            // Cek apakah user sudah memilih sesi ini sebelumnya
            $existing = \App\Models\SelectedSession::where('user_id', auth()->id())
                ->where('appointment_id', $appointmentId)
                ->first();

            if ($existing) {
                return response()->json(['message' => 'You have already selected this session.'], 400);
            }

            // Simpan sesi yang dipilih ke database
            $selectedSession = \App\Models\SelectedSession::create([
                'user_id' => auth()->id(), // ID pengguna yang sedang login
                'appointment_id' => $appointmentId,
            ]);

            return response()->json(['message' => 'Session added successfully!', 'data' => $selectedSession]);
        }

        public function addSession(Request $request)
        {
            $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
            ]);

            $appointment = Appointment::find($request->appointment_id);

            if (!$appointment) {
                return response()->json(['message' => 'Session not found.'], 404);
            }

            // Cek apakah kuota penuh
            if ($appointment->booked >= $appointment->quota) {
                return response()->json(['message' => 'Session quota is full.'], 400);
            }

            // Cek apakah user sudah memilih sesi ini sebelumnya
            $existing = \App\Models\SelectedSession::where('user_id', auth()->id())
                ->where('appointment_id', $appointment->id)
                ->first();

            if ($existing) {
                return response()->json(['message' => 'You have already selected this session.'], 400);
            }

            // Tambahkan sesi ke tabel SelectedSession
            \App\Models\SelectedSession::create([
                'user_id' => auth()->id(),
                'appointment_id' => $appointment->id,
            ]);

            $appointment->update([
                'booked' => $appointment->booked + 1,
            ]);
        

            return response()->json([
                'message' => 'Session successfully added!',
                'booked' => $appointment->booked,
                'quota' => $appointment->quota,
            ]);
        }

        





        // public function addSession(Request $request)
        // {
        //     $request->validate([
        //         'mentor_name' => 'required|string',
        //         'date' => 'required|date',
        //         'time_start' => 'required',
        //         'time_end' => 'required',
        //     ]);

        //     $session = Appointment::where('mentor_name', $request->mentor_name)
        //         ->where('date', $request->date)
        //         ->where('time_start', $request->time_start)
        //         ->first();

        //     if ($session) {
        //         // Update the booked count if the quota is not exceeded
        //         if ($session->booked < $session->quota) {
        //             $session->booked += 1;
        //             $session->save();

        //             return response()->json([
        //                 'success' => true,
        //                 'message' => 'Session successfully added to your schedule!',
        //             ]);
        //         } else {
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Session quota is full.',
        //             ]);
        //         }
        //     }

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Session not found.',
        //     ]);
        // }

        public function dashboard()
        {
            $selectedSessions = \App\Models\SelectedSession::with('appointment') // Relasi ke model Appointment
                ->where('user_id', auth()->id()) // Filter berdasarkan pengguna yang login
                ->get();

            // Pastikan hanya mengirimkan sesi yang dipilih
            return view('dashboard', compact('selectedSessions'));
        }

        public function unaddSession(Request $request)
        {
            $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
            ]);

            // Hapus sesi berdasarkan user yang sedang login dan ID sesi
            $deleted = \App\Models\SelectedSession::where('user_id', auth()->id())
                ->where('appointment_id', $request->appointment_id)
                ->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Session removed successfully!']);
            }

            return response()->json(['success' => false, 'message' => 'Session not found or already removed.'], 400);
        }








}