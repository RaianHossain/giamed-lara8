<x-guest-layout>
    <h5 class="mb-3">Reset password</h5>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                class="form-control"
                required
                autofocus
                autocomplete="username"
            />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                required
                autocomplete="new-password"
            />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm new password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-control"
                required
                autocomplete="new-password"
            />
        </div>

        <div class="d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">Reset password</button>
        </div>
    </form>
</x-guest-layout>
