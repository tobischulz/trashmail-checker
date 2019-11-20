<?php

namespace TobiSchulz\TrashmailChecker;

class TrashmailChecker
{
    public $domain;

    /**
     * Validates the email.
     *
     * @return boolean
     */
    public function validate($email)
    {
        return $this->validateEmail($email);
    }

    /**
     * Checks the email if its an known trashmail/dispossable provider.
     *
     * @return boolean
     */
    public function check($email)
    {
        // to allow any email on development, this will skip the check.
        if (config('app.env') === 'local' && !config('trashmailchecker.validate_on_development')) {
            logger("The TrashmailChecker skipped check in development. Please check the configuration (/config/trashmailchecker.php).");
            return true;
        }

        // no need to check if its not a valid email.
        if (!$this->validate($email)) {
            return true;
        }
        
        // split the mail to domain.
        $this->domain = $this->splitEmail($email);

        $exists = TrashmailProvider::whereDomain($this->domain)
            ->blacklisted()
            ->active()
            ->exists();

        return !$exists;
    }

    /**
     * Validates the email. Might be obsolete cause laravel got already that validation.
     * https://laravel.com/docs/6.x/validation#rule-email
     *
     * @return boolean
     */
    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Strips away the email recipient and returns the domain.
     *
     * @return string
     */
    private function splitEmail($email)
    {
        return substr(strrchr($email, "@"), 1);
    }
}
