<?php

namespace App\Http\Controllers\API;

use App\Events;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

class EventController extends BaseController
{
    public function index()
    {
        $events = Events::all();
        return $this->sendResponse($events->toArray(), 'Events retrieved successfully!');
    }

    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'eventOrganizer' => 'required',
            'eventName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'eventDescription' => 'required',
            'eventVenue' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails())
        {
            return $this->sendError('Validation Error. You are not allowed to enter!', $validator->errors());
        }

        $event = Events::create($input);

        return $this->sendResponse($event->toArray(), 'Yay. Event Created!');
    }

    public function show($id)
    {
        $event = Events::find($id);

        if(is_null($event))
        {
            return $this->sendError('Event does not exist..');
        }
        return $this->sendResponse($event->toArray(), 'Event found!');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'eventOrganizer' => 'required',
            'eventName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'eventDescription' => 'required',
            'eventVenue' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails())
        {
            return $this->sendError('Incomplete information', $validator->errors());
        }

        $event = Events::find($id);

        if(is_null($event))
        {
            return $this->sendError('Event does not exist..');
        }

        $event->eventOrganizer = $input['eventOrganizer'];
        $event->eventName =$input['eventName'];
        $event->startDate =$input['startDate'];
        $event->endDate =$input['endDate'];
        $event->eventDescription =$input['eventDescription'];
        $event->eventVenue =$input['eventVenue'];
        $event->email =$input['email'];
        $event->phone =$input['phone'];
        $event->save();
        return $this->sendResponse($event->toArray(), 'Event has been updated');
    }

    public function destroy($id)
    {
        $event = Events::find($id);

        if(is_null($event))
        {
            return $this->sendError('Event does not exist..');
        }

        try 
        {
            $event->delete();
        }
        catch (\Exception $e)
        {
            return $this->sendError('What happened?');
        }

        return $this->sendResponse($event->toArray(), 'Sad to see you go. Event deleted.');
    }

}