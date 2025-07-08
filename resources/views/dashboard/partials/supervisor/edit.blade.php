<section class="py-4">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="card border">
                              <div class="card-header text-center mb-3 mt-3">

                                    <h1 class="mb-3">ویرایش مدیر واحد</h1>
                              </div>
                              <div class="card-body">
                                    <form action="{{ route('supervisor.update', $supervisor->id) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="row">
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">نام و نام خانوادگی</label>
                                                      <input name="name" type="text" class="form-control" value="{{ old('name', $supervisor->name) }}">
                                                      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">کدملی</label>
                                                      <input name="idCard" type="text" class="form-control" value="{{ old('idCard', $supervisor->idCard) }}">
                                                      @error('idCard') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label">دپارتمان</label>
                                                      <select class="form-select" name="departmans_id" aria-label="Default select example">
                                                            <option value="" selected>{{$supervisor->departmans->name}}</option>

                                                            @foreach($departmans as $departman)
                                                            <option value="{{$departman->id}}" {{ old('departmans_id', $supervisor->departmans_id) == $departman->id ? 'selected' : '' }}>
                                                                  {{$departman->name}}
                                                            </option>
                                                            @endforeach

                                                      </select>
                                                      @error('departmans_id')
                                                      <small class="mt-2 d-inline-block text-danger">{{$message}}</small>
                                                      @enderror
                                                </div>
                                          </div>
                                          <div class="col-md-12 d-flex gap-2 justify-content-end mt-5">
                                                <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                                                <a class="btn btn-danger" href="{{route('index')}}"> بازگشت</a>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
                  <div class="row">

                  </div>
            </div>
</section>