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
            Unsere Heimspiele tragen wir - falls im Spielplan nicht anders vermerkt - i.d.R. freitagabends um 20:45 Uhr auf dem Kunstrasenplatz von DJK Sparta Bilk e.V. aus.
        </div>

        <iframe
            class="w-full h-64 my-4 border border-black"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4204.014726144023!2d6.7516982727989125!3d51.2057719562394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b8ca70cb4514d7%3A0x2e5cc86d2bf89645!2sDJK%20Sparta%20Bilk%20e.V.!5e0!3m2!1sde!2sde!4v1618501090006!5m2!1sde!2sde"
            allowfullscreen="" loading="lazy">
        </iframe>

        <div class="leading-7 flex grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                Anschrift:
                <ul>
                    <li>DJK Sparta Bilk e.V.</li>
                    <li>F&auml;hrstrasse 51</li>
                    <li>40221 D&uuml;sseldorf</li>
                </ul>
            </div>
            <div>
                Haltestellen in der Nähe:
                <ul>
                    <li>Kapellweg, Linie 723</li>
                    <li>Georg-Schulhoff-Platz, Linie 709</li>
                    <li>Völklinger Straße, Linie S8 / S11 / S28</li>
                </ul>
            </div>
            <div>
                Parkplätze vorhanden
            </div>
        </div>



    </x-section>

</x-app-layout>
