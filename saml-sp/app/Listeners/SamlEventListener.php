<?php

namespace App\Listeners;

use App\Exceptions\PostSamlException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Slides\Saml2\Events\SignedIn;

class SamlEventListener
{

    protected Request $request;

    /**
     * Create the event listener.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     * @throws PostSamlException
     */
    public function handle(SignedIn $event): void
    {
        $messageId = $event->auth->getLastMessageId();
        $samlUser = $event->auth->getSaml2User();
        $userData = [
            'id' => $samlUser->getUserId(),
            'attributes' => $samlUser->getAttributes(),
            'assertion' => $samlUser->getRawSamlAssertion()
        ];

        $user = [];
        foreach ($userData['attributes'] as $key => $value) {
            preg_match('/commonname/i', $key, $matches);
            if (count($matches) > 0) {
                $user['name'] = $value[0];
            }
        }
        $user['email'] = $userData['id'];
        $user['password'] = '!QAZ2wsx#EDC';
        if (!Auth::attempt($user)) {
            $user['password'] = Hash::make('!QAZ2wsx#EDC');
            User::create($user);
            $user['password'] = '!QAZ2wsx#EDC';
            Auth::attempt($user);
        }
//        app('session')->regenerate();
//        throw new PostSamlException($user);
    }
}
