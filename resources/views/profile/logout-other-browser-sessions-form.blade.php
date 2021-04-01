<x-jet-action-section>
    <x-slot name="title">
        <x-headline class="text-2xl">
            {{ __('Browser Sessions') }}
        </x-headline>
    </x-slot>

    <x-slot name="description">
        Verwalte deine aktiven Sitzungen auf anderen Browsern und Geräten und melde dich ab.
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            Falls erforderlich, kannst du dich von all deinen anderen Browser-Sitzungen auf all deinen Geräten abmelden. Wenn du das Gefühl hast, dass dein Konto kompromittiert wurde, solltest du auch dein Passwort aktualisieren.
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">Dieses Gerät</span>
                                    @else
                                        Zuletzt aktiv {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-confirmation-button type="submit" wire:click="confirmLogout" wire:loading.attr="disabled">
                Andere Browser-Sitzungen abmelden
            </x-confirmation-button>

            <x-jet-action-message class="ml-3" on="loggedOut">
                Erledigt.
            </x-jet-action-message>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                Andere Browser-Sitzungen abmelden
            </x-slot>

            <x-slot name="content">
                Bitte gib dein Passwort ein, um zu bestätigen, dass du dich von deinen anderen Browser-Sitzungen über alle deine Geräte hinweg abmelden möchtest.

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input-text type="password" class="mt-1 block w-full" placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex items-center justify-end space-x-2">
                    <x-button type="button" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                        Abbrechen
                    </x-button>

                    <x-confirmation-button type="submit" class="" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                        Andere Browser-Sitzungen abmelden
                    </x-confirmation-button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
