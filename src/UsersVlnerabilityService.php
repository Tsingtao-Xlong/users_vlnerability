<?php
namespace Xlong\UsersVlnerability;

use Illuminate\Session\SessionManager;
use Illuminate\Config\Repository;

class UsersVlnerabilityService
{
    /**
     * @var SessionManager
     */
//    protected $session;
    /**
     * @var Repository
     */
//    protected $config;
    /**
     * Packagetest constructor.
     * @param SessionManager $session
     * @param Repository $config
     */
//    public function __construct(SessionManager $session, Repository $config)
//    {
//        $this->session = $session;
//        $this->config = $config;
//    }
//    /**
//     * @param string $msg
//     * @return string
//     */
//    public function test_rtn($msg = ''){
//
//        $config_arr = $this->config->get('user_vlnerability.options');
//        return $msg.' <strong>from your custom develop package!</strong>>';
//    }

    public function __construct()
    {

    }
    /**
     * @param string $msg
     * @return string
     */
    public function test_rtn($msg = ''){
        $config_arr = config('user_vlnerability.options');
        return [$msg.' <strong>from your custom develop package!</strong>', $config_arr];
    }


}