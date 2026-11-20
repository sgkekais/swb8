<?php

namespace App\Http\Livewire\Admin;

use Arm092\LivewireDatatables\Livewire\LivewireDatatable;

/**
 * Base class of the admin tables.
 *
 * The former datatables package kept no table state between page loads,
 * so search, sorting, page size, filters and hidden columns are not
 * persisted in the session here either.
 */
abstract class Datatable extends LivewireDatatable
{
    public bool $persistSearch = false;

    public bool $persistComplexQuery = false;

    public bool $persistHiddenColumns = false;

    public bool $persistSort = false;

    public bool $persistPerPage = false;

    public bool $persistFilters = false;
}
