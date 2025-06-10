 <section class="my-4">
       <div class="container">
             <div class="d-flex justify-content-between align-items-baseline mb-4">
                   <div class="col-12">
                         <!-- Blog list table START -->
                         <div class="card border bg-transparent rounded-3">
                               <!-- Card header START -->
                               <div class="card-header bg-transparent border-bottom p-3">
                                     <div class="d-sm-flex justify-content-between align-items-center">
                                           <h5 class="mb-2 mb-sm-0">درخواست های من</h5>
                                     </div>
                               </div>

                               <div class="card-body">
                                     <div class="table-responsive border-0">
                                           <table class="table align-middle p-4 mb-0 table-hover table-shrink">
                                                 <thead class="table-dark">
                                                       <tr>
                                                             <th scope="col" class="border-0 rounded-start">نوع درخواست</th>
                                                             <th scope="col" class="border-0">تاریخ درخواست</th>
                                                             <th scope="col" class="border-0">وضعیت</th>
                                                             <th scope="col" class="border-0">عملیات</th>
                                                       </tr>
                                                 </thead>
                                                 <tbody class="border-top-0">
                                                       @forelse($allRequests as $item)
                                                       <tr>
                                                             <td>{{ $item['type'] }}</td>
                                                             <td>{{ $item['created_at']}}</td>

                                                             @if($item['status'] === 'No')
                                                             <td>
                                                                   <h6 class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>عدم تایید مدیر واحد</h6>
                                                             </td>
                                                             @elseif($item['status']==='Yes')
                                                             <td>
                                                                   <h6 class="badge text-bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>تایید مدیر واحد</h6>
                                                             </td>
                                                             @endif

                                                             <td>
                                                                   <a href="{{ $item['edit_route'] }}" class="btn btn-light btn-round mb-0" title="ویرایش">
                                                                         <i class="fas fa-edit"></i>
                                                                   </a>
                                                             </td>

                                                       </tr>
                                                       @empty
                                                       <tr>
                                                             <td colspan="5" class="text-center">هیچ درخواستی ثبت نشده است.</td>
                                                       </tr>
                                                       @endforelse
                                                 </tbody>
                                           </table>
                                     </div>
                               </div>
                         </div>
                   </div>
             </div>

       </div>
 </section>