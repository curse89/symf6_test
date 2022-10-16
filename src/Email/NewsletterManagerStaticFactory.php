<?php

namespace App\Email;

class NewsletterManagerStaticFactory
{
    public static function createNewsletterManager(string $arg): NewsletterManager
    {
        $newsletterManager = new NewsletterManager();

        // ...

        return $newsletterManager;
    }
}