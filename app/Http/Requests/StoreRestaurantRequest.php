<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxTipologies;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => ['required', 'min:3','max:25', Rule::unique('restaurants')->ignore($this->restaurant)],
            'address'           => ['required', 'min:5','max: 50'],
            'image'             => ['required', 'image', 'mimes: jpeg,jpg,png', 'max:2048'],
            'description'       => ['required', 'min:5', 'max:255'],
            'p_iva'             => ['required', 'min:11', 'max:11',Rule::unique('restaurants')->ignore($this->restaurant)],
            'tipologies'        => ['required', new MaxTipologies(2)],
            'slug'              => ['nullable'],
        ];
    }

    public function messages()
    {
        return
        [
            'name.required'         => 'Il campo nome è vuoto',
            'name.min'              => 'Deve contenere almeno :min caratteri',
            'name.max'              => 'Può contenere massimo :max caratteri',
            'name.unique'           => 'Hai gia un ristorante con questo nome',
            'address.required'      => 'Inserisci l\'indirizzo del ristorante',
            'address.min'           => 'Deve essere di almeno :min caratteri',
            'address.max'           => 'Puo essere massimo di :max caratteri',
            'image.required'        => 'Seleziona un immagine',
            'image.image'           => 'Devi selezionare un immagine',
            'image.mimes'           => 'Formato consentiti: jpg,jpeg o png',
            'image.max'             => 'Dimensione massima 2 mb',
            'description.required'  => 'Inserisci una descrizione',
            'description.min'       => 'Deve contenere almeno :min caratteri',
            'description.max'       => 'Puo contenere massimo :max caratteri',
            'p_iva.required'        => 'Il campo P.iva non può essere vuoto',
            'p_iva.min'             => 'Deve contenere 11 caratteri numerici',
            'p_iva.max'             => 'Deve contenere 11 caratteri numerici',
            'tipologies.required'   => 'Selezione almeno una tipologia',

        ];
    }
}
