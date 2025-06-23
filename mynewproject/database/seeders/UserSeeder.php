<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les IDs des rôles
        $roles = DB::table('roles')->pluck('id')->toArray();
        if (empty($roles)) {
            // Valeur par défaut si aucun rôle n'existe
            $roles = [1]; 
        }

        // Récupérer une question de sécurité
        $securiteQuestion = DB::table('securite_question')->first();
        $questionId = $securiteQuestion ? $securiteQuestion->id : 1;

        $users = [
            [
                'nom' => 'Admin',
                'prenom' => 'System',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'tel' => '0600000000',
                'date_de_naissance' => '1990-01-01',
                'role_id' => $roles[0],
                'reponse' => 'admin_response',
                'securite_question_id' => $questionId,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Formateur',
                'prenom' => 'Test',
                'email' => 'formateur@example.com',
                'password' => Hash::make('password'),
                'tel' => '0600000001',
                'date_de_naissance' => '1990-01-01',
                'role_id' => isset($roles[1]) ? $roles[1] : $roles[0],
                'reponse' => 'formateur_response',
                'securite_question_id' => $questionId,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Participant',
                'prenom' => 'Test',
                'email' => 'participant@example.com',
                'password' => Hash::make('password'),
                'tel' => '0600000002',
                'date_de_naissance' => '1990-01-01',
                'role_id' => isset($roles[2]) ? $roles[2] : $roles[0],
                'reponse' => 'participant_response',
                'securite_question_id' => $questionId,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Utiliser upsert pour éviter les doublons
        DB::table('users')->upsert($users, ['email'], [
            'nom', 'prenom', 'password', 'tel', 'date_de_naissance',
            'role_id', 'reponse', 'securite_question_id', 'is_active',
            'updated_at'
        ]);
    }
}
