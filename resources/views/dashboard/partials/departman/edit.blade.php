<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="card-header text-center mb-3 mt-3">

                                    <h1 class="mb-3">ویرایش دپارتمان</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{ route('departman.update', $departman->id) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="row">
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">عنوان</label>
                                                      <input name="name" type="text" class="form-control" value="{{ old('name', $departman->name) }}">
                                                      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                          </div>
                                          <div class="col-md-12 d-flex gap-2 justify-content-end mt-5">
                                                <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                                                <a class="btn btn-danger" href="{{route('departman.index')}}"> بازگشت</a>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>