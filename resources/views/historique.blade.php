@extends('layouts.layout')
@section('title', 'Historique des opérations')
@section('content')
<h2>Historique de vos transactions</h2>

@php
use Carbon\Carbon;

$operationsParMois = collect($operations)->groupBy(function($operation) {
    if (isset($operation->dateOperation) && !empty($operation->dateOperation)) {
        try {
            return Carbon::parse($operation->dateOperation)->format('Y-m');
        } catch (\Exception $e) {
            return 'date-invalide';
        }
    }
    return 'sans-date';
});

$operationsParMois = $operationsParMois->sortKeysDesc();
@endphp

@if($operationsParMois->isEmpty())
    <p class="no-transactions">Aucune transaction trouvée.</p>
@else
    @foreach($operationsParMois as $mois => $operationsDuMois)
        @php
        if ($mois === 'date-invalide' || $mois === 'sans-date') {
            $titreMois = 'Opérations sans date valide';
        } else {
            try {
                $titreMois = Carbon::parse($mois . '-01')->locale('fr_FR')->isoFormat('MMMM YYYY');
                $titreMois = ucfirst($titreMois);
            } catch (\Exception $e) {
                $titreMois = 'Date invalide';
            }
        }
        
        $totalMois = $operationsDuMois->sum('montant');
        @endphp
        
        <div class="month-section">
            <div class="month-separator">
                <span class="month-label">{{ $titreMois }}</span>
            </div>
            
            <div class="transactions-cards">
                @foreach($operationsDuMois as $operation)
                    @php
                    $typeLabels = [
                        'C' => 'Crédit',
                        'D' => 'Débit',
                        'V' => 'Virement'
                    ];
                    $nom = $typeLabels[$operation->typeOperation ?? ''] ?? 'Opération';
                    
                    if (($operation->typeOperation ?? '') === 'V') {
                        $nom .= ($operation->compteCredite ?? '') ? ' (ID: ' . $operation->compteCredite . ')' : '';
                    }
                    
                    $isCredit = ($operation->typeOperation ?? '') === 'C';
                    $isDebit = ($operation->typeOperation ?? '') === 'D';
                    
                    if (($operation->typeOperation ?? '') === 'V') {
                        $prefix = '';
                        $color = 'virement';
                    } else {
                        $prefix = $isCredit ? '+' : '' ;
                        $color = $isCredit ? 'credit' : 'debit';
                    }
                    
                    $dateFormatted = 'Date inconnue';
                    if (isset($operation->dateOperation) && !empty($operation->dateOperation)) {
                        try {
                            $dateFormatted = Carbon::parse($operation->dateOperation)
                                ->locale('fr_FR')
                                ->isoFormat('dddd D MMMM YYYY');
                        } catch (\Exception $e) {
                            $dateFormatted = 'Date invalide';
                        }
                    }
                    
                    $montant = isset($operation->montant) ? number_format(abs($operation->montant), 2, ',', ' ') : '0,00';
                    @endphp
                    
                    <div class="transaction-card">
                        <div class="transaction-info">
                            <h3>{{ $nom }}</h3>
                            <p>{{ ucfirst($dateFormatted) }}</p>
                        </div>
                        <div class="transaction-amount {{ $color }}">
                            {{ $prefix }} {{ $montant }} €
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/historique.css') }}">
@endpush