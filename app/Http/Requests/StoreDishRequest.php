<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreDishRequest extends FormRequest
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
            'name'              => ['required', 'min:5','max:20'],
            'image'             => ['required', 'image', 'mimes: jpeg,jpg,png', 'max:2048'],
            'price'             => ['required', 'numeric','min:3','max:30'],
            'description'       => ['required', 'min:5', 'max:255'],
            'restaurant_id'     => ['nullable'],
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
            'image.required'        => 'Seleziona un immagine',
            'image.image'           => 'Devi selezionare un immagine',
            'image.mimes'           => 'Formato consentiti: jpg,jpeg o png',
            'image.max'             => 'Dimensione massima 2 mb',
            'price.required'        => 'Inserisci il prezzo',
            'price.min'             => 'prezzo minimo sindacale non inferiore a :min euro',
            'price.max'             => 'prezzo massimo consentito non superiore a :max euro',
            'required'              => 'Il campo :attribute è vuoto',
            'description.required'  => 'Inserisci una descrizione',
            'description.min'       => 'Deve contenere almeno :min caratteri',
            'description.max'       => 'Puo contenere massimo :max caratteri',
        ];
    }
}
