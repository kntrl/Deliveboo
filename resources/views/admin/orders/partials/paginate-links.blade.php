@if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
    @if ($orders->lastPage() != 1)
        <ul class="pagination my_paginate justify-content-end">
            <li class="page-item">
                <a 
                class="page-link {{ $orders->currentPage() == 1 ? 'disabled' : ''}}" 
                href="{{route('admin.orders.index',['page'=>$orders->currentPage()-1,'filter'=>app('request')->input('filter')])}}"
                >
                Precedenti
                </a>
            </li>
            <li class="page-item">
                <a 
                    class="page-link  {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : ''}}" 
                    href="{{route('admin.orders.index',['page'=>$orders->currentPage()+1,'filter'=>app('request')->input('filter')])}}"
                    >
                    Successivi
                </a>
            </li>
        </ul>
    @endif
@endif
