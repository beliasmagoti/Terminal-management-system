<?php

namespace App\Enums;

enum SensorType: string {
    case LEVEL = 'level';
    case TEMPERATURE = 'temperature';
    case PRESSURE = 'pressure';
    case WATER = 'water';
    case LEAK_DETECTION = 'leak_detection';
}