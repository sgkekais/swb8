<div class="w-full">
    <canvas id="myChart{{ $club->id }}" class="w-full" height="200"></canvas>

    @push('scripts')
        <script>
            var ctx_{{ $club->id }} = document.getElementById('myChart{!! $club->id !!}');
            var yLabels_{{ $club->id }} = {
                0: 'N',
                1: 'U' ,
                2: 'S',
                3: '',
                4: ''
            };

            var tooltips_{{ $club->id }} = [];

            @foreach($last_dates as $d)
                tooltips_{{ $club->id }}[{{ $loop->index }}] = "{{ $d->match->teamHome->name_short }}";
                @if($d->match->isRated())
                    tooltips_{{ $club->id }}[{{ $loop->index }}] += " {{ $d->match->goals_home_rated }}:{{ $d->match->goals_away_rated }} (Wert.)";
                @elseif ($d->match->isPenalties())
                    tooltips_{{ $club->id }}[{{ $loop->index }}] += " {{ $d->match->goals_home_pen }}:{{ $d->match->goals_away_pen}} i.E.";
                @else
                    tooltips_{{ $club->id }}[{{ $loop->index }}] += " {{ $d->match->goals_home }}:{{ $d->match->goals_away }}";
                @endif
                tooltips_{{ $club->id }}[{{ $loop->index }}] += " {{ $d->match->teamAway->name_short }} ";
            @endforeach

            var clublogos_{{ $club->id }} = [];

            @foreach($last_dates as $d)
                var clublogo = new Image();
                @if($d->match->teamHome->owner)
                    clublogo.src = '{{ $d->match->teamAway->logo() }}';
                @elseif($d->match->teamAway->owner)
                    clublogo.src = '{{ $d->match->teamHome->logo() }}';
                @endif
                clublogo.height = 50;
                clublogo.width = 50;
                clublogos_{{ $club->id }}[{{ $loop->index }}] = clublogo;
            @endforeach

            var myChart = new Chart(ctx_{{ $club->id }}, {
                type: 'line',
                stepped: false,
                data: {
                    labels: {!! $x_labels !!},
                    datasets: [
                        {
                            // label: '# of Votes',
                            data: {{ $last_dates->pluck('fever_value') }},
                            borderColor: 'black',
                            pointStyle: clublogos_{{ $club->id }},
                            clip: 25,
                        }
                    ]
                },
                options: {
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.raw === 2 ? "Sieg" : (context.raw === 1 ? "Unentschieden" : "Niederlage") ;
                                },
                                footer: function(tooltipItem) {
                                    return tooltips_{{ $club->id }}[tooltipItem[0]['dataIndex']];
                                }
                            },
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                padding: 25,
                                stepSize: 1,
                                callback: function(value) {
                                    return yLabels_{{ $club->id }}[value];
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</div>
