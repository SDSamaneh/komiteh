@extends('layouts.dashboard.master')


@section('content')
<main>
      <section class="py-4">
            <div class="container">
                  <div class="row g-4">

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif


                        <div class="card border mb-4">
                              <div class="card-header border-bottom p-3">
                                    <h4 class="card-header-title mb-0">پروفایل من</h4>
                              </div>
                              <div class="card-body">
                                    <form method="POST" action="{{ route('profile.update') }}">
                                          <div class="row">
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
                                                <div class="col-md-12 mt-3 mb-3 d-flex justify-content-end gap-3">
                                                      <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                                      <a href="{{route('index')}}" class="btn btn-warning">انصراف</a>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </section>
</main>
@endsection