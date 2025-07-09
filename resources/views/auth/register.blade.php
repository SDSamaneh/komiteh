@extends('layouts.dashboard.master')
@section('content')

<!-- **************** MAIN CONTENT START **************** -->
<main>
      <section>
            <div class="container">
                 <div class="row bg-form">
                        <div class="custom-box-shadow py-5">
                              <div class="col-md-12 col-lg-8 col-xl-8 mx-auto pt-5">
                                    <h2 class="text-center font-bold">ثبت نام</h2>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                          <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                          </ul>
                                    </div>
                                    @endif

                                    <form class="mt-4 pt-5" method="post" action="{{route('register')}}">
                                          @csrf
                                          <div class="row">
                                                <!-- Name -->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputName">نام و نام خانوادگی</label>
                                                            <input type="text" name="name" class="form-control @error('name') border-danger @enderror" id="exampleInputName" value="{{old('name')}}">
                                                            @error('name')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">ایمیل</label>
                                                            <input type="email" name="email" class="form-control @error('email') border-danger @enderror" id="exampleInputEmail1" value="{{old('email')}}">
                                                            @error('email')
                                                            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <!-- idCard -->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputId">کدملی</label>
                                                            <input type="text" name="idCard" class="form-control @error('idCard') border-danger @enderror" id="exampleInputId" value="{{old('idCard')}}">
                                                            @error('idCard')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <!-- Number -->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputMobail">شماره همراه</label>
                                                            <input type="text" name="phone_number" class="form-control @error('phone_number') border-danger @enderror" id="exampleInputMobail" value="{{old('phone_number')}}">
                                                            @error('phone_number')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <!-- Password -->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputPassword1">رمز عبور</label>
                                                            <input type="password" name="password" class="form-control @error('password') border-danger @enderror" id="exampleInputPassword1">
                                                            @error('password')
                                                            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <!-- Password Confirmation-->
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label" for="exampleInputPassword2">تایید رمز عبور</label>
                                                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
                                                      </div>
                                                </div>
                                                <div class="col-md-12 text-end mt-3 mb-3">
                                                      <button type="submit" class="btn btn-success">ثبت نام</button>
                                                </div>
                                                <hr>
                                                <!-- Button -->
                                                <div class="col-sm-8 text-sm-end mb-3">
                                                      <span>آیا قبلا ثبت نام کرده اید؟ <a href="{{route('login')}}"><u>ورود</u></a></span>
                                                </div>
                                          </div>
                                    </form>
                                    <!-- Form END -->
                              </div>
                        </div>
                  </div>
            </div>
      </section>
      <!-- Inner intro END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
@endsection
