@extends('components.layouts.main-layout')
@section('title', 'Edit Offence')
@section('content')

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">Edit Offence</h2>

    <form action="{{ route('offence.update', $offence->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="employee_id"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
            <select id="employee_id" name="employee_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
            <option disabled>Select Employee</option>
            @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"
                {{ $offence->employee_id == $employee->id ? 'selected' : '' }}>
                {{ $employee->name }}
            </option>
            @endforeach
            </select>
        </div>
        <div class="mb-5">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Date
            </label>
            <input type="date" id="date" name="date"
                value="{{ old('date', $offence->date) }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
        </div>



        <div class="mb-5">
            <label for="offence_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Offence Category
            </label>
            <select name="offence_category" id="offence_category"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
                <option value="" disabled>Select offence category</option>
                <option value="Light" {{ old('offence_category', $offence->offence_category) == 'Light' ? 'selected' : '' }}>Light</option>
                <option value="Medium" {{ old('offence_category', $offence->offence_category) == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Heavy" {{ old('offence_category', $offence->offence_category) == 'Heavy' ? 'selected' : '' }}>Heavy</option>
            </select>
        </div>


        <div class="mb-6">
            <label for="offence_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Offence Description
            </label>
            <textarea id="offence_description" name="offence_description" rows="3"
                class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Describe the offence...">{{ old('offence_description', $offence->offence_description) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Change Image (optional)
            </label>
            <input type="file" id="image" name="image"
                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-white dark:bg-gray-700 dark:border-gray-600">
            @if ($offence->image)
            <img src="{{ asset('storage/' . $offence->image) }}" alt="Current Image" class="mt-2 w-24 h-auto rounded shadow">
            <input type="hidden" name="existing_image" value="{{ $offence->image }}">
            @endif
        </div>

        <div class="flex justify-between">
            <a href="{{ route('offence.index') }}"
                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Back
            </a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                Update
            </button>
        </div>
    </form>
</div>

@endsection