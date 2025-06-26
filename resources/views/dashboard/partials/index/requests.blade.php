<div class="col-12">
      <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('vam.create')}}">
                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-success bg-opacity-10 rounded-3 text-success">
                                          <i class="fas fa-wallet"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h3>{{$vamCount}} درخواست</h3>
                                          <h6 class="mb-0">درخواست وام</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('service.create')}}">
                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3 text-primary">
                                          <i class="fas fa-tools"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h3>{{$serviceCount}} درخواست</h3>
                                          <h6 class="mb-0">درخواست تعمیرگاه</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('maadiran.create')}}">

                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-danger bg-opacity-10 rounded-3 text-danger">
                                          <i class="fas fa-store"></i>

                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h3>{{$maadiranCount}}</h3>
                                          <h6 class="mb-0">درخواست خرید از مادیران</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('profile.edit')}}">

                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-success bg-opacity-10 rounded-3 text-success">
                                          <i class="fas fa-user"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h6 class="mb-0">پروفایل کاربر</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <!-- <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('announcement.index')}}">

                              <div class="d-flex align-items-center">
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3 text-primary">
                                          <i class="far fa-newspaper"></i>
                                    </div>
                                    <div class="ms-3">
                                          <h3>{{$announcementCount}}</h3>
                                          <h6 class="mb-0"> اخبار</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div> -->
            @if(auth()->check() && auth()->user()->role==='author')
<<<<<<< HEAD
  <hr />
=======

           
>>>>>>> 286030e7073526349a3fd62993114ae3306ba096
            <div class="text-center mt-4 mb-4">
                  <h4>کارتابل درخواست مدیران</h4>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('supervisor.vam.index')}}">
                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3">
                                          <img src="{{asset('storage/images/request-for-proposal.png')}}" alt="request" style="width: 50px;">
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h6 class="mb-0">درخواست های وام</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('supervisor.service.index')}}">
                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3">
                                          <img src="{{asset('storage/images/request-for-proposal.png')}}" alt="request" style="width: 50px;">
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
<<<<<<< HEAD
                                          <h6 class="mb-0">درخواست های  تعمیرگاه</h6>
=======
>>>>>>> 286030e7073526349a3fd62993114ae3306ba096
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                  <div class="card card-body border p-3">
                        <a href="{{route('supervisor.maadiran.index')}}">
                              <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3">
                                          <img src="{{asset('storage/images/request-for-proposal.png')}}" alt="request" style="width: 50px;">
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3">
                                          <h6 class="mb-0">درخواست خرید از مادیران</h6>
                                    </div>
                              </div>
                        </a>
                  </div>
            </div>
            @endif
      </div>
</div>
