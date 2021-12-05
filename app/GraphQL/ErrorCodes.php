<?php

namespace App\GraphQL;

abstract class ErrorCodes
{
    const AUTH_INVALID_TOKEN = ['AUTH_INVALID_TOKEN', 'Invalid token'];
    const AUTH_MISSING_TOKEN = ['AUTH_MISSING_TOKEN', 'A token is required'];
    const AUTH_MISSING_SCOPES = ['AUTH_MISSING_SCOPES', 'Missing scopes'];
    const AUTH_OWNER_ONLY = ['AUTH_OWNER_ONLY', 'Field can only be queried by the token owner'];
    const AUTH_SUPPORTER_REQUIRED = ['AUTH_SUPPORTER_REQUIRED', 'Supporter is required'];

    const RATELIMITED = ['RATELIMITED', 'You are being rate-limited'];
}
