<?php
namespace App\Widgets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class ProductQueries extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Product_query::count();
        $string = trans_choice('Queries', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-question',
            'title'  => "{$count} {$string}",
            'text'   => 'You have '.$count.' Queries in your database.',
            'button' => [
                'text' => 'View All Queries',
                'link' => route('voyager.product-queries.index'),
            ],
            'image' => asset('images/widgets/query.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('Page'));
    }
}
