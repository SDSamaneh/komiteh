<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="card-header text-center mb-3 mt-3">
                                    <h1 class="mb-3">ویرایش کاربر</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{ route('users.update',  $user->id) }}" method="post">
                                          <div class="row">
                                                @method('PUT')
                                                @csrf
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label">نام و نام خانوادگی</label>
                                                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                                                      </div>
                                                </div>
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label">شماره همراه</label>
                                                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required>
                                                      </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">کد ملی</label>
                                                      <input type="text" name="idCard" class="form-control" value="{{ old('idCard', $user->idCard) }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label for="email">ایمیل</label>
                                                      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label for="password">رمز عبور جدید (اختیاری)</label>
                                                      <input type="password" name="password" class="form-control" value="" autocomplete="off">
                                                      @error('password')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label for="password_confirmation">تکرار رمز عبور</label>
                                                      <input type="password" name="password_confirmation" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label for="supervisor_id">مدیر واحد</label>
                                                      <select name="supervisor_id" class="form-select">
                                                            <option value="">انتخاب مدیر</option>
                                                            @foreach($supervisors as $sup)
                                                            <option value="{{ $sup->id }}" {{ $user->supervisor_id == $sup->id ? 'selected' : '' }}>
                                                                  {{ $sup->name }}
                                                            </option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                                <div class="col-md-12 d-flex gap-2 justify-content-end mt-5">
                                                      <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                                                      <a class="btn btn-danger" href="{{route('users.index')}}"> بازگشت</a>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>