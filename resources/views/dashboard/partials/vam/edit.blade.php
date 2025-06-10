<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="card-header text-center mb-3 mt-3">
                                    <h1 class="mb-3">ویرایش درخواست وام</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{ route('vam.update', $vam->id) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="row">
                                                @php
                                                $readonly = !(auth()->check() && in_array(auth()->user()->role, ['subscriber', 'author']) && $vam->status === 'No');
                                                @endphp
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">نام و نام خانوادگی</label>
                                                      <input name="name" type="text" class="form-control" value="{{ old('name', $vam->name) }}" {{ $readonly ? 'readonly' : '' }}>
                                                      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">کدملی</label>
                                                      <input name="idCard" type="text" class="form-control" value="{{ old('idCard', $vam->idCard) }}" {{ $readonly ? 'readonly' : '' }}>
                                                      @error('idCard') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">مبلغ درخواستی (تومان)</label>
                                                      <input name="price" type="text" class="form-control" value="{{ old('price', $vam->price) }}" {{ $readonly ? 'readonly' : '' }}>
                                                      @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">دپارتمان</label>
                                                      <select class="form-select" name="departmans_id" aria-label="Default select example">
                                                            <option value="" disabled selected>{{$vam->departmans->name}}</option>

                                                            @foreach($departmans as $departman)
                                                            <option value="{{$departman->id}}" {{ old('departmans_id', $vam->departmans_id) == $departman->id ? 'selected' : '' }}>
                                                                  {{$departman->name}}
                                                            </option>
                                                            @endforeach

                                                      </select>
                                                      @error('departmans_id')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">سرپرست واحد</label>
                                                      <select class="form-select" name="supervisors_id" aria-label="Default select example">
                                                            <option value="" disabled selected>{{$vam->supervisor->name}}</option>

                                                            @foreach($supervisors as $supervisor)
                                                            <option value="{{$supervisor->id}}" {{ old('supervisors_id', $vam->supervisors_id) == $supervisor->id ? 'selected' : '' }}>
                                                                  {{$supervisor->name}}
                                                            </option>
                                                            @endforeach

                                                      </select>
                                                      @error('supervisors_id')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="mb-3">
                                                            <label class="form-label">دلیل درخواست</label>
                                                            <select class="form-select" name="resone" aria-label="Default select example" required>
                                                                  <option value="" disabled {{ old('resone', $vam->resone) ? '' : 'selected' }}>دلیل درخواست وام را انتخاب کنید</option>
                                                                  @foreach(['تحصیل', 'ازدواج', 'جهیزیه', 'درمان', 'تصادف', 'بیمه', 'فوت اقوام', 'سایر'] as $resone)
                                                                  <option value="{{ $resone }}" {{ old('resone', $vam->resone) == $resone ? 'selected' : '' }}>{{ $resone }}</option>
                                                                  @endforeach
                                                            </select>
                                                            @error('resone')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-6">
                                                      <div class="mb-3">
                                                            <label class="form-label">توضیحات</label>
                                                            <textarea class="form-control" name="descriptionUser" rows="3">{{ old('descriptionUser', $vam->descriptionUser) }}</textarea>
                                                            @error('descriptionUser')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                                <div class="col-md-12 mt-5">
                                                      <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="accept" value="Yes" id="accept" checked>
                                                            <label class="form-check-label" for="accept">
                                                                  اینجانب متقاضی استفاده از امکانات رفاهی شرکت متعهد میشوم مطابق آئین نامه کمیته رفاهی و دستور العمل های پیوست آن از این امکانات استفاده نمایم و نسبت به تسویه حساب بدهی خود قبل از ترک کار اقدام نمایم. در صورت تخلف،شرکت و کمیته رفاهی میتواند علیه اینجانب اقدام قانونی نماید.
                                                            </label>
                                                            @error('accept')
                                                            <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                            @enderror
                                                      </div>
                                                </div>
                                          </div>

                                          @if($vam->status === 'No')
                                          <div class="alert alert-warning text-center mt-4">
                                                درخواست هنوز توسط مدیر واحد تأیید نشده است.
                                          </div>
                                          @endif

                                          @if($vam->validationHr === 'No')
                                          <div class="alert alert-warning text-center mt-2">
                                                درخواست هنوز توسط منابع انسانی اعتبارسنجی نشده است.
                                          </div>
                                          @endif

                                          @php
                                          $isHR = auth()->check() && auth()->user()->role === 'humanResources';
                                          @endphp

                                          @if($vam->status === 'Yes' && !empty($vam->validationHr) || $isHR)
                                          <hr />
                                          <div class="text-center mt-4 mb-4">
                                                <h4>فرم اعتبارسنجی منابع انسانی</h4>
                                          </div>
                                          <div class="row">
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label">تاریخ عضویت در صندوق</label>
                                                      <input name="memberDate" type="text" class="form-control"
                                                            value="{{ old('memberDate', $vam->memberDate) }}"
                                                            placeholder="به طور مثال : 1402/02/30"
                                                            {{ $isHR ? '' : 'readonly' }}>
                                                      @error('memberDate')
                                                      <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label">مبلغ سرمایه گذاری در صندوق</label>
                                                      <input name="memberPrice" type="text" class="form-control"
                                                            value="{{ old('memberPrice', $vam->memberPrice) }}"
                                                            {{ $isHR ? '' : 'readonly' }}>
                                                      @error('memberPrice')
                                                      <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label">آخرین حقوق دریافتی</label>
                                                      <input name="lastSalary" type="text" class="form-control"
                                                            value="{{ old('lastSalary', $vam->lastSalary) }}"
                                                            {{ $isHR ? '' : 'readonly' }}>
                                                      @error('lastSalary')
                                                      <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label">میزان بدهی در زمان بهره برداری از امکانات رفاهی</label>
                                                      <input name="debt" type="text" class="form-control"
                                                            value="{{ old('debt', $vam->debt) }}"
                                                            {{ $isHR ? '' : 'readonly' }}>
                                                      @error('debt')
                                                      <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label">تاریخ اعتبار سنجی</label>
                                                      <input name="validationDate" type="text" class="form-control"
                                                            value="{{ old('validationDate', $vam->validationDate) }}"
                                                            placeholder="به طور مثال : 1402/02/30"
                                                            {{ $isHR ? '' : 'readonly' }}>
                                                      @error('validationDate')
                                                      <small class="mt-2 d-inline-block text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                @if($isHR)
                                                <div class="col-md-4 mt-4 d-flex gap-4">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationHr" value="Yes"
                                                                  {{ old('validationHr', $vam->validationHr) == 'Yes' ? 'checked' : '' }}>
                                                            <label class="form-check-label">تأیید</label>
                                                      </div>
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationHr" value="No"
                                                                  {{ old('validationHr', $vam->validationHr) == 'No' ? 'checked' : '' }}>
                                                            <label class="form-check-label">عدم تأیید</label>
                                                      </div>
                                                </div>
                                                @else
                                                <div class="col-md-4 mt-4">
                                                      <label class="form-label">نتیجه اعتبارسنجی منابع انسانی</label>
                                                      <input type="text" class="form-control" value="{{ $vam->validationHr === 'Yes' ? 'تأیید شده' : ($vam->validationHr === 'No' ? 'عدم تأیید' : '---') }}" readonly>
                                                </div>
                                                @endif
                                          </div>
                                          @endif

                                          @php
                                          $isManager1 = auth()->check() && auth()->user()->role === 'manager1';
                                          @endphp

                                          @if($vam->validationHr === 'Yes')
                                          <hr />
                                          <div class="text-center mt-4 mb-4">
                                                <h4>تاییدیه توسط مدیر مالی</h4>
                                          </div>
                                          <div class="row">
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">مبلغ نهایی (تومان)</label>
                                                      <input name="finalPrice" type="text" class="form-control"
                                                            value="{{ old('finalPrice', $vam->finalPrice ?? $vam->price) }}"
                                                            {{ $isManager1 ? '' : 'readonly' }}>
                                                      @error('finalPrice')
                                                      <small class="text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">توضیحات تکمیلی</label>
                                                      <textarea class="form-control" name="description" rows="3" {{ $isManager1 ? '' : 'readonly' }}>{{ old('description', $vam->description) }}</textarea>
                                                      @error('description')
                                                      <small class="text-danger">{{ $message }}</small>
                                                      @enderror
                                                </div>

                                                @if($isManager1)
                                                <div class="col-md-4 mt-4 d-flex gap-4">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationManager1" value="Yes" {{ old('validationManager1', $vam->validationManager1) == 'Yes' ? 'checked' : '' }}>
                                                            <label class="form-check-label">تأیید</label>
                                                      </div>
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationManager1" value="No" {{ old('validationManager1', $vam->validationManager1) == 'No' ? 'checked' : '' }}>
                                                            <label class="form-check-label">عدم تأیید</label>
                                                      </div>
                                                </div>
                                                @else
                                                <div class="col-md-4 mt-4">
                                                      <label class="form-label">نتیجه بررسی مدیر مالی</label>
                                                      <input type="text" class="form-control" value="{{ $vam->validationManager1 === 'Yes' ? 'تأیید شده' : ($vam->validationManager1 === 'No' ? 'عدم تأیید' : '---') }}" readonly>
                                                </div>
                                                @endif
                                          </div>
                                          @endif

                                          @php
                                          $isManager2 = auth()->check() && auth()->user()->role === 'manager2';
                                          @endphp

                                          @if($vam->validationManager1 === 'Yes')
                                          <hr />
                                          <div class="text-center mt-4 mb-4">
                                                <h4>تاییدیه توسط رییس کمیته رفاهی</h4>
                                          </div>
                                          <div class="row">
                                                @if($isManager2)
                                                <div class="col-md-4 mt-4 d-flex gap-4">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationManager2" value="Yes" {{ old('validationManager2', $vam->validationManager2) == 'Yes' ? 'checked' : '' }}>
                                                            <label class="form-check-label">تأیید</label>
                                                      </div>
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="validationManager2" value="No" {{ old('validationManager2', $vam->validationManager2) == 'No' ? 'checked' : '' }}>
                                                            <label class="form-check-label">عدم تأیید</label>
                                                      </div>
                                                </div>
                                                @else
                                                <div class="col-md-4 mt-4">
                                                      <label class="form-label">نتیجه بررسی رییس کمیته رفاهی</label>
                                                      <input type="text" class="form-control" value="{{ $vam->validationManager2 === 'Yes' ? 'تأیید شده' : ($vam->validationManager2 === 'No' ? 'عدم تأیید' : '---') }}" readonly>
                                                </div>
                                                @endif
                                          </div>
                                          @endif

                                          <div class="col-md-12 d-flex gap-2 justify-content-end mt-5">
                                                <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                                                <a class="btn btn-danger" href="{{route('index')}}"> بازگشت</a>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>