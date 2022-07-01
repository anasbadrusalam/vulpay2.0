<?php

namespace App\Nova;

use App\Nova\Metrics\TransactionsPerDay;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->hideFromIndex()
                ->readonly(),

            Text::make('Code')
                ->readonly(),

            Text::make('Terminal')
                ->readonly(),

            Text::make('Provider')->resolveUsing(function ($name) {
                return strtoupper($name);
            })
                ->hideFromIndex()
                ->readonly(),


            Text::make('Sender')
                ->readonly(),

            Number::make('Amount')
                ->rules('required'),

            Number::make('Rate')
                ->readonly(),

            // Currency::make('Balance', function () {
            //     return floor($this->amount * $this->rate);
            // })->currency('IDR'),

            Currency::make('Balance')
                ->currency('IDR')
                ->readonly(),


            Text::make('Receiver')
                ->readonly(),

            DateTime::make('Created At')
                ->hideFromIndex()
                ->readonly(),

            DateTime::make('Updated At')
                ->hideFromIndex()
                ->readonly(),

            DateTime::make('Expired At')
                ->hideFromIndex()
                ->readonly(),

            Badge::make('Status')->map([
                'menunggu' => 'info',
                'sukses' => 'success',
                'dibatalkan' => 'danger',
            ]),

            Select::make('Status')->options([
                'dibatalkan' => 'dibatalkan',
                'menunggu' => 'menunggu',
                'sukses' => 'sukses',
            ])
                ->rules('required')
                ->onlyOnForms()
                ->hideWhenCreating(),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            // new TransactionsPerDay()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
