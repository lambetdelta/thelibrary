@if(session('error'))
    <div class="alert alert-danger mt-1">
        {{ session('error') }}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning mt-1">
        <i class="fas fa-exclamation"></i>{{ session('warning') }}
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger mt-1">
        {{ session('danger') }}
    </div>
@endif
@if (session('message'))
    <div class="alert alert-info mt-1">
            <i class="fas fa-exclamation"></i></i>{{ session('message') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success mt-1">
        <i class="far fa-thumbs-up"></i>{{ session('success') }}
    </div>
@endif
