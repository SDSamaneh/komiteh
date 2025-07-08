<section class="py-4">
      <div class="container">
            <div class="row pb-4">
                  <div class="col-12">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                              <h1 class="mb-2 mb-sm-0 h3">درخواست برای مادیران</h1>
                              <a href="{{route('index')}}" class="btn btn-sm btn-danger mb-0">
                                    بازگشت
                                    <i class="fas fa-angle-left"></i>
                              </a>
                        </div>
                  </div>
            </div>
            <div class="table-responsive border-0">

                  <table class="table align-middle p-1 mb-0 table-hover table-shrink">

                        <thead class="table-dark">
                              <tr>
                                    <th scope="col" class="border-0 rounded-start">شناسه</th>
                                    <th scope="col" class="border-0">نام و نام خانوادگی</th>
                                    <th scope="col" class="border-0">کدملی</th>
                                    <th scope="col" class="border-0">مبلغ ( تومان )</th>
                                    <th scope="col" class="border-0">وضعیت</th>
                                    <th scope="col" class="border-0">عملیات</th>
                              </tr>
                        </thead>
                        <tbody class="border-top-0">

                              @forelse($maadirans as $maadiran)
                              <tr>
                                    <td>{{ $maadiran->id }}</td>
                                    <td>{{ $maadiran->user->name ?? '---' }}</td>
                                    <td>{{$maadiran->idCard}}</td>
                                    <td>{{$maadiran->price}}</td>
                                    @if($maadiran->status === 'No')
                                    <td>
                                          <h6 class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>عدم تایید</h6>
                                    </td>
                                    @elseif($maadiran->status==='Yes')
                                    <td>
                                          <h6 class="badge text-bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>تایید</h6>
                                    </td>
                                    @endif
                                    <td>
                                          <a href="{{ route('supervisor.maadiran.edit', $maadiran->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                                ویرایش
                                          </a>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="4">درخواستی یافت نشد</td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>
      </div>
</section>