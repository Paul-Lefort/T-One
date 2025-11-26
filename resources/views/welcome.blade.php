@extends('layouts.layout')

@section('title', 'Tableau de Bord')

@section('content')
    <div class="dashboard-grid">
        <!-- Section Solde Principal et Actions Rapides -->
        <section class="solde-principal card">
            <div class="solde-compte">
                <p class="label">Solde Total de vos Comptes</p>
                {{-- La variable $totalBalance sera passée par le contrôleur --}}
                <h1 class="montant">{{ $totalBalance ?? '9 450,25 €' }}</h1>
                <p class="compte-iban">Compte Courant | FR76 XXXXXXXX XXXX XXXX XXXX</p>
            </div>
            <div class="actions-rapides">
                <a href="{{ url('/virement') }}" class="button-primary action-virement">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Virement</span>
                </a>
                <a href="{{ url('/operations') }}" class="button-secondary action-historique">
                    <i class="fas fa-history"></i>
                    <span>Historique</span>
                </a>
                <a href="{{ url('/profil') }}" class="button-secondary action-profil">
                    <i class="fas fa-cog"></i>
                    <span>Gérer</span>
                </a>
            </div>
        </section>

        <!-- Section Dernières Transactions -->
        <section class="transactions-recentes card">
            <h2><i class="fas fa-list-alt"></i> Dernières Transactions</h2>
            <div class="transaction-list">
                {{-- Boucle pour afficher les transactions (données fictives ici) --}}
                @for ($i = 0; $i < 5; $i++)
                    <div class="transaction-item {{ $i % 2 == 0 ? 'debit' : 'credit' }}">
                        <div class="transaction-details">
                            <i class="fas {{ $i % 2 == 0 ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                            <div class="details-text">
                                <p class="description">
                                    {{ $i == 0 ? 'Achat en ligne - Amazon' : ($i == 1 ? 'Salaire Novembre' : ($i == 2 ? 'Supermarché Carrefour' : ($i == 3 ? 'Remboursement Ami' : 'Abonnement Netflix'))) }}
                                </p>
                                <p class="date">{{ now()->subDays($i)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <p class="montant-transaction">{{ $i % 2 == 0 ? '- ' : '+ ' }}{{ number_format(rand(10, 500), 2, ',', ' ') }} €</p>
                    </div>
                @endfor
            </div>
            <a href="{{ url('/operations') }}" class="button-link voir-plus">Voir toutes les opérations <i class="fas fa-chevron-right"></i></a>
        </section>

        <!-- Section Cartes Bancaires (Petit aperçu) -->
        <section class="mes-cartes card">
            <h2><i class="fas fa-credit-card"></i> Mes Cartes</h2>
            <div class="card-apercu">
                <div class="carte-physique">
                    <i class="fab fa-cc-visa fa-3x"></i>
                    <p>Carte Visa Classic</p>
                    <p class="numero-cache">**** **** **** 4567</p>
                    <a href="{{ url('/cartes') }}" class="button-secondary button-small">Gérer les cartes</a>
                </div>
            </div>
        </section>

        <!-- Section Outils/Simulateurs -->
        <section class="outils-financiers card">
            <h2><i class="fas fa-calculator"></i> Outils Utiles</h2>
            <div class="outils-list">
                <a href="{{ url('/epargne') }}" class="outil-item">
                    <i class="fas fa-piggy-bank"></i>
                    <p>Objectifs d'Épargne</p>
                </a>
                <a href="{{ url('/pret') }}" class="outil-item">
                    <i class="fas fa-house-damage"></i>
                    <p>Simulateur de Prêt</p>
                </a>
                <a href="{{ url('/contact') }}" class="outil-item">
                    <i class="fas fa-headset"></i>
                    <p>Contacter un Conseiller</p>
                </a>
            </div>
        </section>
    </div>
@endsection