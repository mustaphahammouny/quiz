<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChoiceRequest;
use App\Http\Resources\ChoiceResource;
use App\Models\Choice;
use App\Services\ChoiceService;
use Exception;

class ChoiceController extends Controller
{
    public function __construct(protected ChoiceService $choiceService)
    {
    }

    public function index(Choice $choice)
    {
        $choices = $choice->choices()->paginate(10);

        return ChoiceResource::collection($choices);
    }

    public function show(Choice $choice)
    {
        return new ChoiceResource($choice);
    }

    public function store(ChoiceRequest $request)
    {
        $data = $request->validated();

        try {
            $choice = $this->choiceService->store($data);

            return new ChoiceResource($choice);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(ChoiceRequest $request, Choice $choice)
    {
        $data = $request->validated();

        try {
            $choice = $this->choiceService->update($choice, $data);

            return new ChoiceResource($choice);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Choice $choice)
    {
        try {
            $choice = $this->choiceService->delete($choice);

            return new ChoiceResource($choice);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
