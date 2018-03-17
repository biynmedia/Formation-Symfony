<?php

namespace App\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{

    /**
     * Handles an access denied failure.
     *
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     * @return void may return null
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        return new Response('Your access have been refused. Please contact your administrator.', 403);
    }
}