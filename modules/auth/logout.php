<?php

declare(strict_types=1);

logout();
set_flash('success', 'Anda telah logout.');
redirect('index.php?route=login');
