<x-app-layout>
    <x-slot name="header">
        Über uns
    </x-slot>

    <x-section>
        <x-headline class="text-2xl">
            Zum Spielbetrieb
        </x-headline>

        <div class="leading-7">
            Unser HLW- und unser AH-Team spielen in der <a href="https://www.hobbyligawest.de" class="inline-link" target="_blank">Hobbyliga-West D&uuml;sseldorf</a>.
            Unsere Heimspiele tragen wir - falls im Spielplan nicht anders vermerkt - i.d.R. freitagabends um 21:00 Uhr auf dem Kunstrasenplatz bei  <span class="font-bold">DJK Sparta Bilk e.V.</span> aus.
        </div>

        {{-- Google Maps is only loaded after an explicit click (no data to Google before) --}}
        <div x-data="{ showMap: false }" class="w-full h-64 my-4 border border-black bg-gray-100">
            <template x-if="showMap">
                <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9998.533135195672!2d6.7535224!3d51.2074086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b8ca70cb4514d7%3A0x2e5cc86d2bf89645!2sDJK%20Sparta%20Bilk%20e.V.!5e0!3m2!1sde!2sde!4v1700130421279!5m2!1sde!2sde"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer">
                </iframe>
            </template>
            <div x-show="!showMap" class="h-full flex flex-col items-center justify-center p-4 space-y-4 text-center">
                <i class="fas fa-map-marked-alt fa-2x text-gray-600"></i>
                <p class="text-sm max-w-xl">
                    Die Karte wird von Google Maps geladen. Dabei werden Daten wie Ihre IP-Adresse an Google übertragen.
                    Mehr dazu in der <a href="{{ route('tos-privacy') }}#google-maps" class="inline-link">Datenschutzerklärung</a>.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <button type="button" x-on:click="showMap = true" class="px-4 py-2 bg-black text-white text-sm font-bold uppercase tracking-wider hover:bg-gray-700 focus:outline-none">
                        Karte laden
                    </button>
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=DJK+Sparta+Bilk+e.V.%2C+F%C3%A4hrstra%C3%9Fe+51%2C+40221+D%C3%BCsseldorf" target="_blank" rel="noopener noreferrer" class="inline-link text-sm">
                        In Google Maps öffnen <i class="fas fa-external-link-alt fa-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="leading-7 flex grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                Anschrift:
                <ul>
                    <li>DJK Sparta Bilk e.V.</li>
                    <li>Fährstraße 51</li>
                    <li>40221 Düsseldorf</li>
                </ul>
            </div>
            <div>
                Parkplätze vorhanden
            </div>
        </div>



    </x-section>

</x-app-layout>
