<?php

arch('should not have dd(), dump(), var_dump()')
    ->expect(['dd', 'dump', 'var_dump'])
    ->not->toBeUsed();

arch('should not have env() outside config directory')
    ->expect('env')
    ->not->toBeUsed();

arch('should not have ray()')
    ->expect('ray')
    ->not->toBeUsed();
