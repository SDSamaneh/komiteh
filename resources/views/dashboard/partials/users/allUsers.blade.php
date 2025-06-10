<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-md-6 col-xl-12">
                        <div class="card border bg-transparent rounded-3">
                              <div class="card-header">
                                    <div class="d-sm-flex justify-countent-sm-between align-items-center">
                                          <h1 class="mb-2 mb-sm-0 h3">لیست پرسنل
                                                <span class="badge bg-primary bg-opacity-10 text-primary">{{$userCount}}</span>
                                          </h1>
                                    </div>
                              </div>
                              <div class="card-body p-3">
                                    <div class="table-responsive border-0">
                                          <table class="table align-middle p-1 mb-0 table-hover table-shrink">
                                                <thead class="table-dark">
                                                      <tr>
                                                            <th scope="col" class="border-0 rounded-start">نام و نام خانوادگی</th>
                                                            <th scope="col" class="border-0">کدملی</th>
                                                            <th scope="col" class="border-0">شماره همراه</th>
                                                            <th scope="col" class="border-0">عملیات</th>
                                                      </tr>
                                                </thead>
                                                <tbody class="border-top-0">
                                                      @if($users)
                                                      @foreach($users as $user)
                                                      <tr>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$user->name}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$user->idCard}}</a></h6>
                                                            </td>
                                                            <td>
                                                                  <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">{{$user->phone_number}}</a></h6>
                                                            </td>
                                                            <td>

                                                                  <div class="d-flex gap-2">
                                                                        <a href="#" class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف"><i class="bi bi-trash"></i></a>
                                                                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش"><i class="bi bi-pencil-square"></i></a>
                                                                  </div>
                                                            </td>
                                                      </tr>
                                                      @endforeach
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