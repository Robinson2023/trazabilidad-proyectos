<?php

namespace App\Http\Controllers;

use App\Models\Movement;

class MaterialLogController extends Controller
{
public function index()
{
    $query = Movement::with([
    'material',
    'project',
    'user',
    'worker',
]);

if (request('type')) {

    $query->where('type', request('type'));

}

    if (request('search')) {

        $search = request('search');

        $query->where(function ($q) use ($search) {

            $q->whereHas('material', function ($m) use ($search) {

                $m->where(
                    'name',
                    'like',
                    "%{$search}%"
                );

            })

            ->orWhereHas('project', function ($p) use ($search) {

                $p->where(
                    'name',
                    'like',
                    "%{$search}%"
                );

            })

            ->orWhereHas('worker', function ($w) use ($search) {

                $w->where(
                    'name',
                    'like',
                    "%{$search}%"
                );

            });

        });
    }

    $movements = $query
        ->latest()
        ->get();

    return view(
        'material-log.index',
        compact('movements')
    );
}
}
