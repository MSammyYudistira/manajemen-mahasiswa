<?php

declare(strict_types=1);

function config(string $key, mixed $default = null): mixed
{
    global $appConfig;

    return $appConfig[$key] ?? $default;
}

function app_url(string $path = ''): string
{
    $baseUrl = rtrim((string) config('base_url', ''), '/');
    $path = ltrim($path, '/');

    if ($path === '') {
        return $baseUrl;
    }

    return $baseUrl . '/' . $path;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return $flash;
}

function old(string $key, string $default = ''): string
{
    return $_SESSION['old'][$key] ?? $default;
}

function set_old(array $input): void
{
    $_SESSION['old'] = $input;
}

function clear_old(): void
{
    unset($_SESSION['old']);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(419);
        exit('Token CSRF tidak valid.');
    }
}

function render(string $title, string $content, bool $showSidebar = true): void
{
    $pageTitle = $title;
    require BASE_PATH . '/app/views/layouts/main.php';
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}
