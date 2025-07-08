<section class="py-4">
      <div class="container">
            <h1>ویرایش درخواست تعمیرگاه</h1>
            <form action="{{ route('supervisor.service.update', $service->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row">
                        <div class="col-md-3 mb-3">
                              <label class="form-label">نام کاربر</label>
                              <input class="form-control" type="text" value="{{ $service->user->name }}" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                              <label class="form-label">کد ملی</label>
                              <input class="form-control" type="text" value="{{ $service->user->idCard }}" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                              <label>مبلغ وام ( تومان )</label>
                              <input class="form-control" type="text" name="price" value="{{ old('price', $service->price) }}" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                              <label class="form-label">دپارتمان</label>
                              <select class="form-select" disabled>
                                    <option selected>{{$service->departmans->name}}</option>
                              </select>
                              <input type="hidden" name="departmans_id" value="{{ $service->departmans_id }}">
                        </div>

                        <div class="col-md-3 mb-3">
                              <label class="form-label">سرپرست واحد</label>
                              <select class="form-select" disabled>
                                    <option selected>{{$service->supervisors->name}}</option>
                              </select>
                              <input type="hidden" name="supervisors_id" value="{{ $service->supervisors_id }}">
                        </div>

                        <div class="col-md-9 mb-3">
                              <label class="form-label">توضیحات</label>
                              <textarea class="form-control" name="descriptionUser" rows="3" disabled>{{ old('descriptionUser', $service->descriptionUser) }}</textarea>
                        </div>

                        <div class="col-md-4 mt-4 d-flex gap-4">
                              <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Yes"
                                          {{ old('status', $service->status) == 'Yes' ? 'checked' : '' }}>
                                    <label class="form-check-label">تأیید</label>
                              </div>
                              <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="No"
                                          {{ old('status', $service->status) == 'No' ? 'checked' : '' }}>
                                    <label class="form-check-label">عدم تأیید</label>
                              </div>
                        </div>

                        <div class="col-md-12 mt-5">
                              <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                              <a href="{{ route('supervisor.service.index') }}" class="btn btn-secondary">بازگشت</a>
                        </div>
                  </div>
            </form>
      </div>
</section>