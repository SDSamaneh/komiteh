<section class="py-4">
      <div class="container">
            <div class="row pb-4 bg-light p-3 mb-4 rounded">
                  <div class="col-12">
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
                                    <h3>افزودن مدیر واحد</h3>
                              </div>

                              <div class="card-body">
                                    <form action="{{route('supervisor.store')}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                                <div class="col-md-4">
                                                      <div class="mb-3">
                                                            <label class="form-label">نام و نام خانوادگی</label>
                                                            <input name="name" type="text" class="form-control" value="">
                                                            @error('name')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-4">
                                                      <div class="mb-3">
                                                            <label class="form-label">کدملی</label>
                                                            <input name="idCard" type="text" class="form-control" value="">
                                                            @error('idCard')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-4">
                                                      <div class="mb-3">
                                                            <label class="form-label">دپارتمان</label>
                                                            <select class="form-select" name="departmans_id" aria-label="Default select example">
                                                                  @forelse($departmans as $departman)
                                                                  <option value="{{$departman->id}}">{{$departman->name}}</option>
                                                                  @empty
                                                                  <option>دسته بندی پیدا نشد</option>

                                                                  @endforelse
                                                            </select>
                                                            @error('departmans_id')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>

                                                <div class="col-sm-12 text-end">
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
                                <div class="card-header d-flex justify-content-between border-bottom p-3">
                                    <div class="d-flex">
                                          <h1 class="mb-2 mb-sm-0 h3">لیست مدیران واحد
                                                <span class="badge bg-primary bg-opacity-10 text-primary">{{$supervisorCount}}</span>
                                          </h1>
                                    </div>
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                          <form action="{{ route('supervisor.index') }}" method="GET" class="mb-3">
                                                <div class="input-group">
                                                      <input type="text" name="search" value="{{ request('search') }}" class="form-control">
                                                      <button type="submit" class="btn btn-danger">جستجو</button>
                                                </div>
                                          </form>
                                    </div>
                              </div>
                              <div class="card-body p-3">
                                    <!-- Post list table START -->
                                    <div class="table-responsive border-0">
                                          <table class="table align-middle p-1 mb-0 table-hover table-shrink">
                                                <!-- Table head -->
                                                <thead class="table-dark">
                                                      <tr>
                                                            <th scope="col" class="border-0 rounded-start">نام و نام خانوادگی</th>
                                                            <th scope="col" class="border-0">کدملی</th>
                                                            <th scope="col" class="border-0">دپارتمان</th>
                                                            <th scope="col" class="border-0">جزئیات</th>


                                                      </tr>
                                                </thead>
                                                <tbody class="border-top-0">

                                                      @if($supervisors)

                                                      @foreach($supervisors as $supervisor)
                                                      <tr>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$supervisor->name}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$supervisor->idCard}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$supervisor->departmans->name}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <div class="d-flex">
                                                                        <h6><a href="{{route('supervisor.edit',$supervisor->id)}}" class="text-success mb-0 me-2"><i class="fas fa-edit"></i></a></h6>
                                                                        <form action="{{route('supervisor.destroy',$supervisor->id)}}" method="post">
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
					 <div class="d-flex justify-content-center mt-4">
                                          {{ $supervisors->appends(request()->query())->links() }}
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
