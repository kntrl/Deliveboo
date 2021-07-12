<?php
    
    namespace App\Services;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;


    class Slug
    {
        public function __invoke($value,$table)
        {
            $baseSlug = Str::slug($value);
            $i = 1;
            $slug = $baseSlug;
            while (DB::table($table)->where('slug','=',$slug)->first()) 
            {
                $slug = $baseSlug.'-'.$i;
                $i++;
            }           
            return $slug;
        }
    }