<?php

define('PAGINATION_COUNT', 15);

function getFolder(): string
{
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}