<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // Nouveau Menu
            ['name' => 'menu_gestion_des_utilisateurs', 'guard_name' => 'web'],
            ['name' => 'sous_menu_liste_utilisateurs', 'guard_name' => 'web'],
            ['name' => 'nouvel_utilisateur', 'guard_name' => 'web'],
            ['name' => 'suspendre_utilisateur', 'guard_name' => 'web'],
            ['name' => 'modifier_utilisateur', 'guard_name' => 'web'],
            ['name' => 'supprimer_utilisateur', 'guard_name' => 'web'],

            ['name' => 'sous_menu_liste_utilisateurs_archives', 'guard_name' => 'web'],
            ['name' => 'restaurer_utilisateur', 'guard_name' => 'web'],
            ['name' => 'supprimer_definitivement_utilisateur', 'guard_name' => 'web'],

            ['name' => 'sous_menu_liste_profils_utilisateurs', 'guard_name' => 'web'],
            ['name' => 'nouveau_profile', 'guard_name' => 'web'],
            ['name' => 'modifier_profile', 'guard_name' => 'web'],
            ['name' => 'supprimer_profile', 'guard_name' => 'web'],

            ['name' => 'sous_menu_liste_permissions', 'guard_name' => 'web'],
            ['name' => 'nouvelle_permission', 'guard_name' => 'web'],
            ['name' => 'modifier_permission', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_gestion_des_categories', 'guard_name' => 'web'],

            ['name' => 'sous_menu_categories_aliments', 'guard_name' => 'web'],
            ['name' => 'nouveau_aliment', 'guard_name' => 'web'],
            ['name' => 'modifier_aliment', 'guard_name' => 'web'],
            ['name' => 'supprimer_aliment', 'guard_name' => 'web'],

            ['name' => 'sous_menu_categories_boisson', 'guard_name' => 'web'],
            ['name' => 'nouvelle_boisson', 'guard_name' => 'web'],
            ['name' => 'modifier_boisson', 'guard_name' => 'web'],
            ['name' => 'supprimer_boisson', 'guard_name' => 'web'],

            ['name' => 'sous_menu_categories_plats', 'guard_name' => 'web'],
            ['name' => 'nouveau_plat', 'guard_name' => 'web'],
            ['name' => 'modifier_plat', 'guard_name' => 'web'],
            ['name' => 'supprimer_plat', 'guard_name' => 'web'],

            
            // Nouveau Menu
            ['name' => 'menu_gestion_des_approvisionnements', 'guard_name' => 'web'],

            ['name' => 'sous_menu_approvisionnement_aliments', 'guard_name' => 'web'],
            ['name' => 'nouvelle_approvisionnement_aliment', 'guard_name' => 'web'],
            ['name' => 'modifier_approvisionnement_aliment', 'guard_name' => 'web'],
            ['name' => 'supprimer_approvisionnement_aliment', 'guard_name' => 'web'],

            ['name' => 'sous_menu_approvisionnement_boisson', 'guard_name' => 'web'],
            ['name' => 'nouvelle_approvisionnement_boisson', 'guard_name' => 'web'],
            ['name' => 'modifier_approvisionnement_boisson', 'guard_name' => 'web'],
            ['name' => 'supprimer_approvisionnement_boisson', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_gestion_du_stock', 'guard_name' => 'web'],
            ['name' => 'sous_menu_stock_aliment', 'guard_name' => 'web'],
            ['name' => 'sous_menu_stock_boissson', 'guard_name' => 'web'],
            
            // Nouveau Menu **
            ['name' => 'menu_gestion_des_repas', 'guard_name' => 'web'],
            ['name' => 'sous_menu_liste_des_mets', 'guard_name' => 'web'],
            ['name' => 'nouveau_met', 'guard_name' => 'web'],
            ['name' => 'modifier_met', 'guard_name' => 'web'],
            ['name' => 'supprimer_met', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_gestion_de_la_caisse', 'guard_name' => 'web'],
            ['name' => 'sous_menu_liste_des_depenses', 'guard_name' => 'web'],
            ['name' => 'sous_menu_la_caise', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_vente_et_facturation', 'guard_name' => 'web'],
            ['name' => 'sous_menu_gestion_des_commandes', 'guard_name' => 'web'],
            ['name' => 'sous_menu_gestion_des_preparations', 'guard_name' => 'web'],
            ['name' => 'sous_menu_liste_des_ventes', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_rapport', 'guard_name' => 'web'],
            ['name' => 'sous_menu_approvisionnements', 'guard_name' => 'web'],
            ['name' => 'sous_menu_ventes_et_facturation', 'guard_name' => 'web'],
            ['name' => 'sous_menu_commandes_cuisine', 'guard_name' => 'web'],
            
            // Nouveau Menu
            ['name' => 'menu_parametre', 'guard_name' => 'web'],            
        ];

        foreach ($permissions as $key => $value) {
            // dump($value);
            Permission::create([
                'name'        => $value['name'],
                'guard_name'  => $value['guard_name'],
            ]);
        }
    }
}
