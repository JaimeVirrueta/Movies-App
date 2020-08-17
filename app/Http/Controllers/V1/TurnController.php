<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\TurnStoreRequest;
use App\Http\Requests\TurnUpdateRequest;
use App\Http\Resources\V1\TurnsResponse;
use App\Models\Turn;
use App\Traits\ApiResponserV1;
use Illuminate\Support\Facades\DB;

class TurnController extends BaseApiController
{
    use ApiResponserV1;

    public function index()
    {
        $rows = Turn::query()
            ->paginate( request()->get('paginate', 10) );

        return TurnsResponse::collection($rows)->additional([
            'links' => [
                'create' => route('turn.store')
            ]
        ]);
    }

    public function store(TurnStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $row = Turn::create($request->validated());

            DB::commit();

            return TurnsResponse::make($row);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    public function show(Turn $turn)
    {
        return TurnsResponse::make($turn);
    }

    public function update(TurnUpdateRequest $request, Turn $turn)
    {
        DB::beginTransaction();
        try {
            $turn->fill($request->validated())->save();

            DB::commit();

            return TurnsResponse::make($turn)->additional([
                'message' => 'The turn has been successfully updated in system'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    public function destroy(Turn $turn)
    {
        DB::beginTransaction();
        try {
            $turn->delete();

            DB::commit();

            return TurnsResponse::make($turn)->additional([
                'message' => 'The turn has been successfully deleted from system'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }
}
