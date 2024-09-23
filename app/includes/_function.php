<?php




/**
 * Generates a random CSRF token and stores it in the session.
 *
 * @return string The generated CSRF token.
 */
function generateCSRFToken()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return bin2hex(random_bytes(32));
}

/**
 * This function ensures a CSRF token is present in the session.
 * If a CSRF token is not already set in the session, it generates a new one.
 *
 * @return string The CSRF token.
 */
function ensureCSRFToken() {
    // Check if a CSRF token is already set in the session
    if (!isset($_SESSION['csrf_token'])) {
        // If not, generate a new CSRF token using random bytes and convert it to a hexadecimal string
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    // Return the CSRF token
    return $_SESSION['csrf_token'];
}






/**
 * Redirect to the given URL.
 *
 * @param string $url
 * @return void
 */
function redirectTo(string $url): void
{
    // var_dump('REDIRECT ' . $url);
    header('Location: ' . $url);
    exit;
}

/**
 * Check fo referer
 *
 * @return boolean Is the current referer valid ?
 */
function isRefererOk(): bool
{
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER'])
        && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}


/**
 * Check for CSRF token
 *
 * @param array|null $data Input data
 * @return boolean Is there a valid toekn in user session ?
 */
function isTokenOk(?array $data = null): bool
{
    if (!is_array($data)) $data = $_REQUEST;

    return isset($_SESSION['token'])
        && isset($data['token'])
        && $_SESSION['token'] === $data['token'];
}


/**
 * Verify HTTP referer and token. Redirect with error message.
 *
 * @return void
 */
function preventCSRF(string $redirectUrl = 'index.php'): void
{
    if (!isRefererOk()) {
        addError('referer');
        redirectTo($redirectUrl);
    }

    if (!isTokenOk()) {
        addError('csrf');
        redirectTo($redirectUrl);
    }
}

/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errorMsg): void
{
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}
