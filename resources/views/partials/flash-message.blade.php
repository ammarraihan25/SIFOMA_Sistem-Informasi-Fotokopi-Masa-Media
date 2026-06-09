@if (session('success'))
    <div class="alert alert-success animate-fade-in flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error animate-fade-in flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning animate-fade-in flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ session('warning') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error animate-fade-in">
        <div class="flex items-center gap-2 font-bold mb-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>Terdapat kesalahan pada input Anda:</span>
        </div>
        <ul class="ml-6 list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
