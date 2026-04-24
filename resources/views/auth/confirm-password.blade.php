<x-guest-layout>
    <h5 class="mb-3">Confirm password</h5>

    <p class="text-muted">
        This is a secure area of the application. Please confirm your password before continuing.
    </p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                required
                autocomplete="current-password"
            />
        </div>

        <div class="d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>
</x-guest-layout>
