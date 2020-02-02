@extends('templates.default')

@section('content')
    <section class="hero">

        <div class="hero__header">
            <h3>Welcome to Socialize</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam beatae, doloribus excepturi labore minima minus pariatur qui quo! Aliquam aspernatur autem dolorem fugiat, impedit incidunt ratione voluptatem. Distinctio, dolor, est.
            </p>
        </div>

        <div class="hero__image">
            <img src="{{URL::asset('/css/images/hero.jpg')}}" alt="Socialize">
        </div>

    </section>

    @include('templates.partials.footer')

@stop


