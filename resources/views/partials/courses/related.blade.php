<div class="col-12 pt-0 mt-4">
    <h2 class="text-muted">
        {{ __('Cursos similares') }}
        <hr>
    </h2>
</div>

<div class="container-fluid">
    <div class="row">
        @forelse ($related as $relatedCourse)
            <div class="col-md-6 linting-block">
                <div class="media">
                    <div class="fav-box">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>

                    <a href="{{ route('courses.detail', [$relatedCourse->slug]) }}">
                        <img class="d-flex align-self-start" src="/images/courses/{{ $relatedCourse->picture }}" alt="{{ $relatedCourse->name }}">
                    </a>

                    <div class="media-body pl-3">
                        <div class="price">
                            <small>{{ $relatedCourse->name }}</small>
                        </div>

                        <div class="stats">
                            @include('partials.courses.rating', ['course' => $relatedCourse])
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-dark">
                {{ __('No existen cursos relacionados') }}
            </div>
        @endforelse
    </div>
</div>
