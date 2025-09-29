<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Permet de configurer les Cross-Origin Resource Sharing (CORS) pour
    | autoriser les requêtes provenant de Flutter Web ou d'autres clients.
    |
    */

    // Routes concernées par le CORS
    'paths' => ['api/*'],

    // Méthodes HTTP autorisées
    'allowed_methods' => ['*'],

    // Origines autorisées (pour dev local, on autorise toutes)
    'allowed_origins' => ['*'],

    // Patterns pour les origines (vide par défaut)
    'allowed_origins_patterns' => [],

    // En-têtes autorisés
    'allowed_headers' => ['*'],

    // En-têtes exposés dans la réponse
    'exposed_headers' => ['*'],

    // Durée de mise en cache préflight (en secondes)
    'max_age' => 0,

    // Autoriser les cookies / credentials
    'supports_credentials' => false,
];
