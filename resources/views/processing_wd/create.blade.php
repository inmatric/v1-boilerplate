@extends('components.layouts.main-layout')
@section('title', 'Add New Task')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Task</h1>

        <form action="{{ route('processing_wd.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Employee -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
                    <select id="employee_id" name="employee_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Task Name -->
                <div>
                    <label for="work_id" class="block text-sm font-medium text-gray-700">Task</label>
                    <select id="work_id" name="work_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select task</option>
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}">{{ $work->task }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Timer and Camera Section -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <!-- Timer Display -->
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold" id="timer">00:00:00</h2>
                    <p class="text-gray-600">Durasi Pengerjaan</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <button type="button" id="startTaskBtn" class="bg-green-500 text-white px-6 py-2 rounded-lg">
                        Mulai Pekerjaan
                    </button>
                    <button type="button" id="completeTaskBtn" class="bg-blue-500 text-white px-6 py-2 rounded-lg"
                        style="display: none">
                        Selesaikan Pekerjaan
                    </button>
                </div>
            </div>

            <!-- Hidden Time Fields -->
            <input type="hidden" name="start_time" id="startTimeField">
            <input type="hidden" name="end_time" id="endTimeField">
            <input type="hidden" name="duration_sec" id="durationField">
            <input type="hidden" name="status" id="statusField" value="pending">

            <!-- Photo Before Section -->
            <div class="border p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Before Photo</label>

                <!-- Camera Container -->
                <div class="mb-4">
                    <video id="beforeCameraView" autoplay playsinline class="w-full rounded-lg border"
                        style="display: none;"></video>
                    <canvas id="beforePhotoCanvas" class="hidden"></canvas>

                    <!-- Camera Controls -->
                    <div class="flex space-x-2 mt-2">
                        <button type="button" id="startBeforeCameraBtn"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">
                            Open Camera
                        </button>
                        <button type="button" id="captureBeforeBtn"
                            class="bg-blue-200 hover:bg-blue-300 text-blue-800 px-4 py-2 rounded text-sm"
                            style="display: none">
                            Capture Before Photo
                        </button>
                    </div>
                </div>

                <!-- Photo Preview -->
                <div id="beforePhotoContainer" class="mt-2">
                    <div id="beforePhotoPlaceholder"
                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <p class="text-gray-500">No before photo captured yet</p>
                    </div>
                    <img id="beforePhotoPreview" src="" alt="Before photo preview"
                        class="hidden w-full h-48 object-cover rounded-lg mt-2">
                </div>
                <input type="hidden" name="photo_before_data" id="photoBeforeData">
            </div>

            <!-- Photo After Section -->
            <div class="border p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">After Photo</label>

                <!-- Camera Container -->
                <div class="mb-4">
                    <video id="afterCameraView" autoplay playsinline class="w-full rounded-lg border"
                        style="display: none;"></video>
                    <canvas id="afterPhotoCanvas" class="hidden"></canvas>

                    <!-- Camera Controls -->
                    <div class="flex space-x-2 mt-2">
                        <button type="button" id="startAfterCameraBtn"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm"
                            style="display: none">
                            Open Camera
                        </button>
                        <button type="button" id="captureAfterBtn"
                            class="bg-blue-200 hover:bg-blue-300 text-blue-800 px-4 py-2 rounded text-sm"
                            style="display: none">
                            Capture After Photo
                        </button>
                    </div>
                </div>

                <!-- Photo Preview -->
                <div id="afterPhotoContainer" class="mt-2">
                    <div id="afterPhotoPlaceholder"
                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <p class="text-gray-500">No after photo captured yet</p>
                    </div>
                    <img id="afterPhotoPreview" src="" alt="After photo preview"
                        class="hidden w-full h-48 object-cover rounded-lg mt-2">
                </div>
                <input type="hidden" name="photo_after_data" id="photoAfterData">
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex items-center space-x-3">
                <a href="{{ url('/processing_wd') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-md transition-colors">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition-colors">
                    Save Task
                </button>
            </div>
        </form>
    </div>

    <script>
        let timerInterval;
        let beforeStream;
        let afterStream;
        let startTime;
        let isTaskStarted = false;

        // Before Photo Elements
        const beforeCameraView = document.getElementById('beforeCameraView');
        const beforePhotoCanvas = document.getElementById('beforePhotoCanvas');
        const startBeforeCameraBtn = document.getElementById('startBeforeCameraBtn');
        const captureBeforeBtn = document.getElementById('captureBeforeBtn');

        // After Photo Elements
        const afterCameraView = document.getElementById('afterCameraView');
        const afterPhotoCanvas = document.getElementById('afterPhotoCanvas');
        const startAfterCameraBtn = document.getElementById('startAfterCameraBtn');
        const captureAfterBtn = document.getElementById('captureAfterBtn');

        // Task Control Elements
        const startTaskBtn = document.getElementById('startTaskBtn');
        const completeTaskBtn = document.getElementById('completeTaskBtn');
        const statusField = document.getElementById('statusField');

        // Photo Preview Elements
        const beforePhotoPreview = document.getElementById('beforePhotoPreview');
        const beforePhotoPlaceholder = document.getElementById('beforePhotoPlaceholder');
        const afterPhotoPreview = document.getElementById('afterPhotoPreview');
        const afterPhotoPlaceholder = document.getElementById('afterPhotoPlaceholder');

        // Initialize Before Camera
        async function initBeforeCamera() {
            try {
                beforeStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                });
                beforeCameraView.srcObject = beforeStream;
                beforeCameraView.style.display = 'block';
                captureBeforeBtn.style.display = 'inline-block';
                startBeforeCameraBtn.style.display = 'none';
            } catch (err) {
                console.error("Camera error:", err);
                alert("Failed to access camera for before photo. Please try again.");
            }
        }

        // Initialize After Camera
        async function initAfterCamera() {
            try {
                afterStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                });
                afterCameraView.srcObject = afterStream;
                afterCameraView.style.display = 'block';
                captureAfterBtn.style.display = 'inline-block';
                startAfterCameraBtn.style.display = 'none';
            } catch (err) {
                console.error("Camera error:", err);
                alert("Failed to access camera for after photo. Please try again.");
            }
        }

        // Capture Before Photo
        function captureBeforePhoto() {
            const canvas = beforePhotoCanvas;
            const video = beforeCameraView;
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            const photoData = canvas.toDataURL('image/jpeg', 0.8);
            document.getElementById('photoBeforeData').value = photoData;
            beforePhotoPreview.src = photoData;
            beforePhotoPreview.classList.remove('hidden');
            beforePhotoPlaceholder.classList.add('hidden');

            stopBeforeCamera();
            alert("Before photo captured successfully!");
        }

        // Capture After Photo
        function captureAfterPhoto() {
            const canvas = afterPhotoCanvas;
            const video = afterCameraView;
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            const photoData = canvas.toDataURL('image/jpeg', 0.8);
            document.getElementById('photoAfterData').value = photoData;
            afterPhotoPreview.src = photoData;
            afterPhotoPreview.classList.remove('hidden');
            afterPhotoPlaceholder.classList.add('hidden');

            stopAfterCamera();
            alert("After photo captured successfully!");
        }

        // Stop Before Camera
        function stopBeforeCamera() {
            if (beforeStream) {
                beforeStream.getTracks().forEach(track => track.stop());
                beforeCameraView.style.display = 'none';
                captureBeforeBtn.style.display = 'none';
                startBeforeCameraBtn.style.display = 'inline-block';
            }
        }

        // Stop After Camera
        function stopAfterCamera() {
            if (afterStream) {
                afterStream.getTracks().forEach(track => track.stop());
                afterCameraView.style.display = 'none';
                captureAfterBtn.style.display = 'none';
                startAfterCameraBtn.style.display = 'inline-block';
            }
        }

        // Start Task
        function startTask() {
            // Validate before photo is captured
            if (!document.getElementById('photoBeforeData').value) {
                alert("Please capture a before photo first!");
                return;
            }

            startTime = new Date();
            document.getElementById('startTimeField').value = startTime.toISOString();
            statusField.value = 'inprogress';

            timerInterval = setInterval(updateTimer, 1000);
            isTaskStarted = true;

            // Update UI
            startTaskBtn.style.display = 'none';
            completeTaskBtn.style.display = 'inline-block';
            startAfterCameraBtn.style.display = 'inline-block';
        }

        // Complete Task
        function completeTask() {
            // Validate after photo is captured
            if (!document.getElementById('photoAfterData').value) {
                alert("Please capture an after photo first!");
                return;
            }

            const endTime = new Date();
            document.getElementById('endTimeField').value = endTime.toISOString();
            document.getElementById('durationField').value = Math.floor((endTime - startTime) / 1000);
            statusField.value = 'completed';

            clearInterval(timerInterval);
            isTaskStarted = false;

            // Update UI
            completeTaskBtn.style.display = 'none';
        }

        // Timer Function
        function updateTimer() {
            const now = new Date().getTime();
            const elapsed = new Date(now - startTime);
            document.getElementById('timer').textContent =
                elapsed.toISOString().substr(11, 8); // Format HH:MM:SS
        }

        // Event Listeners
        startBeforeCameraBtn.addEventListener('click', initBeforeCamera);
        captureBeforeBtn.addEventListener('click', captureBeforePhoto);

        startAfterCameraBtn.addEventListener('click', initAfterCamera);
        captureAfterBtn.addEventListener('click', captureAfterPhoto);

        startTaskBtn.addEventListener('click', startTask);
        completeTaskBtn.addEventListener('click', completeTask);
    </script>
@endsection
