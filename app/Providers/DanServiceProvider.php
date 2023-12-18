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

    protected $scopes = ['W3sic2VydmljZXMiOiBbIldTMTAwMTAxX2dldENpdGl6ZW5JRENhcmRJbmZvIl0sICJ3c2RsIjogImh0dHBzOi8veHlwLmdvdi5tbi9jaXRpemVuLTEuMy4wL3dzP1dTREwifV0='];
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
        //dd($token);        
        $response = $this->getHttpClient()->post('https://sso.gov.mn/oauth2/api/v1/service', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);
        //dd($response);

        return json_decode($response->getBody(), true);
    }


    /**
     * @return User
     */
    protected function mapUserToObject(array $user)
    {

        $userData = $user[1]["services"]["WS100101_getCitizenIDCardInfo"]["response"];
        // dd($userData);

        return (new User())->setRaw($userData)->map([
            'personId' => $userData['personId'],
            'firstname' => $userData['firstname'],
            'lastname' => $userData['lastname'],
            'regnum' => $userData['regnum'],
            'aimagCityName' => $userData['aimagCityName'],
            'soumDistrictName' => $userData['soumDistrictName'],
            'bagKhorooName' => $userData['bagKhorooName'],
            'addressDetail' => $userData['addressDetail'],
        ]);
    }
}
