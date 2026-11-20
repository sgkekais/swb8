<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\TrimAndNullEmptyStrings;
use App\Models\Assist;
use App\Models\Card;
use App\Models\Club;
use App\Models\Goal;
use App\Models\Game;
use App\Models\MatchType;
use App\Models\Season;
use Livewire\Component;

class CreateMatch extends Component
{
    use TrimAndNullEmptyStrings;

    public $is_open = false;
    public Game $match;
    public $match_types;
    public $clubs;
    public $seasons;
    public $card_to_be_added = [];
    public $players_of_club = [];
    public $card_deleted = false;
    public $goal_to_be_added = [];
    public $goal_deleted = false;

    protected $listeners = [
        'editTableEntry' => 'edit',
        'deleteTableEntry' => 'delete'
    ];

    public function mount()
    {
        $this->seasons = Season::orderBy('number', 'desc')->get();
        $this->clubs = Club::orderBy('name')->get();
        $this->match_types = MatchType::orderBy('description')->get();
        $this->goal_to_be_added[0]['penalty'] = false;
    }

    protected $rules = [
        'match.match_type_id' => 'required',
        'match.season_id' => 'required',
        'match.matchweek' => 'nullable',
        'match.team_home' => 'nullable',
        'match.team_away' => 'nullable',
        'match.goals_home' => 'nullable|numeric|min:0',
        'match.goals_home_ht' => 'nullable|numeric|min:0',
        'match.goals_home_pen' => 'nullable|numeric|min:0',
        'match.goals_home_rated' => 'nullable|numeric|min:0',
        'match.goals_away' => 'nullable|numeric|min:0|required_with:match.goals_home',
        'match.goals_away_ht' => 'nullable|numeric|min:0|required_with:match.goals_home_ht',
        'match.goals_away_pen' => 'nullable|numeric|min:0|required_with:match.goals_home_pen',
        'match.goals_away_rated' => 'nullable|numeric|min:0|required_with:goals_home_rated',
        'match.match_details' => 'nullable',
        'match.published' => 'boolean',
        'match.cancelled' => 'boolean'
    ];

    public function openModal()
    {
        $this->is_open = true;
    }

    public function closeModal()
    {
        $this->is_open = false;
        $this->resetInputFields();
    }

    public function create()
    {
        $this->openModal();
    }

    public function resetInputFields()
    {
        $this->match = new Game();
    }

    public function addCard()
    {
        if (! $this->matchIsSaved()) {
            return;
        }

        $this->validate([
            'card_to_be_added.0.player' => 'required|exists:players,id',
            'card_to_be_added.0.color' => 'required|in:gelb,10min,gelb-rot,rot',
            'card_to_be_added.0.note' => 'nullable|string|max:191',
        ], [], [
            'card_to_be_added.0.player' => 'Spieler',
            'card_to_be_added.0.color' => 'Farbe',
            'card_to_be_added.0.note' => 'Notiz',
        ]);

        $card = new Card();
        $card->player_id = $this->card_to_be_added[0]['player'];
        $card->color = $this->card_to_be_added[0]['color'];
        $card->note = filled($this->card_to_be_added[0]['note'] ?? null) ? $this->card_to_be_added[0]['note'] : null;

        $this->match->cards()->save($card);
        $this->match->refresh();
    }

    public function deleteCard(Card $card)
    {
        $card->delete();
        $this->card_deleted = true;
        $this->match->refresh();
    }

    /**
     * add a new goal
     */
    public function addGoal()
    {
        if (! $this->matchIsSaved()) {
            return;
        }

        $this->validate([
            'goal_to_be_added.0.player' => 'required|exists:players,id',
            'goal_to_be_added.0.score' => 'required|string|max:191',
            'goal_to_be_added.0.minute' => 'nullable|string|max:191',
            'goal_to_be_added.0.assist' => 'nullable|exists:players,id',
            'goal_to_be_added.0.penalty' => 'boolean',
        ], [], [
            'goal_to_be_added.0.player' => 'Spieler',
            'goal_to_be_added.0.score' => 'Stand',
            'goal_to_be_added.0.minute' => 'Minute',
            'goal_to_be_added.0.assist' => 'Vorlage',
            'goal_to_be_added.0.penalty' => '11m',
        ]);

        $goal = new Goal();
        $goal->player_id = $this->goal_to_be_added[0]['player'];
        $goal->score = $this->goal_to_be_added[0]['score'];
        $goal->minute = filled($this->goal_to_be_added[0]['minute'] ?? null) ? $this->goal_to_be_added[0]['minute'] : null;
        $goal->penalty = (bool) ($this->goal_to_be_added[0]['penalty'] ?? false);

        $this->match->goals()->save($goal);
        if (filled($this->goal_to_be_added[0]['assist'] ?? null))
        {
            $assist = new Assist();
            $assist->player_id = $this->goal_to_be_added[0]['assist'];
            $goal->assist()->save($assist);
        }

        $this->match->refresh();
    }

    /**
     * delete the given goal
     * @param Goal $goal
     * @throws \Exception
     */
    public function deleteGoal(Goal $goal)
    {
        $goal->delete();
        $this->goal_deleted = true;
        $this->match->refresh();
    }

    /**
     * Goals and cards need a saved match.
     */
    protected function matchIsSaved(): bool
    {
        if (isset($this->match) && $this->match->exists) {
            return true;
        }

        $this->addError('match', 'Bitte das Spiel zuerst speichern.');

        return false;
    }

    public function store()
    {
        // validate
        $this->validate();

        $this->match->save();

        $this->closeModal();
        session()->flash('success', 'Spiel erfolgreich '.($this->match->id ? 'geändert' : 'angelegt.'));
        $this->dispatch('refreshLivewireDatatable');
    }

    public function edit(Game $match)
    {
        $this->match = $match;
        $this->match->match_details = $match->match_details;
        $this->match->load('matchType','season','goals.player','cards.player');

        if (isset($this->match))
        {
            $home_team = Club::find($this->match->team_home);
            $away_team = Club::find($this->match->team_away);

            if ($home_team->owner) {
                $this->players_of_club = $home_team->players;
            } elseif ($away_team->owner) {
                $this->players_of_club = $away_team->players;
            }
        }

        $this->openModal();
    }

    public function render()
    {
        return view('livewire.admin.create-match');
    }
}
