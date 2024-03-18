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
            Unsere Heimspiele tragen wir - falls im Spielplan nicht anders vermerkt - i.d.R. freitagabends um 21:00 Uhr auf dem Kunstrasenplatz bei  <span class="font-bold">DJK Sparta Bilk e.V.</span> aus.
        </div>

        <iframe
            class="w-full h-64 my-4 border border-black"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9998.533135195672!2d6.7535224!3d51.2074086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b8ca70cb4514d7%3A0x2e5cc86d2bf89645!2sDJK%20Sparta%20Bilk%20e.V.!5e0!3m2!1sde!2sde!4v1700130421279!5m2!1sde!2sde"
            allowfullscreen="" loading="lazy">
        </iframe>

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
