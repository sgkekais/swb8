<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Date;
use App\Models\DateOption;
use App\Models\DateType;
use Carbon\Carbon;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\DateColumn;
use Arm092\LivewireDatatables\NumberColumn;
use Arm092\LivewireDatatables\TimeColumn;
use PHPUnit\Framework\Constraint\Callback;

class DateTable extends Datatable
{
    public Model|string|null $model = Date::class;

    public function builder(): Builder
    {
        return $dates = Date::query()->with(['dateType', 'dateOptions']);
    }

    public function mount($model = false, $include = [], $exclude = [], $hide = [], $dates = [], $times = [], $searchable = [], $sortIndex = null, $hideHeader = null, $hidePagination = null, $perPage = null, $exportable = false, $hideable = false, $beforeTableSlot = false, $buttonsSlot = false, $afterTableSlot = false, $params = []): void
    {
        parent::mount($model, $include, $exclude, $hide, $dates, $times, $searchable, $sortIndex, $hideHeader, $hidePagination, $perPage, $exportable, $hideable, $beforeTableSlot, $buttonsSlot, $afterTableSlot, $params);
        // override search with parameter to allow linking to
        $this->search = request('date_id');
    }

    public function getColumns(): array|Model
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
