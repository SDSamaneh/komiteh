<!-- Footer START -->
<footer class="mb-3">
      <div class="container">

      </div>
</footer>
<!-- Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

@error('success')
@include('notifications.successMessage')
@enderror()

@if(session()->has('error'))
@include('notifications.errorMessage')
@endif

<!-- Vendors -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.3/apexcharts.min.js"></script>
<script src="assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.js"></script>
</body>

</html>