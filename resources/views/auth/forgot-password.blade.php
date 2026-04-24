<x-guest-layout>
    <h5 class="mb-3">Forgot password</h5>

    <p class="text-muted">
        Forgot your password? Enter your email and we’ll send you a reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                required
                autofocus
            />
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('login') }}">Back to login</a>
            <button type="submit" class="btn btn-primary">Send reset link</button>
        </div>
    </form>
</x-guest-layout>
