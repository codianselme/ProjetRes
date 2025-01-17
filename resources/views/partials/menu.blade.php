<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand d-flex justify-content-between align-items-center" style="gap: 10px;">
            <a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('home/site-images/logo.png') }}" srcset="{{ asset('home/site-images/logo.png 2x') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('home/site-images/logo.png') }}" srcset="{{ asset('home/site-images/logo.png 2x') }}" alt="logo-dark">
            </a>
            <a href="{{ route('dashboard') }}" class="text-white" style="font-size: 30px; font-family: Apple Chancery, cursive;">Accueil</a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    
                    <br><br>
                    <li class="nk-menu-item has-sub">
                        {{-- @can("_menu_gestion_des_utilisateurs") --}}
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                <span class="nk-menu-text">Gestion des Utilisateurs</span>
                            </a>
                        {{-- @endcan --}}
                        
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_liste_utilisateurs")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.utilisateurs') }}" class="nk-menu-link"><span class="nk-menu-text">Utilisateurs</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_utilisateurs_archives")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.utilisateurs-archives') }}" class="nk-menu-link"><span class="nk-menu-text">Utilisateurs archivés</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_profils_utilisateurs")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.roles') }}" class="nk-menu-link"><span class="nk-menu-text">Profils Utilisateurs</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_permissions")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.permissions') }}" class="nk-menu-link"><span class="nk-menu-text">Permissions</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_gestion_des_categories")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">Gestion des Categories</span> 
                        </a>
                    {{-- @endcan --}}
                        
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_categories_aliments")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.food.category') }}" class="nk-menu-link"><span class="nk-menu-text">Catégories d'Aliments</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_categories_boisson")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.drink.category') }}" class="nk-menu-link"><span class="nk-menu-text">Catégories de Boisson</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_categories_plats")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.dish.category') }}" class="nk-menu-link"><span class="nk-menu-text">Catégories des plats</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_gestion_des_approvisionnements")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-puzzle"></em></span>
                            <span class="nk-menu-text">Gestion des Approvs</span> 
                        </a>
                    {{-- @endcan --}}
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_approvisionnement_aliments")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.food.supply') }}" class="nk-menu-link"><span class="nk-menu-text">Approvs en Aliments</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_approvisionnement_boisson")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.drink.supply') }}" class="nk-menu-link"><span class="nk-menu-text">Approvs en Boisson</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_gestion_du_stock")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                            <span class="nk-menu-text">Gestion du Stock</span>
                        </a>
                    {{-- @endcan --}}
                        
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_stock_aliment")  --}}
                                {{-- <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.stock.food') }}" class="nk-menu-link"><span class="nk-menu-text">Stock Aliment</span></a>
                                </li> --}}
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_stock_boissson")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.stock.drink') }}" class="nk-menu-link"><span class="nk-menu-text">Stock Boissson</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_gestion_des_repas")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                            <span class="nk-menu-text">Gestion des repas</span>
                        </a>
                    {{-- @endcan --}}
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_liste_des_mets")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.food.dish') }}" class="nk-menu-link"><span class="nk-menu-text">Liste des Mets</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_gestion_de_la_caisse")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-dot-box"></em></span>
                            <span class="nk-menu-text">Gestion de la Caisse</span>
                        </a>
                    {{-- @endcan --}}
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_liste_des_depenses")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.caisse.depenses') }}" class="nk-menu-link"><span class="nk-menu-text">Les dépenses</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_la_caise")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.caisse.gestion-caisse') }}" class="nk-menu-link"><span class="nk-menu-text">La Caisse</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li>

                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_vente_et_facturation")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                            <span class="nk-menu-text">Ventes et Facturation</span>
                        </a>
                    {{-- @endcan --}}
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_gestion_des_commandes")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.gestion.commands') }}" class="nk-menu-link"><span class="nk-menu-text">Gestion des commandes</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_gestion_des_preparations")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.gestion.preparation') }}" class="nk-menu-link"><span class="nk-menu-text">Gestion des Preparations</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_des_ventes")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.old.sales') }}" class="nk-menu-link"><span class="nk-menu-text">Inscrire Ancienne Vente</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_des_ventes")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.new.sales') }}" class="nk-menu-link"><span class="nk-menu-text">Inscrire Nouvelle Vente</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_liste_des_ventes")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.sales.sales') }}" class="nk-menu-link"><span class="nk-menu-text">Liste des Ventes</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking"></em></span>
                            <span class="nk-menu-text">Gestion Client</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.reservations') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Réservations</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.commandes') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Commandes</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.contacts') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Messages Contact</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nk-menu-item has-sub">
                    {{-- @can("_menu_rapport")  --}}
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text">Rapport</span>
                        </a>
                    {{-- @endcan --}}
                        <ul class="nk-menu-sub">
                            {{-- @can("_sous_menu_approvisionnements")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.repport.supply') }}" class="nk-menu-link"><span class="nk-menu-text">Approvisionnement</span></a>
                                </li>
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_ventes_et_facturation")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.repport.sales') }}" class="nk-menu-link"><span class="nk-menu-text">Ventes et Facturation</span></a>
                                </li> 
                            {{-- @endcan --}}
                            {{-- @can("_sous_menu_commandes_cuisine")  --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard.repport.kitchen') }}" class="nk-menu-link"><span class="nk-menu-text">Commandes Cuisine</span></a>
                                </li>
                            {{-- @endcan --}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item --> 
                    <li class="nk-menu-item">
                    {{-- @can("_menu_parametre")  --}}
                        <a href="{{ route('dashboard.Parametre.Parametrage') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                            <span class="nk-menu-text">Paramétrage</span>
                        </a>
                    {{-- @endcan --}}
                    </li><!-- .nk-menu-item -->

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>