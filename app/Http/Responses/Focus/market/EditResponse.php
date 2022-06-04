<?php

namespace App\Http\Responses\Focus\market;

use App\Models\market\SalesChannel;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\market\SalesChannel
     */
    protected $sales_channel;

    /**
     * @param App\Models\market\SalesChannel $sales_channel
     */
    public function __construct($sales_channel)
    {
        $this->sales_channel = $sales_channel;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        $sales_channel = $this->sales_channel;

        return view('focus.market.edit',compact('sales_channel'));
    }
}
