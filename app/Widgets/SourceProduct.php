<?php
namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class SourceProduct extends BaseDimmer
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
        $count = \App\Source_product::count();
        $string = trans_choice('Source Products', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-plus',
            'title'  => "{$count} {$string}",
            'text'   => 'You have '.$count.' Source Products in your database. Click on button below to view',
            'button' => [
                'text' => 'View All Source Products',
                'link' => route('voyager.source-products.index'),
            ],
            'image' => asset('images/widgets/source.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return app('VoyagerAuth')->user()->can('browse', Voyager::model('Page'));
    }
}
