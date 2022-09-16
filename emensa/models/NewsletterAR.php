<?php

class NewsletterAR extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'newsletteranmeldung';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $fillable = ['email'];
}