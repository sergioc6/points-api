<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\PointRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Point;
use Illuminate\Http\Request;

/**
 * Class PointsController
 * @package App\Http\Controllers
 * @author SergioC
 */
class PointsController extends Controller
{
    use ResponseTrait;

    /**
     * @param PaginationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        $pageSize = $request->get('page_size', 15);
        $points = Point::paginate($pageSize);
        return $this->successResponse(
            new PaginationResource($points),
            'Points list returned'
        );
    }

    /**
     * @param PointRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PointRequest $request)
    {
        $point = Point::create($request->validated());
        return $this->successResponse(
            $point,
            'Point created',
            201
        );
    }

    /**
     * @param PointRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(PointRequest $request, $id)
    {
        $point = Point::findOrFail($id);
        $point->update($request->validated());
        return $this->successResponse(
            $point,
            'Point edited'
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $point = Point::findOrFail($id);
        return $this->successResponse(
            $point,
            'Point returned'
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $point = Point::findOrFail($id);
        $point->delete();
        return $this->successResponse(
            $point,
            'Point deleted'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNearbyPoints(Request $request, $id)
    {
        $limit = $request->get('limit', 15);
        $maxDistance = $request->get('max_distance', 50);
        $point = Point::findOrFail($id);
        $nearbyPoints = Point::getNearbyPoints($point->id, $maxDistance, $limit);

        return $this->successResponse(
            [
                'point' => $point,
                'nearby_points' => $nearbyPoints
            ],
            'Nearby Points returned'
        );
    }
}
