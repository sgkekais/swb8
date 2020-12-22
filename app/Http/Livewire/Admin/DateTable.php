<?php

namespace App\Http\Livewire\Admin;

use App\Models\Date;
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
        return $dates = Date::query()->with('dateType');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc')
                ->searchable(),
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
                ->label('Art')->alignCenter(),
            Column::name('datetype.description')
                ->label('')
                ->filterable($this->dateTypeDescriptions),
            NumberColumn::name('location.name')
                ->label('Ort'),
            Column::callback('datetime', function ($datetime) {
                $date = Carbon::make($datetime);
                return $date ? $date->format('Y-m-d') : null;
            })->searchable()->label('Tag'),
            TimeColumn::name('datetime')
                ->label('Uhrzeit'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }

    // get date type descriptions to filter
    public function getDateTypeDescriptionsProperty()
    {
        return DateType::pluck('description');
    }
}
