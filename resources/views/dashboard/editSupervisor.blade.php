@extends('layouts.dashboard.master')
@section('content')
<main>
      <!-- Main contain START -->
      <section class="py-4">
            <div class="container">
                  <div class="row g-4">
                        @include('dashboard.partials.supervisor.edit')

                  </div>
            </div>
      </section>
      <!--Main contain END -->
</main>
@endsection