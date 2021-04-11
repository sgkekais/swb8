<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Date;
use App\Models\Player;
use App\Models\Season;
use Livewire\Component;

class Sinners extends Component
{
    public $header = 'Sünderkartei';
    public ?Club $club = null;
    public $selectable_seasons = [];
    public ?Season $season = null;
    public $selected_season = "";
    public $sinners = [];
    public $sortField = "sinner_points";
    public $sortDirection = 'desc';
    public $first_card;

    public function mount(Club $club)
    {
        $this->club = $club;
        $this->selectable_seasons = $this->club->seasons()->orderBy('number', 'desc')->get();
        if (!$this->selectable_seasons->isEmpty())
        {
            $this->selected_season = $this->selectable_seasons->first()->id;
        }
        $this->first_card = Date::whereHas('match.cards')->orderBy('datetime')->first()->datetime;
    }

    protected $rules =  [
        'selected_season' => 'string'
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        $this->season = Season::find($this->selected_season);

        $this->sinners = Player::whereHas('cards.match.season', function ($query) {
            return $query->where('id', $this->selected_season);
        })->get();

        // fill scorers with goals, assists and respective totals for sorting
        foreach ($this->sinners as $sinner)
        {
//            $sinner->cards = $sinner->cards->where('match.season.id', $this->selected_season);
//            $sinner->total_yellow_cards = $sinner->cards->where('color', 'gelb')->count();
//            $sinner->total_red_cards = $sinner->cards->where('color', 'rot')->count();
//            $sinner->total_yellow_red_cards = $sinner->cards->where('color', 'gelb-rot')->count();
//            $sinner->total_time_penalties = $sinner->cards->where('color', '10min')->count();
            $sinner->total_cards = $sinner->cards()->whereHas('match', function ($q) {
                $q->where('season_id', $this->selected_season);
            })->count();
            $sinner->total_yellow_cards =  $sinner->cards()->whereHas('match', function ($q) {
                $q->where('season_id', $this->selected_season);
            })->where('color', 'gelb')->count();
            $sinner->total_red_cards =  $sinner->cards()->whereHas('match', function ($q) {
                $q->where('season_id', $this->selected_season);
            })->where('color', 'rot')->count();
            $sinner->total_yellow_red_cards =  $sinner->cards()->whereHas('match', function ($q) {
                $q->where('season_id', $this->selected_season);
            })->where('color', 'gelb-rot')->count();
            $sinner->total_time_penalties =  $sinner->cards()->whereHas('match', function ($q) {
                $q->where('season_id', $this->selected_season);
            })->where('color', '10min')->count();

            $sinner->sinner_points = $sinner->total_yellow_cards
                                        + $sinner->total_time_penalties
                                        + $sinner->total_yellow_red_cards * 3
                                        + $sinner->total_red_cards * 5;
        }
        // sort the collection
        if ($this->sortDirection === 'asc')
        {
            $this->sinners = $this->sinners->sortBy([
                [$this->sortField, 'asc'],
                ['full_name_short', 'asc']
            ]);
        } elseif ($this->sortDirection === 'desc') {
            $this->sinners = $this->sinners->sortBy([
                [$this->sortField, 'desc'],
                ['full_name_short', 'asc']
            ]);
        }

        return view('livewire.sinners')->layout('layouts.app', ['header' => $this->header]);
    }
}
