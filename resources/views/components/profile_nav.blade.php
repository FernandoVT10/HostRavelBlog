<aside class="nav flex-column nav-pills bg-white" role="tablist" aria-orientation="vertical">
    <a class="nav-link @yield('edit-profile')" href="{{ route('edit-profile') }}">
        Edit Profile
    </a>
    <a class="nav-link @yield('change-avatar')" href="{{ route('change-avatar') }}">Change Avatar</a>
    <a class="nav-link @yield('change-password')" href="{{ route('change-password') }}">Change Password</a>
</aside>