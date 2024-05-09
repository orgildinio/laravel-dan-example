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

    // protected $scopes = ['W3sic2VydmljZXMiOiBbIldTMTAwMTAxX2dldENpdGl6ZW5JRENhcmRJbmZvIl0sICJ3c2RsIjogImh0dHBzOi8veHlwLmdvdi5tbi9jaXRpemVuLTEuMy4wL3dzP1dTREwifV0='];
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
        // dd($token);
        $response = $this->getHttpClient()->post('https://sso.gov.mn/oauth2/api/v1/service', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);
        // dd($response);

        return json_decode($response->getBody(), true);
    }


    /**
     * @return User
     */
    protected function mapUserToObject(array $user)
    {
        // dd($user);
        $login_type = $user[0]['citizen_loginType'];
        // login_type = 1 байгууллагаар нэвтэрсэн
        if ($login_type == 1) {
            $userData = $user[1]["services"]["WS100307_getLegalEntityInfoWithRegnum"]["response"];

            return (new User())->setRaw($userData)->map([
                'companyName' => $userData['general']['companyName'],
                'description' => $userData['general']['description'],
                'regnum' => $userData['general']['companyRegnum'],
                'ownershipTypeName' => $userData['general']['ownershipTypeName'],
                'profitTypeName' => $userData['general']['profitTypeName'],
                'aimagCityName' => $userData['address'][0]['stateCity']['name'],
                'soumDistrictName' => $userData['address'][0]['soumDistrict']['name'],
                'bagKhorooName' => $userData['address'][0]['bagKhoroo']['name'],
                'login_type' => $login_type
            ]);
        } else {
            $userData = $user[1]["services"]["WS100101_getCitizenIDCardInfo"]["response"];

            dd($userData);

            return (new User())->setRaw($userData)->map([
                'personId' => $userData['personId'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'regnum' => $userData['regnum'],
                'aimagCityName' => $userData['aimagCityName'],
                'soumDistrictName' => $userData['soumDistrictName'],
                'bagKhorooName' => $userData['bagKhorooName'],
                'passportAddress' => $userData['passportAddress'],
                'image' => $userData['image'],
                'gender' => $userData['gender'],
                'login_type' => $login_type
            ]);
        }
    }
}
