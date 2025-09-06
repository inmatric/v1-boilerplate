@extends('components.layouts.main-layout')
@section('title', 'Attendance')
@section('content')

    @php
        $attendanceType = request()->get('type', 'end'); // default 'end'
    @endphp

    <p class="max-w-lg text-3xl font-semibold leading-loose text-gray-900 dark:text-white text-center">Form Attendance</p>
    <form
        class="max-w-lg mx-auto mt-8 space-y-6 p-8 border-2 border-gray-300 rounded-lg shadow-lg bg-white dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400"
        method="POST" action="{{ route('attendances.store') }}">
        @csrf
        <input type="hidden" name="attendance_type" value="{{ $attendanceType }}">
        <div class="mb-5">
            <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
            <select id="employee_id" name="employee_id"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DATE</label>
            <p id="current-date" class="text-gray-900 dark:text-white text-sm font-semibold"></p>
            <input type="hidden" name="date" id="hidden-date"> {{-- Input hidden untuk tanggal --}}
        </div>

        <div class="mb-5">
            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PHOTO</label>
            <button type="button" onclick="startCamera()"
                class="w-full bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-200">Open
                Camera</button>
            <div class="mt-4">
                <p id="time-status" class="mt-2 text-sm font-semibold"></p>

                <video id="video" width="100%" height="auto" autoplay class="mt-3 rounded-lg hidden shadow-md"></video>
                <canvas id="canvas" style="display: none;"></canvas>
                <div class="mt-3">
                    <button type="button" onclick="takePicture()"
                        class="bg-cyan-500 hover:bg-cyan-500 text-white py-2 px-4 rounded-lg transition duration-200">Take
                        Picture</button>
                    <button type="button" id="retryButton" onclick="retryCapture()"
                        class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-lg transition duration-200 hidden">Retry</button>
                    <img id="captured-image" src="" alt="Captured Image" class="mt-3 w-full rounded-lg hidden shadow-md">
                    <div id="photo-info" class="mt-3 text-sm text-gray-600 dark:text-gray-300 hidden">
                        <p id="timestamp"></p>
                        <p id="coordinates"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between">
            <button type="submit"
                class="text-white bg-cyan-500 hover:bg-cyan-500 focus:ring-4 focus:outline-none focus:ring-cyan-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 dark:bg-cyan-500 dark:hover:bg-cyan-500 dark:focus:ring-cyan-500">
                SUBMIT
            </button>
            <button type="button" onclick="window.location='{{ route('attendances.index') }}'"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition duration-200">BACK</button>
        </div>
    </form>

    <script>
        function checkAttendanceTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const currentTime = hours * 60 + minutes;

            // Batas waktu untuk form attendance (16.00 - 20.00) untuk end
            const startTime = 13 * 60; // 16:00
            const endTime = 20 * 60;   // 20:00
            const label = "13.00 - 20.00";

            const timeStatus = document.getElementById('time-status');

            if (currentTime >= startTime && currentTime <= endTime) {
                timeStatus.textContent = `You are within the attendance time (${label}).`;
                timeStatus.classList.remove('text-red-600');
                timeStatus.classList.add('text-green-600');
            } else {
                timeStatus.textContent = `Attendance time is over! (${label})`;
                timeStatus.classList.remove('text-green-600');
                timeStatus.classList.add('text-red-600');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('current-date').textContent = getCurrentDate();
            document.getElementById('hidden-date').value = getCurrentDateDatabaseFormat(); // Set format YYYY-MM-DD untuk database
            checkAttendanceTime(); // Cek waktu saat ini
        });
        function getCurrentDate() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            return `${day}-${month}-${year}`;
        }
        function getCurrentDateDatabaseFormat() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        let currentPosition = null; // Store the current location coordinates
        let cameraStream = null; // Store camera stream to stop it after capture
        // Start camera
        function startCamera() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            // Request access to the camera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    cameraStream = stream; // Store the camera stream
                    video.classList.remove('hidden'); // Show video element when the camera starts
                })
                .catch(err => {
                    console.error("Error accessing camera: " + err);
                });
        }
        // Take a picture from the camera feed
        function takePicture() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const imgElement = document.getElementById('captured-image');
            const retryButton = document.getElementById('retryButton');
            const photoInfo = document.getElementById('photo-info');
            const timestampElement = document.getElementById('timestamp');
            const coordinatesElement = document.getElementById('coordinates');
            // Set canvas size to video size
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            // Draw the current frame from the video to the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            // Get the timestamp (date and time)
            const now = new Date();
            const timestamp = now.toLocaleString(); // Format: MM/DD/YYYY, HH:mm:ss
            // Add timestamp and coordinates to the image (bottom left corner)
            const latitude = currentPosition ? currentPosition.coords.latitude : 'N/A';
            const longitude = currentPosition ? currentPosition.coords.longitude : 'N/A';
            context.font = '20px Arial';
            context.fillStyle = 'white';
            context.fillText("Timestamp: " + timestamp, 10, canvas.height - 40); // Date and time
            context.fillText("Location: Lat " + latitude + ", Lon " + longitude, 10, canvas.height - 10); // Coordinates
            // Convert canvas to image and set it in img element
            const imageUrl = canvas.toDataURL('image/png');
            imgElement.src = imageUrl;
            // Show the captured image and info
            imgElement.classList.remove('hidden');
            retryButton.classList.remove('hidden');
            photoInfo.classList.remove('hidden');
            // Set the value of a hidden input field with the Base64 data
            const photoInput = document.createElement('input');
            photoInput.type = 'hidden';
            photoInput.name = 'photo';
            photoInput.value = imageUrl;
            document.querySelector('form').appendChild(photoInput);
            // Sembunyikan tombol "Take Picture" dan tampilkan tombol "SUBMIT"
            document.querySelector('button[onclick="takePicture()"]').style.display = 'none';
            document.querySelector('button[type="submit"]').style.display = 'block';
            // Disable the capture button
            document.querySelector('button[onclick="takePicture()"]').disabled = true;
            // Stop the camera stream and hide video
            video.classList.add('hidden');
            if (cameraStream) {
                let tracks = cameraStream.getTracks();
                tracks.forEach(track => track.stop()); // Stop the camera stream
            }
        }
        // Retry taking picture
        function retryCapture() {
            const imgElement = document.getElementById('captured-image');
            const retryButton = document.getElementById('retryButton');
            const photoInfo = document.getElementById('photo-info');
            const videoElement = document.getElementById('video');
            // Hide the current image and info
            imgElement.classList.add('hidden');
            retryButton.classList.add('hidden');
            photoInfo.classList.add('hidden');
            // Re-enable the capture button
            document.querySelector('button[onclick="takePicture()"]').disabled = false;
            document.querySelector('button[onclick="takePicture()"]').style.display = 'block'; // Show take picture button
            document.querySelector('button[type="submit"]').style.display = 'none'; // Hide submit button
            // Remove the hidden photo input
            const photoInput = document.querySelector('input[name="photo"]');
            if (photoInput) {
                photoInput.remove();
            }
            // Show the video again and restart the camera
            videoElement.classList.remove('hidden');
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    videoElement.srcObject = stream;
                    cameraStream = stream;
                })
                .catch(err => {
                    console.error("Error accessing camera: " + err);
                });
        }
        // Get user's current location and store it
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    currentPosition = position;
                    console.log("Location acquired:", position.coords.latitude, position.coords.longitude);
                },
                (error) => {
                    console.warn("Error getting location:", error.message);
                }
            );
        } else {
            console.warn("Geolocation is not supported by this browser.");
        }
    </script>

@endsection