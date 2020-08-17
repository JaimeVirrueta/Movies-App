<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Http\Resources\V1\MoviesResponse;
use App\Models\Movie;
use App\Traits\ApiResponserV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieController extends BaseApiController
{
    use ApiResponserV1;

    public function index()
    {
        $rows = Movie::query()
            ->paginate( request()->get('paginate', 10) );

        return MoviesResponse::collection($rows)->additional([
            'links' => [
                'create' => route('movie.store')
            ]
        ]);
    }

    public function store(MovieStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $row = Movie::create($request->validated());

            $image = $request->file('image');
            $imageName = $row->id . '.' . $image->getClientOriginalExtension();
            $image->storeAs('', $imageName, 'movie_files');

            $row->image_path = $imageName;
            $this->processTurns($row, $request->get('turns', []));
            $row->save();

            DB::commit();

            return MoviesResponse::make($row);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    public function show(Movie $movie)
    {
        return MoviesResponse::make($movie);
    }

    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        DB::beginTransaction();
        try {
            if ($request->has('image')) {
                $image = $request->file('image');
                $imageName = $movie->id . '.' . $image->getClientOriginalExtension();
                $image->storeAs('', $imageName, 'movie_files');

                $movie->image_path = $imageName;
            }

            $this->processTurns($movie, $request->get('turns', []));

            $movie->fill($request->validated())->save();

            DB::commit();

            return MoviesResponse::make($movie)->additional([
                'message' => 'The movie has been successfully updated in system'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    public function destroy(Movie $movie)
    {
        DB::beginTransaction();
        try {
            $movie->delete();
            Storage::disk('movie_files')->delete($movie->image_path);

            DB::commit();

            return MoviesResponse::make($movie)->additional([
                'message' => 'The movie has been successfully deleted from system'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    private function processTurns($movie, $turns)
    {
        if (!empty($turns)) {
            $movie->turns()->sync($turns);
        }

        return $movie;
    }
}
