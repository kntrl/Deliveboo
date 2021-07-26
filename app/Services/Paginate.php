<?php
    
    namespace App\Services;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Http\Request;


    class Paginate
    {
        public function __invoke($items,$itemsPerPage)
        {
            $page = isset($_GET['page']) ? $_GET['page'] : 1; 

            return new \Illuminate\Pagination\LengthAwarePaginator(
                $items->forPage($page,$itemsPerPage)->values(),
                $items->count(),
                $itemsPerPage,
                \Illuminate\Pagination\Paginator::resolveCurrentPage(),
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
            );
        
        }
    }