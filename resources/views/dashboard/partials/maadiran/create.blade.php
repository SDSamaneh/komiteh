<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="col-12 text-center mb-3 mt-3">
                                    <h1 class="mb-0 h3">درخواست خرید از مادیران</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{route('maadiran.store')}}" method="post">
                                          @csrf
                                          <div class="row">
                                                <div class="col-md-6">
                                                      @if (session('success'))
                                                      <div class="alert alert-success">
                                                            {{ session('success') }}
                                                      </div>
                                                      @endif

                                                      @if (session('error'))
                                                      <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                      </div>
                                                      @endif
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">نام و نام خانوادگی</label>
                                                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                                            @error('name')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">کدملی</label>
                                                            <input name="idCard" type="text" class="form-control" value="">
                                                            @error('idCard')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class=" form-label">دپارتمان</label>
                                                      <select class="form-select" name="departmans_id" aria-label="Default select example">
                                                            <option value="" disabled selected>لطفاً انتخاب کنید</option>
                                                            @forelse($departmans as $departman)
                                                            <option value="{{$departman->id}}">{{$departman->name}}</option>
                                                            @empty
                                                            <option>دپارتمان یافت نشد</option>
                                                            @endforelse
                                                      </select>
                                                      @error('departmans_id')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">سرپرست واحد</label>
                                                            <select class="form-select" name="supervisors_id" aria-label="Default select example">
                                                                  <option value="" disabled selected>لطفاً انتخاب کنید</option>
                                                                  @forelse($supervisors as $supervisor)
                                                                  <option value="{{$supervisor->id}}">{{$supervisor->name}}</option>
                                                                  @empty
                                                                  <option>سرپرست یافت نشد</option>

                                                                  @endforelse
                                                            </select>
                                                            @error('supervisors_id')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">مبلغ درخواستی (تومان)</label>
                                                            <input name="price" type="text" class="form-control" value="">
                                                            @error('price')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">دسته بندی</label>
                                                            <select name="category" class="form-select">
                                                                  <option value="تلویزیون">تلویزیون</option>
                                                                  <option value="لوازم خانگی">لوازم خانگی</option>
                                                                  <option value="موبایل">موبایل</option>
                                                                  <option value="لپتاپ">لپتاپ</option>
                                                                  <option value="سایر">سایر</option>
                                                            </select>
                                                            @error('category')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label">توضیحات</label>
                                                            <textarea class="form-control" name="descriptionUser" rows="3"></textarea>
                                                            @error('descriptionUser')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-612 mt-5">
                                                      <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="accept" value="Yes" id="accept">
                                                            <label class="form-check-label" for="accept">
                                                                  اینجانب متقاضی استفاده از امکانات رفاهی شرکت متعهد میشوم مطابق آئین نامه کمیته رفاهی و دستور العمل های پیوست آن از این امکانات استفاده نمایم و نسبت به تسویه حساب بدهی خود قبل از ترک کار اقدام نمایم. در صورت تخلف،شرکت و کمیته رفاهی میتواند علیه اینجانب اقدام قانونی نماید.
                                                            </label>
                                                            @error('accept')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-12 mt-3 text-end">
                                                      <button class="btn btn-primary" type="submit">ثبت درخواست</button>
                                                      <a href="{{route('index')}}" class="btn btn-warning">انصراف</a>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>