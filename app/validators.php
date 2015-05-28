<?php

Validator::extend('alpha_spaces', function($attribute, $value, $parameters)
{
    return preg_match('/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/', $value);
    
});