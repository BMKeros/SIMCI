<?php

Validator::extend('foo', function($field,$value,$parameters){
    //return true if field value is foo
    return $value == 'foo';
});