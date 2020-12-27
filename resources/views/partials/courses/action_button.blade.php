<div class="col-2">
    @auth
        @can('optForCourse', $course)
            @can('subscribe', \App\Course::class)
                <a href="#" class="btn btn-subscribe btn-bottom btn-block">
                    <i class="fa fa-bolt"> {{ __('Suscribirme') }}</i>
                </a>
            @else
                @can('inscribe', $course)
                    <a href="#" class="btn btn-subscribe btn-bottom btn-block">
                        <i class="fa fa-bolt"> {{ __('Inscribirme') }}</i>
                    </a>
                @else
                    <a href="#" class="btn btn-subscribe btn-bottom btn-block">
                        <i class="fa fa-bolt"> {{ __('Inscrito') }}</i>
                    </a>
                @endcan
            @endcan
        @else
            <a href="#" class="btn btn-subscribe btn-bottom btn-block">
                <i class="fa fa-user">{{ __('Autor') }}</i>
            </a>
        @endcan
    @else
        <a href="{{ route('login') }}" class="btn btn-subscribe btn-bottom btn-block">
            <i class="fa fa-user"> {{ __('Login') }}</i>
        </a>
    @endauth
</div>
