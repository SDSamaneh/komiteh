@extends('layouts.dashboard.master')
@section('content')
<main>
      <!-- Main contain START -->
      <section class="py-4">
            <div class="container">
                  <div class="row g-4">
                        @if(auth()->check() && !in_array(auth()->user()->role, ['subscriber', 'author']))

                        @include('dashboard.partials.vam.all')
                        @endif
                  </div>
            </div>
      </section>
      <!--Main contain END -->
</main>
@endsection