@if(session()->has('success'))
    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-xl sm:rounded-lg" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif
