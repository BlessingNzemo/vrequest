<?php

namespace App\Http\Requests;
use App\Models\Demande;
use Illuminate\Foundation\Http\FormRequest;

class ApiDemandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ticket'=>['required', 'string'],
            'date'=>['required','date_format:Y-m-d'],
            'name' => ['required', 'string', 'max:255'],
            'motif'=>['required', 'string','max:60','min:3'],
            'date_deplacement' => ['required', 'date_format:Y-m-d H:i'],
            'lieu_depart'=>['required','string', 'min:3', 'max:255'],
            'destination'=>['required','string', 'min:3', 'max:255'],
            'nbre_passagers' => ['required', 'integer', 'min:0', 'max:50'],
            'longitude_depart' => ['required', 'numeric', 'between:-180,180'],
            'latitude_depart' => ['required', 'numeric', 'between:-90,90'],
            'longitude_destination' => ['required', 'numeric', 'between:-180,180'],
            'latitude_destination' => ['required', 'numeric', 'between:-90,90'],

        ];
    }
    public function messages(): array
    {
        return [
            'ticket.required'=>'champ obligatoire',
            'ticket.string'=>'champ chaine de caractere',
            'date.required' => 'Le champ date  est requis.',
            'date.date_format' => 'Le champ date doit être au format :format (ex. : "2023-01-01 ").',
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',

            'motif.required' => 'Le champ motif est requis.',
            'motif.string' => 'Le champ motif doit être une chaîne de caractères.',
            'motif.max' => 'Le champ motif ne doit pas dépasser :max caractères.',
            'motif.min' => 'Le champ motif doit avoir au moins :min caractères.',

            'date_deplacement.required' => 'Le champ date de déplacement est requis.',
            'date_deplacement.date_format' => 'Le champ date de déplacement doit être au format :format (ex. : "2023-01-01 14:30").',

            'lieu_depart.required' => 'Le champ lieu de départ est requis.',
            'lieu_depart.string' => 'Le champ lieu de départ doit être une chaîne de caractères.',
            'lieu_depart.min' => 'Le champ lieu de départ doit avoir au moins :min caractères.',
            'lieu_depart.max' => 'Le champ lieu de départ ne doit pas dépasser :max caractères.',

            'destination.required' => 'Le champ destination est requis.',
            'destination.string' => 'Le champ destination doit être une chaîne de caractères.',
            'destination.min' => 'Le champ destination doit avoir au moins :min caractères.',
            'destination.max' => 'Le champ destination ne doit pas dépasser :max caractères.',

            'nbre_passagers.required' => 'Le champ nombre de passagers est requis.',
            'nbre_passagers.integer' => 'Le champ nombre de passagers doit être un entier.',
            'nbre_passagers.min' => 'Le champ nombre de passagers ne peut pas être négatif.',
            'nbre_passagers.max' => 'Le champ nombre de passagers ne peut pas dépasser :max.',

            'longitude_depart.required' => 'Le champ longitude de départ est requis.',
            'longitude_depart.numeric' => 'Le champ longitude de départ doit être un nombre.',
            'longitude_depart.between' => 'Le champ longitude de départ doit être compris entre :min et :max.',

            'latitude_depart.required' => 'Le champ latitude de départ est requis.',
            'latitude_depart.numeric' => 'Le champ latitude de départ doit être un nombre.',
            'latitude_depart.between' => 'Le champ latitude de départ doit être compris entre :min et :max.',

            'longitude_destination.required' => 'Le champ longitude de destination est requis.',
            'longitude_destination.numeric' => 'Le champ longitude de destination doit être un nombre.',
            'longitude_destination.between' => 'Le champ longitude de destination doit être compris entre :min et :max.',

            'latitude_destination.required' => 'Le champ latitude de destination est requis.',
            'latitude_destination.numeric' => 'Le champ latitude de destination doit être un nombre.',
            'latitude_destination.between' => 'Le champ latitude de destination doit être compris entre :min et :max.',
        ];
    }
}
