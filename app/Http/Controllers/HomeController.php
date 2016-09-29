<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

/**
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
		$this->middleware('lang');
		$this->middleware('auth', ['only' => ['homeBackend']]);
    }

    /**
     * [FRONT-END]: Get the front-end index page.
	 *
	 * @url:platform  GET|HEAD: /
     * @see:phpunit   HomeTest::testHomeFrontend()
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function homeFront()
    {
        $data['activities'] = Activity::with(['groups', 'creator'])
            ->where('state', 1)
            ->orderBy('date', 'ASC')
            ->paginate(25)
            ->take(6);

        // TODO: Add news posts query.
        //       Also need to embed this in the view.

        return view('welcome', $data);
    }

    /**
     * [BACK-END]: Get the backend home view fgor the website.
	 *
	 * @url:platform  GET|HEAD: /home
     * @see:phpunit   HomeTest::testHomeBackend()
	 *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeBackend()
    {
        return view('backend');
    }
}
