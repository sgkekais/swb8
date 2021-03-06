<?php

namespace App\Http\Livewire\Admin;

use App\Models\Date;
use App\Models\DateOption;
use App\Models\DateType;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use PHPUnit\Framework\Constraint\Callback;

class DateTable extends LivewireDatatable
{
    // public $model = Date::class;

    public function builder()
    {
        return $dates = Date::query()->with(['dateType', 'dateOptions']);
    }

    public function mount($model = null, $include = [], $exclude = [], $hide = [], $dates = [], $times = [], $searchable = [], $sort = null, $hideHeader = null, $hidePagination = null, $perPage = 10, $exportable = false, $hideable = false, $beforeTableSlot = false, $afterTableSlot = false, $params = [])
    {
        parent::mount($model, $include, $exclude, $hide, $dates, $times, $searchable, $sort, $hideHeader, $hidePagination, $perPage, $exportable, $hideable, $beforeTableSlot, $afterTableSlot, $params);
        // override search with parameter to allow linking to
        $this->search = request('date_id');
    }

    public function columns()
    {
        return [
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            }),
            NumberColumn::name('id')
                ->label('ID')
                ->searchable()
                ->defaultSort('desc'),
            Column::callback('dateType.id', function ($datetype_id) {
                switch($datetype_id) {
                    case 1:
                        return '<i class="fas fa-fw fa-poll"></i>';
                    case 2:
                        return '<i class="far fa-fw fa-futbol"></i>';
                    case 3:
                        return '<i class="fas fa-fw fa-trophy"></i>';
                    case 4:
                        return '<i class="fas fa-fw fa-glass-cheers"></i>';
                    default:
                        '';
                }
            })
                ->label('Art')
                ->alignCenter(),
            Column::name('dateType.description')
                ->label('')
                ->filterable($this->dateTypeDescriptions),
            BooleanColumn::name('published')
                ->label('Sichtbar?'),
            Column::name('clubs.name_short')
                ->label('für')
                ->filterable(),
            // DateColumn::name('date')->label('')->filterable(),
            Column::callback('datetime', function ($datetime) {
                $date = Carbon::make($datetime);
                return $date ? $date->format('Y-m-d') : null;
            })
                ->label('Tag')
                ->searchable()
                ->filterable(),
            TimeColumn::name('datetime')
                ->label('Uhrzeit'),
            NumberColumn::name('location.name')
                ->label('Ort'),
            Column::name('dateOptions.description')
                ->label('Optionen'),
            DateColumn::name('poll_begins')
                ->label('Umfragebeginn')
                ->format('Y-m-d')
                ->filterable(),
            DateColumn::name('poll_ends')
                ->label('-schluss')
                ->format('Y-m-d')
                ->filterable(),
            BooleanColumn::name('poll_is_open')
                ->label('-Offen?'),
        ];
    }

    // get date type descriptions to filter
    public function getDateTypeDescriptionsProperty()
    {
        return DateType::pluck('description');
    }

    public function computedPoll($date_option_ids)
    {
        $date_option_participants = 0;
        $date_option_attendees = 0;
        $date_options = DateOption::find($date_option_ids);
        $return_string = "";
        foreach ($date_options as $date_option)
        {
            //$date_option_participants = $date_option->users->count();
            //$date_option_attendees = $date_option->users->where('pivot.attend', 1)->count();

            $return_string .= "Option ".$date_option->description.": ".$date_option_participants." / ".$date_option_attendees;
        }
        return $return_string;
    }
}
