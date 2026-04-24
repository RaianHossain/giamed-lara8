<x-guest-layout>
    <h5 class="mb-3">Verify your email</h5>

    <p class="text-muted">
        Thanks for signing up! Check your inbox for a verification link.
        If you didn’t receive the email, you can request another one.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Resend verification email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">Log out</button>
        </form>
    </div>
</x-guest-layout>
