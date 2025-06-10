<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="col-12 text-center mb-3 mt-3">
                                    <h1 class="mb-0 h3">افزودن اطلاعیه</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{route('announcement.store')}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                          <div class="row">
                                                <div class="col-md-12">
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
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">عنوان اطلاعیه</label>
                                                      <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                                                      @error('title')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">توضیحات تکمیلی</label>
                                                      <textarea class="form-control" name="description" rows="3"></textarea>
                                                      @error('description')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <div class="position-relative">
                                                            <h6 class="my-2">آپلود مستندات</h6>
                                                            <label class="w-100" style="cursor:pointer;">
                                                                  <div class="input-group">
                                                                        <span class="btn btn-custom cursor-pointer upload-button">آپلود فایل</span>
                                                                        <input class="form-control stretched-link hidden-upload" type="file" name="files[]" multiple />

                                                                  </div>
                                                            </label>
                                                      </div>
                                                      @error('file')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                                <div class="col-md-12 mt-3 text-end">
                                                      <button class="btn btn-primary" type="submit">ثبت</button>
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