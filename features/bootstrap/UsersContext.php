<?php

use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class UsersContext implements Context, SnippetAcceptingContext
{
    public function __construct()
    {
    }

    /**
     * @When after authentication with method :arg1 on :arg2 as :arg3 with password :arg4, i send an authenticated :arg5 request to :arg6 with body:
     */
    public function afterAuthenticationWithMethodOnAsWithPasswordISendAnAuthenticatedRequestToWithBody($arg1, $arg2, $arg3, $arg4, $arg5, $arg6)
    {
        throw new PendingException();
    }
}
