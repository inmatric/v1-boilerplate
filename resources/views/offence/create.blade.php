@extends('components.layouts.main-layout')
@section('title', 'Employee')
@section('content')

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">Add Offence</h2>

    <form action="{{ route('offence.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Employee
            </label>
            <select id="employee_id" name="employee_id"
                class="bg-gray-50 border {{ $errors->has('employee_id') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option selected disabled>Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Date
            </label>
            <input type="date" name="date" id="date"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
        </div>

        <div class="mb-5">
            <label for="offence_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Offence Category
            </label>
            <select name="offence_category" id="offence_category"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
                <option value="" disabled selected>Select offence category</option>
                <option value="Light">Light</option>
                <option value="Medium">Medium</option>
                <option value="Heavy">Heavy</option>
            </select>
        </div>


        <div class="mb-6">
            <label for="offence_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Offence Description
            </label>
            <textarea name="offence_description" id="offence_description" rows="3"
                class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Describe the offence..." required></textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Upload Image (optional)
            </label>
            <input type="file" name="image" id="image"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-white dark:bg-gray-700 dark:border-gray-600">
        </div>

        <div class="flex justify-between">
            <a href="{{ url('/offence') }}">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Back
                </button>
            </a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                Submit
            </button>
        </div>
    </form>
</div>

@endsection