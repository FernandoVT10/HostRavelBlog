@if ($user -> hasRole("SuperAdmin"))
    <span class="badge badge-pill badge-danger px-3 py-2 text-uppercase">SuperAdmin</span>
@else
    @if ($user -> hasRole("writer"))
        <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase">Writer</span>
    @else
        <span class="badge badge-pill badge-secondary px-3 py-2 text-uppercase">None</span>
    @endif
@endif