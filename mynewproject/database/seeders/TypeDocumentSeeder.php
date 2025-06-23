<?php

namespace Database\Seeders;

use App\Models\TypeDocument;
use Illuminate\Database\Seeder;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $typeDocuments = [
            [
                'nom' => 'Curriculum Vitae (CV)',
                'description' => 'Votre CV détaillant votre parcours professionnel et académique',
                'icone' => 'fas fa-file-alt',
                'couleur' => '#007bff',
                'obligatoire' => true,
                'formats_autorises' => 'pdf,doc,docx',
                'taille_max_mb' => 5,
                'actif' => true
            ],
            [
                'nom' => 'Lettre de motivation',
                'description' => 'Lettre expliquant votre motivation pour cette formation',
                'icone' => 'fas fa-heart',
                'couleur' => '#dc3545',
                'obligatoire' => false,
                'formats_autorises' => 'pdf,doc,docx',
                'taille_max_mb' => 3,
                'actif' => true
            ],
            [
                'nom' => 'Diplôme le plus élevé',
                'description' => 'Copie de votre diplôme le plus élevé ou dernier diplôme obtenu',
                'icone' => 'fas fa-graduation-cap',
                'couleur' => '#28a745',
                'obligatoire' => true,
                'formats_autorises' => 'pdf,jpg,jpeg,png',
                'taille_max_mb' => 10,
                'actif' => true
            ],
            [
                'nom' => 'Pièce d\'identité',
                'description' => 'Copie de votre carte d\'identité ou passeport',
                'icone' => 'fas fa-id-card',
                'couleur' => '#ffc107',
                'obligatoire' => true,
                'formats_autorises' => 'pdf,jpg,jpeg,png',
                'taille_max_mb' => 5,
                'actif' => true
            ],
            [
                'nom' => 'Certificat de travail',
                'description' => 'Certificat de votre employeur actuel ou précédent (si applicable)',
                'icone' => 'fas fa-briefcase',
                'couleur' => '#6f42c1',
                'obligatoire' => false,
                'formats_autorises' => 'pdf,doc,docx,jpg,jpeg,png',
                'taille_max_mb' => 5,
                'actif' => true
            ],
            [
                'nom' => 'Photo d\'identité',
                'description' => 'Photo d\'identité récente au format numérique',
                'icone' => 'fas fa-camera',
                'couleur' => '#20c997',
                'obligatoire' => false,
                'formats_autorises' => 'jpg,jpeg,png',
                'taille_max_mb' => 2,
                'actif' => true
            ]
        ];

        foreach ($typeDocuments as $typeDocument) {
            TypeDocument::create($typeDocument);
        }
    }
}
