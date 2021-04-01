<x-jet-action-section>
    <x-slot name="title">
        <x-headline class="text-2xl">
            Zwei-Faktor-Authentifizierung
        </x-headline>
    </x-slot>

    <x-slot name="description">
        Erhöhe die Sicherheit deines Kontos mit der Zwei-Faktor-Authentifizierung.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                Du hast die Zwei-Faktor-Authentifizierung aktiviert.
            @else
                Du hast die Zwei-Faktor-Authentifizierung nicht aktiviert.
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                Wenn die Zwei-Faktor-Authentifizierung aktiviert ist, wirst du während der Authentifizierung zur Eingabe eines sicheren, zufälligen Tokens aufgefordert. Du kannst dieses Token von der Google Authenticator-Anwendung deines Telefons abrufen.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        Die Zwei-Faktor-Authentifizierung ist jetzt aktiviert. Scanne den folgenden QR-Code mit der Authenticator-Anwendung deines Telefons.
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        Speichere diese Wiederherstellungscodes in einem sicheren Passwort-Manager. Sie können verwendet werden, um den Zugang zu deinem Konto wiederherzustellen, wenn dein Zwei-Faktor-Authentifizierungsgerät verloren geht.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5 flex items-center space-x-2">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-confirmation-button type="button" wire:loading.attr="disabled">
                        Aktivieren
                    </x-confirmation-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-button type="button" class="">
                            Wiederherstellungs-Codes regenerieren
                        </x-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-button type="button" class="">
                            Wiederherstellungs-Codes anzeigen
                        </x-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-delete-button type="button" wire:loading.attr="disabled">
                        Deaktivieren
                    </x-delete-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
