<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTenderRequest;
use App\Http\Resources\TenderResource;
use App\Models\Tender;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $tendersCollectionQuery = Tender::query();

        if ($request->has('name')) {
            $tendersCollectionQuery->where('name',  $request->get('name'));
        }

        if ($request->has('date')) {
            $dateFilter = $request->get('date');

            if (isset($dateFilter['from'])) {
                $tendersCollectionQuery->where('created_at',  '>=', $dateFilter['from']);
            }

            if (isset($dateFilter['to'])) {
                $tendersCollectionQuery->where('created_at',  '<=', $dateFilter['to']);
            }
        }

        $tendersCollection = $tendersCollectionQuery->get();
        return TenderResource::collection($tendersCollection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTenderRequest $request
     * @return AnonymousResourceCollection
     */
    public function store(CreateTenderRequest $request): AnonymousResourceCollection
    {
        $tendersCollection = new Collection();
        $tendersCollection->add(Tender::query()->create($request->validated()));
        return TenderResource::collection($tendersCollection);
    }

    /**
     * Display the specified resource.
     *
     * @param Tender $tender
     * @return AnonymousResourceCollection
     */
    public function show(Tender $tender): AnonymousResourceCollection
    {
        $tendersCollection = new Collection();
        $tendersCollection->add($tender);
        return TenderResource::collection($tendersCollection);
    }
}
