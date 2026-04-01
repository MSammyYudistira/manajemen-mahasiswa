<?php

declare(strict_types=1);

return [
    'app_name' => 'Manajemen Mahasiswa',
    'base_url' => getenv('APP_BASE_URL') ?: (getenv('VERCEL') ? '' : '/manajemen-mahasiswa'),
];
