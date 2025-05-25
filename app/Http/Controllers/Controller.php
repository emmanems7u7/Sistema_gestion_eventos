<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\ConfCorreo;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $conf = ConfCorreo::first();

        if ($conf) {
            config([
                'mail.mailers.smtp.host' => $conf->conf_smtp_host,
                'mail.mailers.smtp.port' => $conf->conf_smtp_port,
                'mail.mailers.smtp.username' => $conf->conf_smtp_user,
                'mail.mailers.smtp.password' => $conf->conf_smtp_pass,
                'mail.mailers.smtp.encryption' => $conf->conf_protocol,
                'mail.default' => 'smtp',
            ]);
        }
    }
}
