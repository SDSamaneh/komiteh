<section class="py-4">
      <div class="container">
            <div class="row pb-4 bg-light p-3 mb-4 rounded">
                  <div class="col-md-12">
                        <div class="toast-container position-fixed top-3 end-0 p-3">
                              @if (session('success'))
                              <div class="toast align-items-center text-bg-success border-0 show" role="alert">
                                    <div class="d-flex">
                                          <div class="toast-body">
                                                {{ session('success') }}
                                          </div>
                                          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
                                    </div>
                              </div>
                              @endif

                              @if (session('error'))
                              <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
                                    <div class="d-flex">
                                          <div class="toast-body">
                                                {{ session('error') }}
                                          </div>
                                          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
                                    </div>
                              </div>
                              @endif
                        </div>
                        <div class="card border">
                              <div class="card-header">
                                    <h3 class="mb-2 mb-sm-0">افزودن دپارتمان</h3>

                              </div>
                              <div class="card-body">
                                    <form action="{{route('departman.store')}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label">عنوان</label>
                                                            <input name="name" type="text" class="form-control" value="">
                                                            @error('name')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>

                                                <div class="col-md-6 mt-4 text-end">
                                                      <button class="btn btn-success" type="submit">ثبت درخواست</button>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="row g-4">
                  <div class="col-md-6 col-xl-12">
                        <div class="card border bg-transparent rounded-3">
                              <div class="card-header">
                                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                                          <h1 class="mb-2 mb-sm-0 h3">دپارتمان ها
                                                <span class="badge bg-primary bg-opacity-10 text-primary">{{$departmanCount}}</span>
                                          </h1>

                                    </div>
                              </div>
                              <!-- Card body START -->
                              <div class="card-body p-3">
                                    <!-- Post list table START -->
                                    <div class="table-responsive border-0">
                                          <table class="table align-middle p-1 mb-0 table-hover table-shrink">
                                                <!-- Table head -->
                                                <thead class="table-dark">
                                                      <tr>
                                                            <th scope="col" class="border-0 rounded-start">عنوان</th>
                                                            <th scope="col" class="border-0">عملیات</th>
                                                      </tr>
                                                </thead>
                                                <tbody class="border-top-0">
                                                      @if($departmans)
                                                      @foreach($departmans as $departman)
                                                      <tr>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$departman->name}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <div class="d-flex">
                                                                        <h6><a href="{{route('departman.edit',$departman->id)}}" class="text-success mb-0 me-2"><i class="fas fa-edit"></i></a></h6>
                                                                        <form action="{{route('departman.destroy',$departman->id)}}" method="post">
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit" class="border-0 bg-transparent"><i class="fas fa-trash text-danger"></i></button>
                                                                        </form>
                                                                  </div>
                                                            </td>
                                                      </tr>
                                                      @endforeach
                                                      @else
                                                      <div class="alert alert-info">
                                                            تا این لحظه دسته بندی ثبت نشده است !
                                                      </div>
                                                      @endif
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>

      </div>
</section>