@push('scripts')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endpush

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
            Unsere Heimspiele tragen wir - falls im Spielplan nicht anders vermerkt - i.d.R. freitagabends um 20:30 Uhr auf dem Kunstrasenplatz des <span class="font-bold">FC Büderich 02 e.V.</span> aus.
        </div>

        <iframe
            class="w-full h-64 my-4 border border-black"
            src="https://maps.google.com/maps?q=FC%20B%C3%BCderich%2002&t=&z=13&ie=UTF8&iwloc=&output=embed"
            allowfullscreen="" loading="lazy">
        </iframe>

        <div class="leading-7 flex grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                Anschrift:
                <ul>
                    <li>FC Büderich 02 e.V.</li>
                    <li>Am Eisenbrand 45</li>
                    <li>40667 Meerbusch</li>
                </ul>
            </div>
            <div>
                Parkplätze vorhanden
            </div>
        </div>



    </x-section>

</x-app-layout>
