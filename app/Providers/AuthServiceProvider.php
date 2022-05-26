<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url){
            return (new MailMessage)
                ->subject('Verifique seu email!')
                ->line('Por favor clique no botão abaixo para verificar o seu endereço de e-mail.')
                ->action('Verifique o endereço de e-mail', $url)
                ->line('Se você não criou uma conta, nenhuma ação adicional é necessária.');
        });

        ResetPassword::toMailUsing(function ($notifiable, $url){
           $expires =   config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

            return (new MailMessage)
                ->subject('Notificação de redefinição de senha!')
                ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua a conta.')
                ->action('Redefinir a senha', $url)
                ->line('Este link de redefinição de senha irá expirar em ' . $expires .'minutos.')
                ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional será necessária.');
        });
    }
}
