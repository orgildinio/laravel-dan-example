<?php

namespace App\Providers;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class DanServiceProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var string[]
     */

    /**
     * The scopes being requested
     *
     * @var array
     */

    protected $scopes = ['W3sic2VydmljZXMiOiBbIldTMTAwMTAxX2dldENpdGl6ZW5JRENhcmRJbmZvIl0sICJ3c2RsIjogImh0dHBzOi8veHlwLmdvdi5tbi9jaXRpemVuLTEuMi4wL3dzP1dTREwifV0='];
    /**
     * @param string $state
     *
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://sso.gov.mn/oauth2/authorize', $state);
    }

    /**
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'https://sso.gov.mn/oauth2/token';
    }

    /**
     * @param string $token
     *
     * @throws GuzzleException
     *
     * @return array|mixed
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://sso.gov.mn/oauth2/api/v1/service', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);
        dd($response->getBody()->getContents());

        return json_decode($response->getBody(), true);
    }


    /**
     * @return User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['sub'],
            'email' => $user['email'],
            'username' => $user['username'],
            'email_verified' => $user['email_verified'],
            'family_name' => $user['family_name'],
        ]);
    }
}
