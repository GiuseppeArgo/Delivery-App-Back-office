<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // Se il tipo è presente nella richiesta
        if ($request->type) {
            $typesArray = $request->type;
            $typesArray = preg_replace('/[\[\]\s]/', '', $typesArray);
            $typesArray = json_decode('[' . $typesArray . ']');

            $query = Restaurant::with('types')
                ->where(function ($query) use ($typesArray) {
                    foreach ($typesArray as $typeId) {
                        $query->whereHas('types', function ($q) use ($typeId) {
                            $q->where('id', $typeId);
                        });
                    }
                });
        } else {
            $query = Restaurant::with('types');
        }

        // Ottieni il numero totale di ristoranti
        $totalCount = $query->count();

        // Usa la paginazione con 3 elementi per pagina
        $paginatedResult = $query->paginate(3);

        return response()->json([
            'data' => $paginatedResult->items(),
            'total' => $totalCount,
            'current_page' => $paginatedResult->currentPage(),
            'last_page' => $paginatedResult->lastPage()
        ]);
    }

    public function show(string $slug) {

        $showRestaurant = Restaurant::with(['types','dishes'])->where('slug', $slug)->first();
        $data = [
            'result' => $showRestaurant,
        ];

        return response()->json($data);
    }
}
