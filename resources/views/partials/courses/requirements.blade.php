<div class="col-12 pt-0 mt-0">
    <h2 class="text-muted">{{ __('Requisitos para tomar el curso') }}</h2>
    <hr>
</div>

@forelse ($requirements as $requirement)
    <div class="col-6">
        <div class="card bg-light p-3">
            <div class="mb-0">
                {{ $requirement->requirement }}
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-dark">
        <i class="fa fa-info-cirle"></i>
        {{ __('No se han escrito requisitos para este curso') }}
    </div>
@endforelse
