<?php

declare(strict_types=1);

function attempt_login(string $username, string $password): bool
{
    $stmt = db()->prepare('SELECT id_user, username, password, nama_user FROM users WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        return false;
    }

    $_SESSION['auth'] = [
        'id_user' => $user['id_user'],
        'username' => $user['username'],
        'nama_user' => $user['nama_user'],
    ];

    return true;
}

function is_authenticated(): bool
{
    return isset($_SESSION['auth']['id_user']);
}

function auth_user(): ?array
{
    return $_SESSION['auth'] ?? null;
}

function logout(): void
{
    unset($_SESSION['auth']);
    session_regenerate_id(true);
}
