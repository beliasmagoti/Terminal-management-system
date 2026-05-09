<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('dashboard', function ($user = null) {
    return true;
});